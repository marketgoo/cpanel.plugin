MarketGoo plugin for cPanel
===========================

MarketGoo is the most complete website marketing app offered to SMBs.

MarketGoo integrates with your host perfectly as a cPanel application for an easy deployment and activation.

Installing the plugin
---------------------

To install the plugin, you need to login to the cPanel server as root and issue the following command:

    curl -Lks http://git.io/marketgoo.cpanel.install | sh

Your WHM panel will reflect the new plugin under the "Plugins" menu. You don't need to do any additional steps, and now MarketGoo services will be available to all your users!

The plugin will warn you if a new version of the plugin is available. To update the plugin, just use the same installation commmand line:

    curl -Lks http://git.io/marketgoo.cpanel.install | sh


Uninstalling the plugin
-----------------------

To uninstall, login to the cPanel server as root and use the following command:

    curl -Lks http://git.io/marketgoo.cpanel.uninstall | sh


Getting support
---------------

If you have trouble with the plugin, please create an issue here in github or contact us at support@marketgoo.com


Changelog
---------

    1.0.4    Updated installation script to use AppConfig for WHM 11.38+
    1.0.3    Added instructions about how to connect to our Partner Portal.
    1.0.2    Using 'curl' now instead of 'wget' to retrieve plugin files.
