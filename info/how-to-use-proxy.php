<?php require_once '../inc/header.php'; ?>

<div class="container">
	<div class="col-lg-12">
		<h1>How to use proxy</h1>
		<p><b>Content: </b><a href="#chrome">Settings for Chrome</a> • <a href="#firefox">Settings for FireFox</a> • <a href="#php-curl">Settings for PHP cURL</a></p>
		<h3 id="chrome">For Google Chrome</h3>
		<p>Click the "Customize and control Google Chrome" button on the toolbar and then select Settings.</p>
		<p><img src="//getmeproxy.com/assets/img/mans/chrome/menu_settings.png" alt="menu settings" /></p>
		<p>Scroll down the list until you see the "Show advanced settings..." link and then click on it.</p>
		<p><img src="//getmeproxy.com/assets/img/mans/chrome/advanced_menu_settings.png" alt="advanced menu settings" /></p>
		<p>Scroll further down the list until you see the Network settings, and then click the "Change proxy settings..." button.</p>
		<p><img src="//getmeproxy.com/assets/img/mans/chrome/proxy_settings.png" alt="proxy settings" /></p>
		<p>On the Internet Properties window, click on the "LAN settings" button.</p>
		<p><img src="//getmeproxy.com/assets/img/mans/chrome/network_settings.png" alt="network settings" /></p>
		<p>In the LAN Settings, uncheck the box that says "Automatically detect settings." And then, in the Proxy Server section, click the checkbox to enable "Use a proxy server for your LAN..."</p>
		<p><img src="//getmeproxy.com/assets/img/mans/chrome/network_proxy_settings.png" alt="network proxy settings" /></p>
		<p>In the Address field, enter the IP Address of your Proxy Server, and the Proxy Server Port Number in the Port field. You will receive the IP Address and Port Number of your Proxy Server(s) in a separate email.</p>
		<br><h3 id="firefox">For FireFox</h3>
		<p>Open the Firefox Menu and select Options and in the Options window click on the Advanced icon</p>
		<p><img src="//getmeproxy.com/assets/img/mans/firefox/mozilla_proxy_1.png" alt="firefox settings" width=840 height="460" /></p>
		<p><img src="//getmeproxy.com/assets/img/mans/firefox/mozilla_proxy_2.png" alt="firefox advanced settings" /></p>
		<p>Select the Network Tab and in the Connection section click the Settings button</p>
		<p>In the Connection Settings window select "Manual Proxy Configuration" and than just input your proxy IP & Port.</p>
		<br><h3 id="php-curl">PHP cURL</h3>
		<p>If you need to use proxy in php curl, than you will need to set proxy in "CURLOPT_PROXY" option. Below you can see code example:</p>
		<pre>$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://ifconfig.io");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_PROXY, "127.0.0.1:8080");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //Used in case if you are connecting via HTTPS
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl = curl_exec ($ch);
curl_close ($ch);
print($curl);</pre>
	</div>
</div>

<?php require_once '../inc/footer.php'; ?>