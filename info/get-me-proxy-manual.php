<?php require_once '../inc/header.php'; ?>

<div class="container">
	<div class="col-lg-12">
		<h1>Get Me Proxy Manual</h1>
		<h4>For better understanding of our functionality and what does each icon or button means, here we go to describe the stuff.</h4>
		<br>
		<h2>Checked or not checked proxies</h2>
		<p><b>Q:</b> What does mean "checked" or "not checked" proxies?</p>
		<p><b>A:</b> In our service we don't spread proxies on live or not, because we think such approach is not correct. The problem with such case when proxy shows as "dead" or just not working sometimes during scanning or checking, but in next few minutes it may appear that actually it works. So we decided to put potentially not working proxies in "not checked" status and so our minions will recheck them a bit later.</p>
		<p>If speak about "checked" proxies - they are 90% that working. If you looking for good quality anonymous proxy, better search with "Only Checked" option</p>
		<br>
		<h2>Search Panel</h2>
		<img src="//getmeproxy.com/assets/img/mans/search_panel.jpg" alt="control panel" />
		<p>On the picture above you can see searching panel.</p>
		<p>It offers you following proxy sorting types:
			<ul>
			<li><b>Sort by country</b> - groups proxy by country it is located</li>
			<li><b>By protocol</b> - helps you to gather for example only proxies which support HTTP or HTTPS, if not set any protocol, it will show you all types</li>
			<li><b>Speed</b> - you can set exact proxy speed you want to search for and so work only with fastest proxies from our database</li>
			<li><b>Anonymity Level</b> - depends of situtation may help you find best anonymous proxy or if you just need to quickly change IP and no interested in high level anonymity, just don't check this option</li>
			<li><b>Show older results first</b> - by default, our search sorting results in descending order, but if you wish, you can search from the end of our database</li>
			<li><b>Only checked</b> - this option means that proxy was checked, speed, response code type and other data received and it works</li>
			<li><b>Download results</b> - this option allows you to download your searching results into *.txt file with easy-to-read or even work file format (proxy;protocol;country)</li>
			</ul>
		</p>
		<br>
		<h2>Database Stats</h2><img src="//getmeproxy.com/assets/img/mans/proxy_database_desc.jpg" alt="database stats" class="pull-right" width="319" height="270" />
		<p>Our proxy database stats are very easy to understand, but still we going to describe them a bit.</p>
		<p>
			<ol>
				<li><b>Proxies in database</b> - shows how many proxies were aggregated in our database for past few days (in total)</li>
				<li><b>Checked proxies</b> - helps you to understand, how many potentially (for 90%+) working proxies you can find</li>
				<li><b>Sorted by countries</b> - here you can see how many proxies from total proxy database was possible to sort by country/region</li>
				<li><b>Supports HTTPS</b> - listing all available HTTPS proxies, but please, keep in your mind that some http proxies may also support https</li>
				<li><b>Last update</b> & <b>Current server time</b> - were created to show you how often we making updates and when was last update</li>
			</ol>
		</p>
		<br><br>
		<h2>Proxy List (main page or after search)</h2>
		<p>When you opening GetMeProxy.com main page, by default you can see ready to use proxy list, showing you all available types of proxies from latest update.</p>
		<p>You can change pages and look for any proxy you want or need. But to make your research more comfortable and faster - better use our search form</p>
		<img src="//getmeproxy.com/assets/img/mans/proxy_list.jpg" alt="proxy list" />
		<p><br>On the picture you can see list of random proxies. All proxies with "State" like <span class="label label-danger"><span class="glyphicon glyphicon-question-sign"></span></span> - are still not checked or they were checked and didn't work so have such type of flag.</p>
		<p>All other proxies with such type of flag <span class="label label-success"><span class="glyphicon glyphicon-ok-sign"></span></span> - are ready to use.</p>
		<p>Proxy with anonymity level <span class="label label-success">HIGH</span> - are most secure, if you see anonymity level <span class="label label-danger">NONE</span> - than it is possible to detect your real IP address.If you need good proxy with high anonymity level - choose from "Only Checked" and "Anonymity Level: High" as they are perfect for browsing and will help you hide your real IP address.</p>
		<p>For any other purpose you can use any kind of proxy, but better sort them by speed at least.</p>
		<br>
	</div>
</div>

<?php require_once '../inc/footer.php'; ?>