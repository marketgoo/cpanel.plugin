#!/bin/sh
##############################################################################
#                         _        _
#                        | |      | |
#    _ __ ___   __ _ _ __| | _____| |_ __ _  ___   ___
#   | '_ ` _ \ / _` | '__| |/ / _ \ __/ _` |/ _ \ / _ \
#   | | | | | | (_| | |  |   <  __/ || (_| | (_) | (_) |
#   |_| |_| |_|\__,_|_|  |_|\_\___|\__\__, |\___/ \___/
#                                      __/ |
#   MarketGoo Plug-in for cPanel      |___/
#
#
#   Download and execute this file in your shell:
#   $ curl -LO http://raw.github.com/marketgoo/cpanel.plugin/master/marketgoo-install.sh
#   $ /bin/sh ./marketgoo-install.sh
#
#   Execute installer directly from GitHub
#   $ curl -Lks http://raw.github.com/marketgoo/cpanel.plugin/master/marketgoo-install.sh | sh
#
##############################################################################

WHITE=$(tput setaf 7 ; tput bold)
RED=$(tput setaf 1 ; tput bold)
GREEN=$(tput setaf 2 ; tput bold)
CYAN=$(tput setaf 6 ; tput bold)
RESET=$(tput sgr0)
WHMROOT=/usr/local/cpanel/whostmgr
TEMPDIR=$(mktemp -d marketgooplugin.XXXXXXXXX)
REMOTE_REPOSITORY=http://github.com/marketgoo/cpanel.plugin
SRCDIR=${TEMPDIR}/cpanel.plugin-master
CPVERSION=$(cat 2>/dev/null /usr/local/cpanel/version)
MKTGOODIR=/var/cpanel/marketgoo
THEMEDIR=/usr/local/cpanel/base/frontend/default

cleanup()
{
    local rc=$?
    trap - EXIT

    rm -rf $TEMPDIR
    exit $rc
}

download_latest()
{
    echo
    echo "${WHITE}Downloading latest plug-in version${RESET}"
    curl -Lks ${REMOTE_REPOSITORY}/archive/master.tar.gz | tar xz -C $TEMPDIR
}

install_whm_addon()
{
    echo "${WHITE}Installing WHM AddOn${RESET}"

    cp -r $SRCDIR/whm/marketgoo/ $WHMROOT/docroot/ >/dev/null 2>&1
    cp -f $SRCDIR/whm/addon_marketgoo.cgi $WHMROOT/docroot/cgi/ >/dev/null 2>&1
    cp -f $SRCDIR/whm/marketgoo.gif $WHMROOT/docroot/themes/x/icons/ >/dev/null 2>&1
    mkdir -p $MKTGOODIR
    cp -f $SRCDIR/VERSION $MKTGOODIR/VERSION

    if [ ! -f $HOME/.marketgoo_partner_id ]; then
        php -r "require('${SRCDIR}/whm/marketgoo/lib.php'); echo generate_partnerid();" > $HOME/.marketgoo_partner_id
        echo "${GREEN} +++ Generating new Partner ID:" `cat $HOME/.marketgoo_partner_id` "${RESET}"
    else
        echo "${GREEN} +++ Using previous Partner ID:" `cat $HOME/.marketgoo_partner_id` "${RESET}"
    fi
    cp -f $HOME/.marketgoo_partner_id $MKTGOODIR/.marketgoo_partner_id
}

install_cpanel_plugin()
{
    mkdir -p $MKTGOODIR
    cp -r $SRCDIR/cpanel/plugins $MKTGOODIR >/dev/null 2>&1
    cp -f $SRCDIR/cpanel/install_plugins.sh $MKTGOODIR >/dev/null 2>&1
    cp -f $SRCDIR/cpanel/uninstall_plugins.sh $MKTGOODIR >/dev/null 2>&1
    cp -r $SRCDIR/cpanel/marketgoo/ $THEMEDIR/ >/dev/null 2>&1

    $MKTGOODIR/install_plugins.sh
}

uninstall_whm_addon()
{
    echo "${WHITE}Uninstalling WHM AddOn${RESET}"

    rm -rf $WHMROOT/docroot/marketgoo/ >/dev/null 2>&1
    rm -rf $WHMROOT/docroot/cgi/addon_marketgoo.cgi >/dev/null 2>&1
    rm -rf $WHMROOT/docroot/themes/x/icons/marketgoo.gif >/dev/null 2>&1
    rm -rf $MKTGOODIR
}

uninstall_cpanel_plugin()
{
    $MKTGOODIR/uninstall_plugins.sh
    rm -rf $THEMEDIR/marketgoo >/dev/null 2>&1
    rm -rf $MKTGOODIR
}


trap cleanup HUP PIPE INT QUIT TERM EXIT

if [ $EUID != 0 ]; then
    echo
    echo "${RED}***** You must be root to install *****${RESET}"
    echo "${WHITE}Please login as root or use sudo and try again...${RESET}"
    echo
    exit
fi

if [ ! -f /usr/local/cpanel/version ]; then
    echo
    echo "${RED}***** Cpanel not found *****${RESET}"
    echo "${WHITE}Are you sure you're running this on a Cpanel server?${RESET}"
    echo
    exit
fi

if [ ! -f /usr/local/cpanel/Cpanel/LiveAPI.pm ]; then
    echo
    echo "${RED}***** Cpanel::LiveAPI not found. *****${RESET}"
    echo "${WHITE}MarketGoo Plugin requires Cpanel::LiveAPI.${RESET}"
    echo "Please ensure you are running at least Cpanel version 11.32.2."
    echo "(current Cpanel version: $CPVERSION)"
    echo
    exit
fi

echo
echo "${CYAN}Installing MarketGoo plug-in for cPanel/WHM${RESET}"
if [ -d $MKTGOODIR ]; then
    PREVIOUS=`cat $MKTGOODIR/VERSION`
    echo "${GREEN} +++ Detected previous MarketGoo plug-in v${PREVIOUS}. Upgrading.${RESET}"
    uninstall_cpanel_plugin && uninstall_whm_addon
fi
download_latest && install_whm_addon && install_cpanel_plugin
echo "${GREEN}*** DONE ***${RESET}"
echo
