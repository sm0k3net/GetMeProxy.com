# GetMeProxy.com
Get Me Proxy script

GetMeProxy.com service script includes also modified version of Glype web proxy which can use list of IP addresses from proxy database.
<pre>
<b>To use script, need to do following steps:</b>
1. Upload all the files to your host
2. Import into database 2 .sql scripts ("getmeproxy_payments.sql" and "getmeproxy.sql")
3. Setup connection with your MySQL database in "inc/conn.php file"
4. Create twitter account and generate API keys, update with all required data file "/config/proxycheck/checker.php" on lines: 22 & 24
5. Set 777 rights for "/tmp" folder
6. Put file "gate.php" from root folder on another host, or you can leave it here
7. In file "/config/proxycheck/checker.php" on line 7 update path to file "gate.php"
8. Add to cron following files to run each 15 minutes: all files from "/config/" directory with time paremeter: */15 * * * *
9. Add to cron "/config/proxycheck/proxychecker1.php" with time parameter: 55 * * * *
10. Don't forget to use absolute path in all files within "/config/" directory and "/config/proxycheck/" directory (to run files via cron properly need to use absolute path)

Setting cron jobs:
*/15 * * * *    /usr/bin/php5 /var/www/getmeproxy/www/config/http.php >/dev/null 2>&1
*/15 * * * *    /usr/bin/php5 /var/www/getmeproxy/www/config/https.php >/dev/null 2>&1
55 * * * *      /usr/bin/php5 /var/www/getmeproxy/www/config/proxycheck/proxychecker1.php >/dev/null 2>&1
*/17 * * * *    /usr/bin/proxychains /usr/bin/php5 /var/www/getmeproxy/www/config/location.php >/dev/null 2>&1
*/30 * * * *    /usr/sbin/service restart tor >/dev/null 2>&1

</pre>

### Project page: https://getmeproxy.com/
<pre>
Additional gate for your proxy service/checker you can find here: 
tools.sm0k3.net/hub/gate1.php 
toolssm0k3net.000webhostapp.com/hub/gate1.php
</pre>
