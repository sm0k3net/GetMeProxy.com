<?php
namespace ProxyChecker;
require_once '/var/www/getmeproxy/www/proxy-checker/config/ProxyChecker.php';
$pingUrl = 'http://tools.sm0k3.net/hub/gate.php';
$proxyChecker = new ProxyChecker($pingUrl);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require_once '../inc/header.php'; ?>
<div class="container">
	<div class="col-lg-7">
		<h1><a href="//getmeproxy.com/proxy-checker/" title="free proxy checker">Free Online Proxy Checker</a></h1>
		<p>Maximum 25 IPs can be checked, 1 IP per line (removes duplicates, shows only working results).</p>
		<form action="#" method="post">
		<div class="form-group">
		<textarea name="proxy-list" rows="18" cols="85"><?php echo htmlspecialchars($_POST['proxy-list']); ?></textarea>
		<input type="submit" name="submit" value="Check my proxies" class="btn btn-block btn-primary" />
		</div>
		</form>

<?php
function progress($item) {
	echo $item;
	ob_flush();
	flush();
}

$check_proxies = array();
$proxy_list = trim($_POST['proxy-list']);
$submit_check = $_POST['submit'];
$countLines = count(array_unique(preg_split("/((\r?\n)|(\r\n?))/", $proxy_list)));

if(isset($submit_check) && !empty($proxy_list) && $countLines <= '25') {
	foreach(array_unique(preg_split("/((\r?\n)|(\r\n?))/", $proxy_list)) as $line){
	if(preg_match("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}:\d{1,5}/", $line)) {
    $check_proxies[] = $line;
    	}
	} 

$proxy_check = $check_proxies;
$results = $proxyChecker->checkProxies($proxy_check);
foreach($results as $i) {
	if(!empty($i['proxy_level'])) {
		$proxy_level = $i['proxy_level'];
		$proxy_ip = $i['info']['primary_ip'].":".$i['info']['primary_port'];
		$speed = $i['info']['total_time'];
		$workingProxy .= $proxy_ip."<br>";
		$proxyStats .= "<b>Anonymity:</b> ".$proxy_level." <b>Speed:</b> ".$speed."<br>";
	}
	
	} progress("Total proxies were checked: ".$countLines."<div class='row'><div class='col-lg-6'><pre>".$workingProxy."</pre></div><div class='col-lg-6'><pre>".$proxyStats."</pre></div></div>");
} elseif(isset($submit_check) && !empty($proxy_list) && $countLines > '25') {
	echo "<h4>You have entered ".$countLines." proxies, please reduce it to 25 in list.</h4>";
} elseif(isset($submit_check) && empty($proxy_list)) {
	echo "<h4>You didn't enter any proxy in list...</h4>";
}

?>

	</div>
</div>
<?php require_once '../inc/footer.php'; ?>