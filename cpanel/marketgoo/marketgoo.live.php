<?php

require("/usr/local/cpanel/php/cpanel.php");

class Mktgoo {

	var $cpanel;
	var $uuid;
	var $target;

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
	}

	function __destruct()
	{
		$this->cpanel->end();
	}

	public function is_registered()
	{
		return !empty($this->uuid);
	}

	public function open_site()
	{
		header("Location: https://panel.marketgoo.com/".$this->target."?action=login&uuid=".$this->uuid);
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
		$this->cpanel->api1("Branding", "include", array("stdheader.html"));
		$html = $this->cpanel->get_result();
		return preg_replace("/index\.html/", "../index.html", $html);
	}

	public function html_footer()
	{
		$this->cpanel->api1("Branding", "include", array("stdfooter.html"));
		$html = $this->cpanel->get_result();
		return preg_replace("/index\.html/", "../index.html", $html);
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