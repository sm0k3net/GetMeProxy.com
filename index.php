<?php require_once 'inc/header.php'; ?>
 <div class="container">
	<div class="row">
		<div class="col-lg-8">
		<div class="panel panel-default">
		<div class="panel-body">
	 		<form action="#" method="post">
 			<div class="form-group">
 			<label>Sort by country: </label>
 			<select name="country">
 				<?echo $country_type;?>
 			</select>
			&nbsp;<label>By protocol: 
			<select name="type">
			<option value="http" class="label label-warning">HTTP</option>
			<option value="https" class="label label-success">HTTPS</option>
			</select></label>
			&nbsp;<label>Speed (ms): 
			<input class="form-control" size="20" type="text" name="speed" value="" style="width:50%;" placeholder="3" /></label>
			<label>Anonymity Level: 
			<select name="anonymity">
			<option value="none">None</option>
			<option value="medium">Medium</option>
			<option value="high">High</option>
			</select></label>
		</div>
		<div class="form-group">
		<img src='//getmeproxy.com/assets/img/getmeproxy_minions.jpg' height="120" width="200" class="pull-right" alt="getmeproxy">
			<label>Show older results first: <input type="checkbox" name="old" value="asc"></label>
			&nbsp;<label>Only checked: <input type="checkbox" name="status" value="live"></label>
			&nbsp;&nbsp; <label>Download results: <input type="checkbox" name="download" value="yes"></label>
 		</div>
 			<button type="submit" name="show" class="btn btn-success"> <span class="glyphicon glyphicon-ok"></span> Get Me Proxy!</button> &nbsp;
 			<a href="//getmeproxy.com/" class="btn btn-info"> <span class="glyphicon glyphicon-refresh"></span> Refresh</a>
 			
 			</form>
 			</div></div>
 			<br />
 			<table class="table table-bordered">
 			<? echo $show_found_records; ?>
 			<thead><tr><th>Proxy [IP:PORT]</th><th>Protocol</th><th>Country</th><th>Region</th><th>Anonymity</th><th>Speed</th><th>State</th></tr></thead>
 			<tbody>
 			<?php echo $proxy_list; ?>
 			</tbody>
 			</table>
 			<nav>
 			<?php echo paginate_three($reload, $page, $tpages, $adjacents); ?>
 			</nav>
		</div>
	<div class="col-lg-4">
			
		<div class="panel panel-primary">
		<div class="panel-heading"><h3 class="panel-title">GetMeProxy Tools</h3></div>
		<div class="panel-body">
				<a class="btn btn-default btn-lg btn-block" href="//getmeproxy.com/web/" target=_blank><span class="glyphicon glyphicon-search pull-left"></span> Online Web Proxy</a>
				<a class="btn btn-default btn-lg btn-block" href="//getmeproxy.com/proxy-checker/" target=_blank><span class="glyphicon glyphicon-list-alt pull-left"></span> Free Proxy Checker</a>
				<a class="btn btn-default btn-lg btn-block" href="//getmeproxy.com/host-checker/" target=_blank><span class="glyphicon glyphicon-globe pull-left"></span> Host Availability Checker</a>
		</div>
		</div>
		<div class="panel panel-primary">
		<div class="panel-heading"><h3 class="panel-title">Proxy Database Stats</h3></div>
		<div class="panel-body">
			<ul class="list-group">
				<li class="list-group-item">Proxies in database: <?echo $proxy_total[0];?></li>
				<li class="list-group-item">Checked Proxies: <?echo $live_proxy[0];?></li>
				<li class="list-group-item">Sorted by countries: <?echo $sorted_proxy[0];?></li>
				<li class="list-group-item">Supports HTTPS: <?echo $https_proxy[0];?></li>
				<li class="list-group-item">Last update: <?echo date('H:i  d-m-Y', strtotime($latest_update[0]));?></li>
				<li class="list-group-item">Current server time: <?echo date('H:i  d-m-Y');?></li>
				<li class="list-group-item">Registered API users: <?echo $api_users[0];?></li>
			</ul> 			
 			<a href="https://twitter.com/getmeproxy" class="twitter-follow-button" data-show-count="false">Follow @getmeproxy</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script><img src='//getmeproxy.com/assets/img/getmeproxy_database.png' height="80" width="136" class="pull-right" alt="getmeproxy database">
 			<a class="twitter-timeline" data-width="400" data-height="200" href="https://twitter.com/GetMeProxy" rel="nofollow">Tweets by GetMeProxy</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
 		</div>
 		</div>
	</div>
	</div>
	<?php require_once 'inc/footer.php'; ?>