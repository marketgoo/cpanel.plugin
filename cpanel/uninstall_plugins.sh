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
    echo -n "=========="
}

echo "${WHITE}Uninstalling cPanel Plugins${RESET} (This may take a couple minutes)"
display_progress

# Uninstall plugins
$UNINSTALL_CMD $CWD/plugins/free_seo_starter_pack.cpanelplugin >/dev/null 2>&1
advance_progress && $UNINSTALL_CMD $CWD/plugins/optimize_website.cpanelplugin >/dev/null 2>&1
advance_progress && $UNINSTALL_CMD $CWD/plugins/increase_visibility.cpanelplugin >/dev/null 2>&1
advance_progress && $UNINSTALL_CMD $CWD/plugins/improve_social_media.cpanelplugin >/dev/null 2>&1
advance_progress && $UNINSTALL_CMD $CWD/plugins/analyze_competitors.cpanelplugin >/dev/null 2>&1
advance_progress && $UNINSTALL_CMD $CWD/plugins/monitor_results.cpanelplugin >/dev/null 2>&1

# Uninstall the Group
advance_progress && $UNINSTALL_CMD $CWD/plugins/marketgoo.cpanelplugin >/dev/null 2>&1

/usr/local/cpanel/bin/rebuild_sprites >/dev/null 2>&1
echo
