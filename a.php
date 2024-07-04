<?php
$c = mysql_connect("localhost","root","");
mysql_select_db("mmsl_sms") or die (mysql_error());



mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection ='utf8_general_ci'");



mysql_query("SET NAMES 'UTF8'");
mysql_query("insert into metro_send_sms_log(sms) values('পিরোজপুরে চীনা টেকনিশিয়ান হত্যা: মূল আসামি গ্রেপ্তার')" );
echo "saved into database";

?>