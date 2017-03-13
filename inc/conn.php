<?php
$user = 'username';
$password = 'password';
$server = 'localhost';
$dbname = 'getmeproxy';

$link = mysql_connect($server, $user, $password);
mysql_set_charset('utf8',$link);
$db = mysql_select_db($dbname, $link);
?>