<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '/home1/erict15/public_html/zend/library/');
/**
 * @see Zend_Loader
 */
require_once 'Zend/Loader.php';

include('Google_Spreadsheet.php');

$points=0;
$room = "313";
function generate_points($t) {
	$epochatseven=mktime(7,55,00,date(n),date(j),date("Y"));
	if ($t<$epochatseven) {
		$points=5;
	} else {
		$points=0;
	}
	return $points;
}
//Account credentials
$username="";
$pwd="";
//Create spreadsheet object and connect to the spreadsheet
$sheet=new Google_Spreadsheet($username,$pwd);
$sheet->useSpreadsheet("NCP Thinkering (2011-2012)");
$sheet->useWorksheet("tags");
$rfidarr=$sheet->getRows("rfid");
$rows=array();
for($i=0; $i<1; $i++) {
	$randrow=rand(0,sizeof($rfidarr));
	$datetime=time();
	$pts=generate_points(time());
	$grade='';
	switch ($rfidarr[$randrow]['grade']) {
		case '9':
		$grade="Freshmen";
		break;
		case '10':
		$grade="Sophomores";
		break;
		case '11':
		$grade="Juniors";
		break;
		case '12':
		$grade="Seniors";
		break;
	}
	$row=array(
		rfid=>(strlen($_GET['id'])>0 ? $_GET['id'] : $rfidarr[$randrow]['rfid']),
		time=>time(),
		room=>$room,
		grade=>$grade,
		points=>(rand(0, 2) >= 1) ? '5' : '0'
		);
	$rows[$i] = $row;
}
//select the entries worksheet
$sheet->useWorksheet("entries");
//create array object to be inserted to spreadsheet
foreach ($rows as $row) {
	if (strpos(print_r($rfidarr, true), $row['rfid'])!==false && $sheet->addRow($row)) {
		echo "I DID IT!";
	} else {
		echo "Oh no, something is wrong!";
		echo implode(implode($rfidarr));
	}
}
?>