<?php
require_once '../../inc/simple_html_dom.php';
require_once '../../inc/conn.php';
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//GET OLD PROXY LIST

$get_proxies = mysql_query("SELECT * FROM tools_proxy WHERE type = 'http'");
while($get_proxies_row = mysql_fetch_array($get_proxies)) {
	$check_proxies .= $get_proxies_row['proxy']; $proxies_status = $get_proxies_row['status'];
	
}

//HTTP
$ch_http = curl_init();

curl_setopt($ch_http, CURLOPT_URL,"http://proxy-ip-list.com/free-usa-proxy-ip.html");
curl_setopt($ch_http, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch_http, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch_http, CURLOPT_RETURNTRANSFER, true);

$server_output_http = curl_exec ($ch_http);

curl_close ($ch_http);

$html_http = str_get_html($server_output_http);

//$ip_http = array();
//$port_http = array();
//$proxy_http = array();

foreach($html_http->find('td') as $item_http) {
	
	//echo "<li>".$item."</li>";
	
	if(preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}:\d{1,5}/', $item_http, $ip_address_http)) {
		$ip_http = $ip_address_http[0];
	}

	if(preg_match('/:\d{1,5}/', $item_http, $port_number_http)) {
		$port_http = $port_number_http[0];
	}

	if(preg_match('/\d{1,2}\s+\w+\s', $item_http, $date_http) || preg_match('/\d{1,2}\s+\w+\s+/', $item_http, $date_http)) {
		$update_date_http = $date_http[0];
	}

	if(preg_match('/\s+no\s+\d+/', $item_http, $state_http)) {
		$proxy_state_http = $state_http[0];
	}

	//echo "<li>".$ip.":".$port."</li>";
	$proxy_http[] = $ip_http;
	
	
}

$result_http = implode("", array_unique($proxy_http));

$proxies = array_unique($proxy_http);
$mc = curl_multi_init ();
for ($thread_no = 0; $thread_no<count ($proxies); $thread_no++)
{
$c [$thread_no] = curl_init ();
curl_setopt ($c [$thread_no], CURLOPT_URL, "http://google.com");
curl_setopt ($c [$thread_no], CURLOPT_HEADER, 0);
curl_setopt ($c [$thread_no], CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($c [$thread_no], CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt ($c [$thread_no], CURLOPT_TIMEOUT, 10);
curl_setopt ($c [$thread_no], CURLOPT_PROXY, trim ($proxies [$thread_no]));
curl_setopt ($c [$thread_no], CURLOPT_PROXYTYPE, 0);
curl_multi_add_handle ($mc, $c [$thread_no]);
}

do {
while (($execrun = curl_multi_exec ($mc, $running)) == CURLM_CALL_MULTI_PERFORM);
if ($execrun != CURLM_OK) break;
while ($done = curl_multi_info_read ($mc))
{
$info = curl_getinfo ($done ['handle']);

	
	if(empty($info['http_code'])) {
		echo trim($proxies[array_search ($done['handle'], $c)])." - No HTTP code was returned<br />";
	} else {
	echo trim($proxies[array_search ($done['handle'], $c)])." - ".$info['http_code']."<br />";
	}
$final = array();
if ($info ['http_code'] == 301) {

$final[] = trim($proxies[array_search ($done['handle'], $c)]);

foreach($final as $ip) {
	$connect_time = $info['total_time'];
	if(!empty($ip)) {
		$db_check_query = mysql_query("SELECT * FROM tools_proxy WHERE type = 'http' AND proxy = '$ip'");
		while($row_check = mysql_fetch_array($db_check_query)) {
			$proxy_check = $row_check['proxy']; $status_check = $row_check['status']; $updated_check = $row_check['updated'];
		}

		if($ip != $proxy_check) {
			$store_proxies = mysql_query("INSERT INTO tools_proxy (proxy, type, status, conn_time) VALUES ('$ip', 'http', 'live', '$connect_time')");
		} elseif($ip == $proxy_check && $status_check == 'dead') {
			$update_proxies = mysql_query("UPDATE tools_proxy SET status = 'live', conn_time = '$connect_time' WHERE proxy = '$ip' AND type = 'http'");
		}

	}
}


}

curl_multi_remove_handle ($mc, $done ['handle']);
}
} while ($running);
curl_multi_close ($mc);




?>

