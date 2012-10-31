<?php
//Zend GData include
set_include_path(get_include_path() . PATH_SEPARATOR . "$_SERVER[DOCUMENT_ROOT]/xend/library");
//Include spreadsheet interface
include_once("Google_Spreadsheet.php");
//Account creditnitals
$username="";
$pwd="";
//Create spreadsheet object and connect to the spreadsheet
$sheet=new Google_Spreadsheet($username,$pwd);
$sheet->useSpreadsheet("NCP Thinkering (2011-2012)");
//select the tags worksheet
$sheet->useWorksheet("tags");
//create array object to be inserted to spreadsheet
$row=array(
	rfid=>strtoupper(substr(md5(rand()), 0, 10)),
	grade=>rand(9,12),
	);
if ($sheet->addRow($row))
{
	echo "I DID IT!";
}
else
{
	echo "Oh no, something is wrong!";
}
?>