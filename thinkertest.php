<?php
$link = mysql_connect("localhost","","");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
if (!mysql_select_db('')) {
    die('Could not select database: ' . mysql_error());
}
$result = mysql_query('SELECT * FROM tags');
if (!$result) {
    die('Could not query:' . mysql_error());
}
echo mysql_result($result); // outputs third employee's name

mysql_close($link);
?>