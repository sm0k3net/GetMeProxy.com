<?php
require_once 'conn.php';
require_once 'pagination.php';

$proxy_total = mysql_fetch_row(mysql_query("SELECT COUNT(proxy) FROM tools_proxy WHERE updated > DATE_SUB(CURDATE(), INTERVAL 23 HOUR)"));
$live_proxy = mysql_fetch_row(mysql_query("SELECT COUNT(proxy) FROM tools_proxy WHERE status = 'live' AND updated > DATE_SUB(CURDATE(), INTERVAL 23 HOUR)"));
$sorted_proxy = mysql_fetch_row(mysql_query("SELECT COUNT(proxy) FROM tools_proxy WHERE location <> '' AND updated > DATE_SUB(CURDATE(), INTERVAL 23 HOUR)"));
$https_proxy = mysql_fetch_row(mysql_query("SELECT COUNT(proxy) FROM tools_proxy WHERE type = 'https' AND updated > DATE_SUB(CURDATE(), INTERVAL 23 HOUR)"));
$anon_proxy = mysql_fetch_row(mysql_query("SELECT COUNT(proxy) FROM tools_proxy WHERE anonymity = 'elite' AND updated > DATE_SUB(CURDATE(), INTERVAL 23 HOUR)"));
$latest_update = mysql_fetch_row(mysql_query("SELECT updated FROM tools_proxy WHERE updated > DATE_SUB(CURDATE(), INTERVAL 23 HOUR) ORDER BY updated desc LIMIT 1"));
$api_users = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM getmeproxy_payments"));

$sort_by_country = mysql_query("SELECT location, proxy FROM tools_proxy WHERE updated > DATE_SUB(CURDATE(), INTERVAL 23 HOUR) GROUP BY location");
while($row_country = mysql_fetch_array($sort_by_country)) {
	$country_type .= "<option value='".$row_country['location']."'>".$row_country['location']."</option>";
}

//Pagination
$adjacents = 4;
$page = intval($_GET["page"]);
if($page<=0) $page = 1;
$reload = dirname($_SERVER['PHP_SELF']);

$location = mysql_real_escape_string(trim($_POST['country']));
$type = mysql_real_escape_string(trim($_POST['type']));
$status = mysql_real_escape_string(trim($_POST['status']));
$download = mysql_real_escape_string(trim($_POST['download']));
$speed = mysql_real_escape_string(trim($_POST['speed']));
$show_old = trim($_POST['old']);
$show = $_POST['show'];
$anonymity_search = mysql_real_escape_string(trim($_POST['anonymity']));

if($show_old == 'asc') {
	$sort_order = 'asc';
} else {
	$sort_order = 'desc';
}

if($anonymity_search == "high") {
    $anon = "elite";
} elseif($anonymity_search == "medium") {
    $anon = "anonymous";
} elseif($anonymity_search == "transparent") {
    $anon = "transparent";
}

$query = "SELECT * FROM tools_proxy WHERE location LIKE '%{$location}%' AND type LIKE '%{$type}' AND status LIKE '%{$status}%' AND conn_time LIKE '{$speed}%' AND anonymity LIKE '%{$anon}%' AND updated > DATE_SUB(CURDATE(), INTERVAL 23 HOUR) ORDER BY  updated $sort_order";

$get_data = mysql_query($query);

