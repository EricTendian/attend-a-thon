<?php
$link=mysql_connect("localhost","","");
if (!$link) 
{
	die('Could not connect: ' . mysql_error());
}
if (!mysql_select_db('')) 
{
	die('Could not select database: ' . mysql_error());
}
$randrfid=substr(md5(rand()), 0, 10);
$randgrade=rand(9,12);
echo $randgrade;
mysql_query("INSERT INTO tags VALUES ('$randrfid','$randgrade')") or die(mysql_error()); 
?>