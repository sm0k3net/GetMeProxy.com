<?php
proxyCheck($check_proxies) {

$proxies = $check_proxies;
$mc = curl_multi_init ();
for ($thread_no = 0; $thread_no<count ($proxies); $thread_no++)
{
$c [$thread_no] = curl_init ();
curl_setopt ($c [$thread_no], CURLOPT_URL, "https://getmeproxy.com/config/proxycheck/checker.php?proxies=".$proxies [$thread_no]);
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
$data = curl_exec($done['handle']);
//$final = array();
$final = trim($proxies[array_search ($done['handle'], $c)]);
if ($info['http_code'] == 301 || $info['http_code'] == 200 ) {

//var_dump($data);

} else {
 
//echo "error";

}
curl_close($done['handle']);
curl_multi_remove_handle ($mc, $done ['handle']);
}
} while ($running);
curl_multi_close ($mc);
}
?>