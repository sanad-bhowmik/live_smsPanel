<?php
/*
$link=mysql_connect("localhost","root","99961mmsl2018") or die("Failed to connect to mysql");
mysql_select_db("mmsl_sms") or die( "Unable to select database");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection ='utf8_general_ci'") or die (mysql_error());
*/



// Create connection
$con = mysqli_connect("localhost", "root", "", "mmsl_sms");

// Check connection
if (!$con) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Set the character set to utf8
if (!mysqli_set_charset($con, "utf8")) {
    die("Error loading character set utf8: " . mysqli_error($con));
}

// Set session collation
if (!mysqli_query($con, "SET SESSION collation_connection = 'utf8_general_ci'")) {
    die("Error setting collation: " . mysqli_error($con));


}



?>