if(!isset($show)) {
	$rpp = 15;
	$show_found_records = '';
} else {
	$rpp = 1000;
	$show_found_records = '<p><span class="label label-default">Total results found: '.mysql_num_rows($get_data).'</span></p>';
}

	//Pagination
	$tcount = mysql_num_rows($get_data);
	$tpages = ($tcount) ? ceil($tcount/$rpp) : 1;
	$count = 0;
	$i = ($page-1)*$rpp;
	while(($count<$rpp) && ($i<$tcount)) {
		mysql_data_seek($get_data, $i);
		$row_data = mysql_fetch_array($get_data);


	if($row_data['status'] == 'live') {
		$state = "<span class='label label-success'><span class='glyphicon glyphicon-ok-sign'></span></span>";
	} else {
		$state = "<span class='label label-danger'><span class='glyphicon glyphicon-question-sign'></span></span>";
	}

	if($row_data['type'] == 'https') {
		$type_state = "<span class='label label-success'>HTTPS</span>";
	} else {
		$type_state = "<span class='label label-warning'>HTTP</span>";
	}

    if($row_data['anonymity'] == 'elite') {
        $anon_level = "<span class='label label-success'>HIGH</span>";
    } elseif($row_data['anonymity'] == 'anonymous') {
        $anon_level = "<span class='label label-warning'>MEDIUM</span>";
    } elseif($row_data['anonymity'] == 'transparent') {
        $anon_level = "<span class='label label-danger'>NONE</span>";
    }

	

	$proxy_ip = base64_encode($row_data['proxy']);
	$proxy_list .= "<tr><td><script type='text/javascript'>document.write(Base64.decode(\"".$proxy_ip."\"))</script></td><td>".$type_state."</td><td>".$row_data['location']."</td><td>".$row_data['region']."</td><td>".$anon_level."</td><td>".$row_data['conn_time']." ms</td><td>".$state."</td></tr>";
	$file_data .= $row_data['proxy'].";".$row_data['type'].";".$row_data['location']."\r\n";
	$i++;
	$count++;
}

	if(!empty($download) == 'yes') {
		$file_name = rand(100000, 1000000);
		    $handle = fopen("/var/www/getmeproxy/www/tmp/".$file_name.".txt", "w");
    		fwrite($handle, $file_data);
    		fclose($handle);
    		header('Content-Type: application/octet-stream');
    		header('Content-Disposition: attachment; filename='.basename('/var/www/getmeproxy/www/tmp/'.$file_name.'.txt'));
    		header('Expires: 0');
    		header('Cache-Control: must-revalidate');
    		header('Pragma: public');
    		header('Content-Length: ' . filesize('/var/www/getmeproxy/www/tmp/'.$file_name.'.txt'));
    		readfile('/var/www/getmeproxy/www/tmp/'.$file_name.'.txt');
    		unlink('/var/www/getmeproxy/www/tmp/'.$file_name.'.txt');
    		exit;

		
	}

?>
<!DOCTYPE html>
<html lang="en">
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<link href="//getmeproxy.com/assets/css/bootstrap.min.css" rel="stylesheet">
 	<meta name="keywords" content="free, proxy, free proxy list, get proxies, online web proxy, proxy service">
 	<meta name="description" content="Get Me Proxy - is a free online proxy service providing up to date proxy lists and free web proxy access">
 	<link rel="icon" type="image/png" href="//getmeproxy.com/assets/img/favicon.png" />
 	<title>Get Me Proxy - Free Proxy Service</title>
 </head>
 <body>

 <script type="text/javascript">var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}</script>
 

     <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="//getmeproxy.com/">Get Me Proxy <small>free online proxy service</small></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="/">Home</a></li>
            <li><a href="//getmeproxy.com/api/">API</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">F.A.Q <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">General questions</li>
                <li><a href="//getmeproxy.com/info/get-me-proxy-manual.php">Get Me Proxy manual</a></li>
                <li><a href="//getmeproxy.com/info/what-is-proxy.php">What is proxy?</a></li>
                <li><a href="//getmeproxy.com/info/how-to-use-proxy.php">How to use proxy?</a></li>
                <li><a href="//getmeproxy.com/info/proxy-anonymity-and-anonymity.php">Proxy types & anonymity</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">API</li>
                <li><a href="//getmeproxy.com/info/getmeproxy-api-access.php">About API access</a></li>
              </ul>
            </li>
            <li><a href="//getmeproxy.com/info/about.php">About</a></li>
            <li><a href="//getmeproxy.com/info/contacts.php">Contacts</a></li>
            <li><!-- AddToAny BEGIN -->
                <a class="a2a_dd" href="https://www.addtoany.com/share" rel="nofollow"><img src="https://static.addtoany.com/buttons/share_save_171_16.png" width="171" height="16" border="0" alt="Share"/></a>
                <script async src="https://static.addtoany.com/menu/page.js"></script>
                <!-- AddToAny END -->
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          	<li><a href="https://getmeproxy.com/info/donate.php" target=_blank rel="nofollow">Donate</a></li>
            <li><a href="https://getmeproxy.com/web/disclaimer.php" target=_blank rel="nofollow">Disclaimer</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>