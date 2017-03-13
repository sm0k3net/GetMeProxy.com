<?php require_once '../inc/header.php'; ?>
<div class="container">
	<div class="col-lg-12">
	<h1>Proxy types and anonymity level</h1>
	<p>You should know that there are several types of proxies and proxy of each type is designed to solve its specific tasks. But still they have much in common and their abilities coincide in many features.</p>
	<h3>Proxy types</h3>
	<h4><li>HTTP Proxy</li></h4>
	<p>It is the most widespread type of proxy servers and when you hear just "proxy", it means nothing, but this type of a server. Earlier with a help of this proxy it was only possible to view web pages and pictures and download files. Now, new program versions (ICQ, etc.) know how to work through the HTTP proxies. Browsers of any versions know how to work with this type of proxy.</p>

	<h4><li>SOCKS Proxy</li></h4>
	<p>These proxy servers know how to work practically with any type of information on the Internet (TCP/IP protocol), however for their use in programs there should be obviously indicated a ability to work with SOCKS proxy. Some additional programs are necessary for using of SOCKS proxies within a browser (browsers do not know how to work through SOCKS proxy). However, any ICQ versions (and many other popular programs) can work perfectly through the SOCKS proxies. At last, we want to pay attention, while working with socks proxies it is necessary to specify its version: socks 4 or socks 5.</p>

	<h4><li>FTP Proxy</li></h4>
	<p>This type of proxies is highly specialized and aimed for work only with FTP servers. You can use these proxies in most popular file managers (FAR. Windows Commander, etc.), download managers (CuteFTP, GetRight, etc.) and in browsers.</p>

	<h4><li>CGI Proxy</li></h4>
	<p>This type of proxy server could be accessed only with a browser. In other programs their using is complicated (and one does not need it, there are HTTP proxies). However as this type proxy is initially designed for operation through a browser, one can use it in a very simple way. Moreover, you can construct a chain from CGI proxies without any problems.</p>
	<br />
	<h3>Proxy anonymity levels</h3>
	<h4><li>Elite (High anonymity level)</li></h4>
	<p>Do not send your IP-address to a remote computer. Also, they do not inform that there is used any proxy server. With help of elite proxy you can hide the browser information systems and information. Such agent security particularly strong.</p>

	<h4><li>Anonymous (Medium anonymity level)</li></h4>
	<p>These proxy servers let a remote computer (web-server) know, that there is used a proxy, however, they do not pass an IP-address of a client. Ordinary Anonymous Proxy can hide your real IP, but will change your request fields, there may be that the use of a proxy, but just maybe, in general there is no problem. But do not mislead by its name, its security anonymous proxy may be higher than the whole, some agents will strip you some information (like firewall stealth mode), so that the server can not detect your operating system version and browser version.</p>

	<h4><li>Transparent (None anonymous)</li></h4>
	<p>These proxies are not anonymous. They, first, let a web server know that there is used a proxy server and, secondly, "give away" an IP-address of a client. The task of such proxies, as a rule, is information caching and/or support of Internet access for several computers via single connection. Transparent proxy means that the client does not need to know there is a proxy server exists, it adapted to your request fields (message), and will send real IP. Note that encryption is a part of a transparent proxy anonymous proxy, meaning not set to use a proxy.</p>

	</div>
</div>
<?php require_once '../inc/footer.php'; ?>