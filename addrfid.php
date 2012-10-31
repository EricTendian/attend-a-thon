<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '/home1/erict15/public_html/zend/library/');
/**
 * @see Zend_Loader
 */
require_once 'Zend/Loader.php';

include('Google_Spreadsheet.php');

//Account creditnitals
$username="";
$pwd="";
//Create spreadsheet object and connect to the spreadsheet
$sheet=new Google_Spreadsheet($username,$pwd);
$sheet->useSpreadsheet("NCP Thinkering (2011-2012)");
//select the tags worksheet
$sheet->useWorksheet("tags");
//create array object to be inserted to spreadsheet
$rfidarr=$sheet->getRows("rfid");
$row=array(
	rfid=>($_GET['id'] ? $_GET['id'] : strtoupper(substr(md5(rand()), 0, 10))),
	grade=>($_GET['grade'] ? $_GET['grade'] : rand(9,12)),
	);
if ((intval($_GET['grade'])<9 && intval($_GET['grade']>12))) {
	echo $_GET['grade']." is not a valid grade!";
	exit();
}

if (strpos(print_r($rfidarr, true), $_GET['id'])!==false) {
	echo "duplicate RFID!";
	exit();
}
else {
	if ($sheet->addRow($row)) {
		echo "I DID IT!";
	} else {
		echo "Oh no, something is wrong!";
	}
}
?>