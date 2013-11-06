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
#   UNISTALLER
#
#   Download and execute this file in your shell:
#   $ curl -LO http://raw.github.com/marketgoo/cpanel.plugin/master/marketgoo-uninstall.sh
#   $ /bin/sh ./marketgoo-install.sh
#
#   Execute installer directly from GitHub
#   $ curl -Lks http://raw.github.com/marketgoo/cpanel.plugin/master/marketgoo-uninstall.sh | sh
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
echo "${CYAN}Uninstalling MarketGoo plug-in for cPanel/WHM${RESET}"
uninstall_cpanel_plugin && uninstall_whm_addon
echo "${GREEN}*** DONE ***${RESET}"
echo
