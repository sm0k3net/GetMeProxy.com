<?php require_once '../inc/header.php'; ?>

<div class="container">
	<div class="col-lg-12">
		<h1>What is proxy and why need to use it</h1>
		<p>Proxy server plays role of the buffer between your computer and the Internet resources you are trying to access (for example: websites, FTP, youtube etc.). The data you request first comes to the proxy and on the second step it transmits to you from proxy server. A proxy server may reside on the user's local computer, or at various points between the user's computer and destination servers on the Internet.</p>
		<p>Here is simple scheme with optional proxy server:<pre>
		1. [YOU] <-> [SOME WEBSITE] => Website owner can detect you IP address. 
		2. [YOU] <-> {PROXY SERVER} <-> [SOME WEBSITE] => In case when you using proxy, owner of the website will see proxy IP address.</pre>
		A client connects to the proxy server, requesting some service, such as a file, connection, web page, or other resource available from a different server and the proxy server evaluates the request as a way to simplify and control its complexity.</p>&nbsp;<iframe class="pull-right" width="520" height="295" src="https://www.youtube.com/embed/bF6v7-wd9qI" frameborder="0" allowfullscreen></iframe>
		<p>Proxy can be used  for following purposes:
		<li><b>Improvement of the transfer speed.</b> If the file you requested was received before to your proxy server, then proxy server will interrupt this file request and you will receive the file directly from proxy. However need to know, you can got the "speed down" effect. This effect appears when your proxy has long answer time because there is slow connection between you and your proxy server</li>
		<li><b>Access restrictions bypassing.</b> Sometimes you may encounter problems while accessing to website or service, entered password incorrect few times and were blocked, or limited somehow by your internet provider. In such case you can use our anonymous proxy and try to access again.</li>
		<li><b>Security and privacy.</b> Good anonymous proxies helps you to hide information about your computer in the requests header. So you can safely surf the internet and your information will be never used by hackers and spammers, or just if you don't want by some reason show your real IP address.</li></p>
		<p>Proxy servers are used for both legal and illegal purposes. In the enterprise, a proxy server is used to facilitate security, administrative control or caching services, among other purposes. In a personal computing context, proxy servers are used to enable user privacy and anonymous surfing. Proxy servers can also be used for the opposite purpose: To monitor traffic and undermine user privacy.</p>
		<p>Users can access web proxies online or configure web browsers to constantly use a proxy server. Browser settings include automatically detected and manual options for HTTP, SSL, FTP, and SOCKS proxies. Proxy servers may serve many users or just one per server. These options are called shared and dedicated proxies, respectively. There are a number of reasons for proxies and thus a number of types of proxy servers, often in overlapping categories.</p>

	</div>
</div>

<?php require_once '../inc/footer.php'; ?>