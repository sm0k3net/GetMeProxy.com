<?php
require_once '../../inc/simple_html_dom.php';
require_once '../../inc/conn.php';

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//GET OLD PROXY LIST

$get_proxies = mysql_query("SELECT * FROM tools_proxy WHERE type = 'https'");
while($get_proxies_row = mysql_fetch_array($get_proxies)) {
	$check_proxies .= $get_proxies_row['proxy']; $proxies_status = $get_proxies_row['status'];
	
}

//HTTPS
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://www.sslproxies.org/");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

$html = str_get_html($server_output);

$ip = array();
$port = array();
$proxy = array();

foreach($html->find('td') as $item) {
	
	//echo "<li>".$item."</li>";
	
	if(preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/', $item, $ip_address)) {
		$ip = $ip_address[0];
	}

	if(preg_match('/\d{1,5}/', $item, $port_number)) {
		$port = $port_number[0];
	}

	if(preg_match('/\d{1,2}\s+\w+\s', $item, $date) || preg_match('/\d{1,2}\s+\w+\s+/', $item, $date)) {
		$update_date = $date[0];
	}

	//echo "<li>".$ip.":".$port."</li>";
	$proxy[] = $ip.":".$port;
	
}

$result_https = implode("", array_unique($proxy));

$proxies = array_unique($proxy);
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
$final = array();
if ($info ['http_code'] == 301) {

$final[] = trim($proxies[array_search ($done['handle'], $c)]);

foreach($final as $ip) {
	$connect_time = $info['total_time'];
	if(!empty($ip)) {
		$db_check_query = mysql_query("SELECT * FROM tools_proxy WHERE type = 'https' AND proxy = '$ip'");
		while($row_check = mysql_fetch_array($db_check_query)) {
			$proxy_check = $row_check['proxy']; $status_check = $row_check['status']; $updated_check = $row_check['updated'];
		}

		if($ip != $proxy_check) {
			$store_proxies = mysql_query("INSERT INTO tools_proxy (proxy, type, status, conn_time) VALUES ('$ip', 'https', 'live', '$connect_time')");
		} elseif($ip == $proxy_check && $status_check == 'dead') {
			$update_proxies = mysql_query("UPDATE tools_proxy SET status = 'live', conn_time = '$connect_time' WHERE proxy = '$ip' AND type = 'https'");
		}

	}
}


}

curl_multi_remove_handle ($mc, $done ['handle']);
}
} while ($running);
curl_multi_close ($mc);




?>

