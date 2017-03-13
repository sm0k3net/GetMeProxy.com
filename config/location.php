<?php
require_once '../../inc/conn.php';
require_once '../../inc/simple_html_dom.php';
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
$check_proxies = array();
$get_proxies = mysql_query("SELECT * FROM tools_proxy WHERE location = '' AND updated > DATE_SUB(CURDATE(), INTERVAL 1 WEEK)");
while($get_proxies_row = mysql_fetch_array($get_proxies)) {
	$check_proxies[] .= $get_proxies_row['proxy'];
	
}

foreach($check_proxies as $proxy) {
	$ip = explode(":", $proxy);
	$location = json_decode(file_get_contents("http://ipinfo.io/".$ip[0]."/json"));
	$loc = $location->country;
	$region = $location->region;
	$store_countries = mysql_query("UPDATE tools_proxy SET location = '$loc', region = '$region' WHERE proxy = '$proxy'");

}



?>

