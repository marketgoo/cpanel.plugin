<?php

/*
 *                         _        _
 *                        | |      | |
 *    _ __ ___   __ _ _ __| | _____| |_ __ _  ___   ___
 *   | '_ ` _ \ / _` | '__| |/ / _ \ __/ _` |/ _ \ / _ \
 *   | | | | | | (_| | |  |   <  __/ || (_| | (_) | (_) |
 *   |_| |_| |_|\__,_|_|  |_|\_\___|\__\__, |\___/ \___/
 *                                      __/ |
 *   MarketGoo Plug-in for cPanel      |___/
 *
 */

define("MKTGOO_PARTNERID_FILE", ".marketgoo_partner_id");
define("MKTGOO_REMOTE_REPOSITORY", "github.com/marketgoo/cpanel.plugin");

//-----------------------------------------------------------------------------
function generate_partnerid()
{
	$index = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$base  = strlen($index);

	mt_srand(microtime(true) * 100000 + memory_get_usage(true));
	$in = mt_rand().microtime(true);

	$out = "";
	for ($t = floor(log($in, $base)); $t >= 0; $t--) {
		$bcp = pow($base, $t);
		$a   = floor($in / $bcp) % $base;
		$out = $out.substr($index, $a, 1);
		$in  = $in - ($a * $bcp);
	}
	return substr($out, 0, 10);
}

//-----------------------------------------------------------------------------
function get_partnerid()
{
	$usr = posix_getpwnam($_SERVER["REMOTE_USER"]);
	if (!file_exists($usr["dir"]."/".MKTGOO_PARTNERID_FILE)) {
		$new_partner_id = generate_partnerid();
		file_put_contents($usr["dir"]."/".MKTGOO_PARTNERID_FILE, $new_partner_id);
		return $new_partner_id;
	} else {
		return file_get_contents($usr["dir"]."/".MKTGOO_PARTNERID_FILE);
	}
}

//-----------------------------------------------------------------------------
function get_host_partnerid()
{
	$usr = posix_getpwuid(0);
	if (!file_exists($usr["dir"]."/".MKTGOO_PARTNERID_FILE)) {
		$new_partner_id = generate_partnerid();
		file_put_contents($usr["dir"]."/".MKTGOO_PARTNERID_FILE, $new_partner_id);
		return $new_partner_id;
	} else {
		return file_get_contents($usr["dir"]."/".MKTGOO_PARTNERID_FILE);
	}
}

//-----------------------------------------------------------------------------
function get_remote_version()
{
	static $remote_version = "";

	if (empty($remote_version)) {
		$remote_version = @file_get_contents("https://raw.".MKTGOO_REMOTE_REPOSITORY."/master/VERSION");
	}
	return $remote_version;
}

//-----------------------------------------------------------------------------
function get_installed_version()
{
	static $local_version = "";

	if (empty($local_version)) {
		$local_version = @file_get_contents("/var/cpanel/marketgoo/VERSION");
	}
	return $local_version;
}


//-----------------------------------------------------------------------------
function is_new_version_available()
{
	$remote = get_remote_version();
	$local  = get_installed_version();

	return strlen($remote) && strlen($local) && ($remote != $local);
}


?>