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
##############################################################################

WHITE=$(tput setaf 7 ; tput bold)
RESET=$(tput sgr0)
CWD=`dirname $0`
UNINSTALL_CMD=/usr/local/cpanel/bin/unregister_cpanelplugin

display_progress()
{
    echo "${WHITE}0%           25%            50%           75%           100%${RESET}"
}

advance_progress()
{
    echo -n "=============================="
}

echo "${WHITE}Uninstalling cPanel Plugins${RESET} (This may take a couple minutes)"

# Uninstall plugins
display_progress && $UNINSTALL_CMD $CWD/plugins/website_marketing_tools.cpanelplugin >/dev/null 2>&1

# Uninstall the Group
advance_progress && $UNINSTALL_CMD $CWD/plugins/marketgoo.cpanelplugin >/dev/null 2>&1

advance_progress && /usr/local/cpanel/bin/rebuild_sprites >/dev/null 2>&1
echo
