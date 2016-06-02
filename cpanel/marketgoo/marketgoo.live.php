<?php

require("/usr/local/cpanel/php/cpanel.php");

class Mktgoo {

	const CPANEL_USERS_DIR		= "/var/cpanel/users/";
	const PARTNER_ID_FILENAME	= ".marketgoo_partner_id";

	var $cpanel;
	var $uuid;
	var $target;

	var $username	= "";
	var $props		= array();
	var $locale		= "en";

	var $translations;

	function __construct()
	{
		$this->cpanel = new CPANEL();
		$this->uuid = $this->get_data("mktgoo_uuid");
		$this->target = $this->target_for_item($_GET["item"]);

		if (isset($_GET["signupok"]) && (strlen($_GET["signupok"]) == 40)) {
			$this->uuid = $_GET["signupok"];
			$this->set_data("mktgoo_uuid", $this->uuid);

			$this->target = $this->target_for_item("seopack");
			$this->open_site();
		}

		$this->username = $this->get_username();
		$this->props  = $this->get_user_props();
		$this->locale = $this->get_locale();

		$this->translations = json_decode( file_get_contents("translations.json"), true );
	}

	function __destruct()
	{
		$this->cpanel->end();
	}

	private function get_username()
	{
		return @$_ENV["REMOTE_USER"];
	}

	private function get_user_props()
	{
		$prop_file = self::CPANEL_USERS_DIR . $this->username;

		if (!file_exists($prop_file) || !is_readable($prop_file)) {
			return;
		}

		$lines = array_filter(array_map(function($l){
			$nl = trim($l);
			return strlen($nl) && $nl[0] == '#' ? null : $nl;
		}, explode("\n", file_get_contents($prop_file))));

		$props = array();
		foreach ($lines as $l) {
			$vars = explode("=", $l);
			$props[$vars[0]] = @$vars[1];
		}
		return $props;
	}


	public function translate($seed)
	{
		if (!is_array($this->translations)) return $seed;

		if (array_key_exists($seed, $this->translations[$this->locale])) {
			return $this->translations[$this->locale][$seed];
		} elseif (array_key_exists($seed, $this->translations[$this->locale])) {
			return $this->translations["en"][$seed];
		} else {
			return $seed;
		}
	}

	private function get_partner_id($user = "root")
	{
		$id_file = (($user == "root") ? "/var/cpanel/marketgoo" : "/home/".$user)."/".self::PARTNER_ID_FILENAME;
		return is_readable($id_file) ? file_get_contents($id_file) : "";
	}

	private function get_locale()
	{
		$locale = $this->cpanel->cpanelprint('$lang');
		return !is_null($locale) ? $locale : "en";
	}

	public function is_registered()
	{
		return !empty($this->uuid);
	}

	public function open_site()
	{
		header("Location: https://app.marketgoo.com/".$this->target."?action=login&uuid=".$this->uuid);
		die();
	}

	function set_data($key, $value)
	{
		$rc = $this->cpanel->api1("NVData", "set", array($key, $value));
	}

	function get_data($key)
	{
		$this->cpanel->api2("NVData", "get", array("names" => $key));
		$rc = $this->cpanel->get_result();
		if (count($rc)) return $rc[0]["value"];
		return "";
	}

	public function html_header()
	{
		// Try x3 method of retrieving the header template
		$this->cpanel->api1("Branding", "include", array("stdheader.html"));
		$html = $this->cpanel->get_result();
		if (strlen($html)) {
			// x3 theme
			return preg_replace(["/index\.html/", "@images/@"], ["../index.html", "../images/"], $html);
		} else {
			// Paper lantern theme
			return $this->cpanel->header("Website Marketing Tools", "marketgoo-evolution");
		}
	}

	public function html_footer()
	{
		// Try x3 method of retrieving the header template
		$this->cpanel->api1("Branding", "include", array("stdfooter.html"));
		$html = $this->cpanel->get_result();
		if (strlen($html)) {
			return preg_replace(["/index\.html/", "@images/@"], ["../index.html", "../images/"], $html);
		} else {
			return $this->cpanel->footer();
		}
	}

	public function user_name()
	{
		return $this->username;
	}

	public function user_email()
	{
		$this->cpanel->api1("CustInfo", "getemail", array());
		return $this->cpanel->get_result();
	}

	public function user_domain()
	{
		$this->cpanel->api2("DomainLookup", "getbasedomains", array());
		$rc = $this->cpanel->get_result();
		if (count($rc)) return $rc[0]["domain"];
		return "";
	}

	public function user_ip()
	{
		return isset($this->props["IP"]) ? $this->props["IP"] : @$_SERVER["SERVER_ADDR"];
	}

	public function user_language()
	{
		return strlen($this->locale) > 1 ? substr($this->locale, 0, 2) : "en";
	}

	public function user_country()
	{
		return strlen($this->locale) > 4 ? substr($this->locale, -2) : $this->user_language();
	}

	public function reseller_id()
	{
		return $this->get_partner_id($this->props["OWNER"]);
	}

	public function partner_id()
	{
		return $this->get_partner_id();
	}

	function target_for_item($item)
	{
		switch ($item) {
			case "seopack": return "";
			case "web": return "web";
			case "links": return "links";
			case "social": return "social";
			case "competitors": return "competitors";
			case "results": return "results";
		}
		return "";
	}

}

?>
