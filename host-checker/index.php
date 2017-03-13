<?php require_once '../inc/header.php'; 
$timeout = intval("3");

//United States
$get_random_proxy_us = mysql_query("SELECT * FROM tools_proxy WHERE location = 'US' AND status = 'live' AND type = 'https' AND conn_time <= '$timeout' ORDER BY updated desc");
$us_proxy = mysql_fetch_row($get_random_proxy_us);

//Great Britain
$get_random_proxy_gb = mysql_query("SELECT * FROM tools_proxy WHERE location = 'GB' AND status = 'live' AND type = 'https' AND conn_time <= '$timeout' ORDER BY updated desc");
$gb_proxy = mysql_fetch_row($get_random_proxy_gb);

//Denmark
$get_random_proxy_de = mysql_query("SELECT * FROM tools_proxy WHERE location = 'DE' AND status = 'live' AND type = 'https' AND conn_time <= '$timeout' ORDER BY updated desc");
$de_proxy = mysql_fetch_row($get_random_proxy_de);

//Russia
$get_random_proxy_ru = mysql_query("SELECT * FROM tools_proxy WHERE location = 'RU' AND status = 'live' AND type = 'https' AND conn_time <= '$timeout' ORDER BY updated desc");
$ru_proxy = mysql_fetch_row($get_random_proxy_ru);

//New Zealand
//$get_random_proxy_cn = mysql_query("SELECT * FROM tools_proxy WHERE location = 'CN' AND status = 'live' AND type = 'https' AND conn_time <= '$timeout' ORDER BY updated desc");
//$cn_proxy = mysql_fetch_row($get_random_proxy_cn);

//France
$get_random_proxy_fr = mysql_query("SELECT * FROM tools_proxy WHERE location = 'FR' AND status = 'live' AND type = 'https' AND conn_time <= '$timeout' ORDER BY updated desc");
$fr_proxy = mysql_fetch_row($get_random_proxy_fr);

//Netherlands
$get_random_proxy_nl = mysql_query("SELECT * FROM tools_proxy WHERE location = 'NL' AND status = 'live' AND type = 'https' AND conn_time <= '$timeout' ORDER BY updated desc");
$nl_proxy = mysql_fetch_row($get_random_proxy_nl);

function detectCountry($ip_addr) {
	$url = "http://ip-api.com/xml/".$ip_addr;
	$xml = simplexml_load_file($url);
	$country = $xml->country;
	return $country;
}

function responseLabel($code) {
	$bad = '0';
	$good = '200';
	if($code == $bad) {
		$label = 'class=\'danger\'';
	} elseif($code == $good) {
		$label = 'class=\'success\'';
	} else {
		$label = 'class=\'warning\'';
	}
	return $label;
}

	$url = gethostbyname(trim($_POST['host']));
	$agent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36";
	$referer = "https://google.com/";
	$domain = explode("://", $url);
	$remote_ip = gethostbyname($domain[1]);
	if(isset($_POST['go']) && !empty($url)) {
	$proxies = array($us_proxy[1], $gb_proxy[1], $de_proxy[1], $ru_proxy[1], $fr_proxy[1], $nl_proxy[1]);


	$mc = curl_multi_init ();
	for ($thread_no = 0; $thread_no<count ($proxies); $thread_no++)
	{
	$c [$thread_no] = curl_init ();
	curl_setopt ($c [$thread_no], CURLOPT_URL, $url);
	curl_setopt ($c [$thread_no], CURLOPT_HEADER, 0);
	curl_setopt ($c [$thread_no], CURLOPT_USERAGENT, $agent);
	curl_setopt ($c [$thread_no], CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt ($c [$thread_no], CURLOPT_REFERER, $referer);
	curl_setopt ($c [$thread_no], CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($c [$thread_no], CURLOPT_CONNECTTIMEOUT, 10);
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
	$location = detectCountry($info['primary_ip']);
	$labelCode = responseLabel($info['http_code']);
	if($info['http_code'] == '0') {
		$info_code = 'Dead Proxy';
	} else {
		$info_code = $info['http_code'];
	}

	$hostResults .= "<tr ".$labelCode."><td>".$location."</td><td>".$info['primary_ip']."</td><td>".$remote_ip."</td><td>".$info['total_time']." ms</td><td>".$info['connect_time']." ms</td><td>".$info_code."</td><td>".htmlspecialchars($domain[1])."</td></tr>";
	
	
curl_multi_remove_handle ($mc, $done ['handle']);
}
} while ($running);
curl_multi_close ($mc);
}
?>
<div class="container">
	<div class="col-lg-12">
	<h1><a href="https://getmeproxy.com/host-checker/" title="free online host availability checker">Host Availability Checker</a></h1>
	<p>To start check of your website or server, please enter IP address or website name including protocol type (HTTP/HTTPS, i.e.: https://getmeproxy.com)</p>
	<form action="#" method="post">
		<input type="text" name="host" />
		<input type="submit" name="go" value="Check Host" />
	</form>
	<br>
<?php 
if(isset($_POST['go']) && !empty($url)) {
?>
	<p>Possibly your host works fine! If 1 or 2 locations didn't respond, that is fine (possibly, servers are temporary unavailable).</p>
	<table class="table table-bordered">
	<thead><tr><th>Country</th><th>Source IP (From)</th><th>Target IP (To)</th><th>Total Time</th><th>Conn. time</th><th>HTTP Code</th><th>Target Host</th></tr></thead>
	<tbody><?php echo $hostResults; ?></tbody>
	</table>
<?php
	}
?>
	</div>
</div>
<?php require_once '../inc/footer.php'; ?>