<?php require_once '../inc/header.php'; ?>

<div class="container">
	<div class="col-lg-12">
	<h1>Get Me Proxy API Documentation</h1>
	<b>API Url: </b><input type="text" disabled value=" https://getmeproxy.com/api/v1.0/api.php?key=" size="40"/>
	<p><a href="https://getmeproxy.com/api/" target=_blank rel="nofollow">Here you can find api access page</a></p>
	<p><a href="https://getmeproxy.com/api/register.php">Register for FREE API access</a></p>
	<h3>Full API Access</h3>
	<p>Full access to our proxy database is available only for payed users. Newest proxies going first in any type of output (descending order).</p>
	<p><b>Output formats:</b>
	<li>In format of structured array</li>
	<li>In JSON format</li>
	<li>Simple IP list without additional information</li></p>
	<p><b>Accepted request methods:</b> <li>GET</li></p>
	<p><b>Available parameters:</b>
	<ul>
		<li><b>c</b> - sorting proxies by country code (i.e.: RU, DE etc)</li>
		<li><b>p</b> - sorting by protocol type (i.e.: http, https)</li>
		<li><b>a</b> - sorting by anonymity level (possible options: none, medium, high), you can also exclude all "none anonymous proxies" using "medium+high" OR "high+medium"</li>
		<li><b>checked</b> - sorting proxies by checked (live) and all others (i.e.: checked=1)</li>
		<li><b>s</b> - sorting proxies by speed in ms(i.e.: 1, 2, 5.5)</li>
	</ul>
	<i>Parameters can be used in any order you wish</i>
	</p>
	<p><b>How to use output format parameter:</b>
	<ul>
		<li><b>list</b> - creates an array</li>
		<li><b>list=text</b> - creates plaintext list of IP addresses with ports</li>
		<li><b>list=json</b> - creates output in JSON format</li>
	</ul>
	</p>
	<p><h4>Usage example</h4>
	<pre>getmeproxy.com/api/v1.0/api.php?key=yourapikey&c=us&checked=1&p=https&a=high&s=5&list</pre>
	This request will return you: only United States HTTPS checked proxy list in formated array with highest anonymity level (high) and speed 5ms or less.</p>
	<p>If you want to get JSON formated output, than you will need  to change "list" for "list=json":
	<pre>getmeproxy.com/api/v1.0/api.php?key=yourapikey&c=us&checked=1&p=https&a=high&s=5&list=json</pre>
	<br>
	<h3>Demo API Access</h3>
	<p>In case you wish to test our API and want to get a demo, than you just need to use API key "demo":
	<pre>getmeproxy.com/api/v1.0/api.php?key=demo&c=ru&list=text</pre>
	Or with array output:
	<pre>getmeproxy.com/api/v1.0/api.php?key=demo&c=ru&list</pre>
	<p><b>Demo</b> access is limited by only 5 results in output, only HTTP protocol and lowest anonymity level.</p>
	<br><h3>Code example</h43>
	<p>
	<pre>//FOR PHP
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"https://getmeproxy.com/api/v1.0/api.php?key=yourapikey&checked=1&speed=1&p=https&a=high&list=json");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec($ch);
	curl_close($ch);
	$i = json_decode($server_output);
	foreach($i as $a) {
	echo $a->proxy." - ".$a->type." - ".$a->anonymity." - ".$a->country."<\br>";
	}</pre>
	</p>
	</div>
</div>

<?php require_once '../inc/footer.php'; ?>