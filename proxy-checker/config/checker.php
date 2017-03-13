<?php
namespace ProxyChecker;
require_once '/var/www/getmeproxy/www/proxy-checker/config/ProxyChecker.php';
$pingUrl = 'http://tools.sm0k3.net/hub/gate.php';
$proxyChecker = new ProxyChecker($pingUrl);

$proxy_check = array($_GET['proxies']);
$results = $proxyChecker->checkProxies($proxy_check);
print_r($_GET['proxies']);
foreach($results as $i) {
	if(!empty($i['proxy_level'])) {
		$proxy_level = $i['proxy_level'];
		$proxy_ip = $i['info']['primary_ip'].":".$i['info']['primary_port'];
		$speed = $i['info']['total_time'];
		echo "ip:".$proxy_ip." ;speed:".$speed." ;anonymity:".$proxy_level."\r\n";
	} else {
		echo "<li>Error</li>";
	}
	
}
