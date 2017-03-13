<?php
namespace ProxyChecker;
require_once '../../inc/conn.php';
require_once '../config/proxycheck/ProxyChecker.php';
require_once '../twitterapi/twitterapi.php';

$pingUrl = 'http://website.com/gate.php';
$proxyChecker = new ProxyChecker($pingUrl);

$proxy_check = array($_GET['proxies']);
$results = $proxyChecker->checkProxies($proxy_check);

foreach($results as $i) {
	//echo "<b>".$i['proxy_level']."</b>";
	if(!empty($i['proxy_level'])) {
		$proxy_level = $i['proxy_level'];
		$proxy_ip = $i['info']['primary_ip'].":".$i['info']['primary_port'];
		$speed = $i['info']['total_time'];
		$store_data = mysql_query("UPDATE tools_proxy SET anonymity = '$proxy_level', conn_time = '$speed', status = 'live' WHERE proxy = '$proxy_ip'");

					//Post to Twitter
                        \Codebird\Codebird::setConsumerKey("YOUR_KEY", "YOUR_KEY");
                        $cb = \Codebird\Codebird::getInstance();
                        $cb->setToken("YOUR_TOKEN", "YOUR_TOKEN");
 
                        $params = array(
                        'status' => 'We have updated our #proxy #database! Some more new proxies were added & checked! #getmeproxy #freeproxy https://getmeproxy.com'
                                                );
                        $reply = $cb->statuses_update($params);

	} else {
		$dead_proxy = mysql_real_escape_string(trim($_GET['proxies']));
		$store_data = mysql_query("UPDATE tools_proxy SET status = 'dead' WHERE proxy = '$dead_proxy'");
	}
}