#!/usr/local/cpanel/3rdparty/bin/perl
#WHMADDON:marketgoo:MarketGoo Configuration

use lib '/usr/local/cpanel';
use Cpanel::cPanelFunctions ();
use Cpanel::Config          ();

print "Content-type: text/html\r\n\r\n";

my $security_token = $ENV{'cp_security_token'} || '';
print "<meta http-equiv=\"refresh\" content=\"0;url=$security_token/marketgoo/index.php\"/>";
