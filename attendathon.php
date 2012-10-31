<?php
/*set_include_path(get_include_path() . PATH_SEPARATOR . '/home1/erict15/public_html/zend/library/');
/**
 * @see Zend_Loader
 
require_once 'Zend/Loader.php';

include('Google_Spreadsheet.php');

$score = array();

//Account credentials
$username="";
$pwd="";
//Create spreadsheet object and connect to the spreadsheet
$sheet=new Google_Spreadsheet($username,$pwd);
$sheet->useSpreadsheet("NCP Thinkering (2011-2012)");
$sheet->useWorksheet("entries");
$entries=$sheet->getRows("rfid");
/*$sheet->useWorksheet("tags");
foreach ($entries as $entry) {
	$tag=$sheet->getRows("rfid=".$entry['rfid']);
    $score[$tag['grade']]+=$entry['points'];
}*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NCP Attend-A-Thon</title>
<style type="text/css">
@import url(http://fonts.googleapis.com/css?family=Advent+Pro);
@import url(http://fonts.googleapis.com/css?family=Droid+Sans);
body {
	margin: 0;
	font-family: 'Droid Sans', sans-serif;
	/*background: maroon;
	color: white;*/
}
#header {
	width: 100%;
	background-color: #B00;
	margin: 20px 0;
	padding: 10px 0;
	text-align: center;
}
#header div {
	font-size: 80px;
}
#header h1 {
	font-size: 48px;
	margin: 0;
}
#header h2 {
	font-size: 28px;
	font-weight: 500;
	margin: 0;
}
#chart_div {
	width: 800px;
	height: 600px;
	margin: 0 auto;
}
#accolades {
	margin: 0 auto;
	text-align: center;
	width: 560px;
	display: none;
}
#accolades #toprow, #accolades #bottomrow {
	float: left;
	clear: both;
}
#accolades #toprow .rank {
	display: inline-block;
	float: left;
	margin: 0 20px;
	padding-top: 5px;
	width: 144px;
	height: 58px;
	border-radius: 15px;
	box-shadow: 3px 3px 5px black;
	text-transform: uppercase;
	font-family: 'Advent Pro', sans-serif;
	font-weight: 700;
	font-size: 22px;
	background: #aa0000; /* Old browsers */
	background: -moz-linear-gradient(left,  #aa0000 0%, #ffaaaa 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,#aa0000), color-stop(100%,#ffaaaa)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  #aa0000 0%,#ffaaaa 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  #aa0000 0%,#ffaaaa 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  #aa0000 0%,#ffaaaa 100%); /* IE10+ */
	background: linear-gradient(left,  #aa0000 0%,#ffaaaa 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#aa0000', endColorstr='#ffaaaa',GradientType=1 ); /* IE6-9 */
}
#accolades #bottomrow p {
	font-family: 'Droid Sans', sans-serif;
	font-weight: 300;
	font-size: 18px;
	margin: 5px 20px 0 20px;
	float: left;
	width: 144px;
	height: 63px;
}
</style>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {
  var query = new google.visualization.Query(
      'http://spreadsheets.google.com/tq?key=0Au-a5y9eGfrzdHc1YUZZNkJfTGNQNW8ycjdNMmpmMmc&gid=1');
  
  // Set the chart to refresh every 15 seconds.
  query.setRefreshInterval(15);
  
  // Apply query language.
  query.setQuery('SELECT D, SUM(E) WHERE B><?=$_GET['start']?$_GET['start']:'0'?><?=$_GET['end']?' AND B<'.$_GET['end']:''?><?=$_GET['room']?'AND C='.$_GET['room']:''?> GROUP BY D');
  
  // Send the query with a callback function.
  query.send(handleQueryResponse);
}

function handleQueryResponse(response) {
  if (response.isError()) {
    alert('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
    return;
  }

  var data = response.getDataTable();
  chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
  chart.draw(data, {'hAxis': {'title': 'Class', 'titleTextStyle': {'color': 'red'}},
							'width': 800,
							'height': 600,
							'legend.position': 'none'});
}
</script>
</head>

<body>
<div id="header">
<div style="float: left; margin-left: 4.5em;">&#9733;</div>
<div style="float: right; margin-right: 4.5em;">&#9733;</div>
    <h1>Attend-A-Thon</h1>
    <h2>Northside College Prep</h2>
</div>
<div id="chart_div"></div>
<div id="accolades">
    <div id="toprow">
        <div class="rank">Perfect<br/>Attendance</div>
        <div class="rank">Just in<br/>Time</div>
        <div class="rank">Early<br/>Bird</div>
    </div>
    <div id="bottomrow">
        <p>John Doe</p>
        <p>Jane Doe</p>
        <p>Rich Guy</p>
    </div>
</div>
</body>
</html>