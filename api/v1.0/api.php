<?php
require_once '../../inc/conn.php';

//Request method
$method = $_SERVER['REQUEST_METHOD'];

//Access limitation
$key = mysql_real_escape_string(stripslashes(trim($_GET['key'])));

//Input variables
$country_code = mysql_real_escape_string(trim(stripslashes($_GET['c'])));
$protocol_type = mysql_real_escape_string(trim(stripslashes($_GET['p'])));
$checked_only = intval($_GET['checked']);
$anonymity_level = trim($_GET['a']);
$proxy_speed = intval(trim($_GET['s']));
$format = mysql_real_escape_string(trim(stripslashes($_GET['f'])));
$output_type = trim($_GET['list']);

//Rules
if(isset($country_code)) {
	$cc = $country_code;
} else {
	$cc = '';
}
if(isset($protocol_type)) {
	$proto = $protocol_type;
} else {
	$proto = '';
}
if(!empty($checked_only) == '1') {
	$checked = 'live';
} else {
	$checked = '';
}
if(isset($anonymity_level)) {
	$anon = $anonymity_level;
	if($anon == 'high') {
		$anon = 'elite';
		$anon_type = "AND anonymity LIKE '%{$anon}%'";
	} elseif($anon == 'medium') {
		$anon = 'anonymous';
		$anon_type = "AND anonymity LIKE '%{$anon}%'";
	} elseif($anon == 'none') {
		$anon = 'transparent';
		$anon_type = "AND anonymity LIKE '%{$anon}%'";
	} elseif($anon == 'medium high' || $anon == 'high medium') {
		$anon_type = "AND anonymity <> 'transparent'";
	} else {
		$anon = '';
		$anon_type = "AND anonymity LIKE '%{$anon}%'";
	}
} else {
	$anon = '';
}
if(!empty($proxy_speed)) {
	$speed = " AND conn_time <= '{$proxy_speed}'";
}

//API key validation
$find_key = mysql_query("SELECT * FROM getmeproxy_payments WHERE `key` = '$key'");
while($row_key = mysql_fetch_array($find_key)) {
	$valid_key = $row_key['key'];
}

//Execution
if($method == 'GET' && $valid_key === $key || $method == 'GET' && $key === 'demo') {
	if($key == 'demo') { $api_limit = "LIMIT 5"; $proto = 'http'; $anon_type = "AND anonymity LIKE 'transparent'"; } else { $api_limit = ""; }
	$query = "SELECT * FROM tools_proxy WHERE location LIKE '%{$cc}%' AND type LIKE '%{$proto}' AND status LIKE '%{$checked}' $anon_type $speed ORDER BY updated desc $api_limit";
	$searchProxy = mysql_query($query);
	while($row = mysql_fetch_array($searchProxy)) {
		$proxy[] = array(
			"proxy" => $row['proxy'],
			"type" => $row['type'],
			"anonymity" => $row['anonymity'],
			"speed" => $row['conn_time'],
			"country" => $row['location'],
			"status" => $row['status'],
			);
			
	}
//Result output
		//foreach($proxyList as $proxy) {
			if(empty($output_type)) {
				echo "<pre>";
				print_r($proxy);
				echo "</pre>";
			} elseif($output_type == 'text') {
				foreach($proxy as $ip) {
					echo $ip['proxy']."<br>";
				}
			} elseif($output_type == 'json') {
				echo json_encode($proxy);
			}

} else {
	echo "Sorry, but your API key is not valid or has expired!";
}
?>