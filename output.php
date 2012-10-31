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

$query="SELECT grade, SUM(points) FROM entries GROUP BY grade"; 
	 
$result=mysql_query($query) or die(mysql_error());

while($row=mysql_fetch_array($result)) $score[$row[0]]=$row[1];
?>
<html>
<head>
	<title>Attend-a-thon</title>
	<style type="text/css">
	body
	{

	}
	#title
	{
		text-align:center;
		font-family: Arial, "Verdana", sans-serif;
		font-size:48px;
		color:white;
		background-color:#800000;
		height:15%;
		width:100%;
		opacity:0.8;
		filter:alpha(opacity=80);
	}
	#title p
	{
		vertical-align:middle;
	}
	#chart_div
	{
		width: 800px;
		height: 600px;
	}
	</style>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
	  google.load("visualization", "1", {packages:["corechart"]});
	  google.setOnLoadCallback(drawChart);
	  function drawChart() {
		var datanew google.visualization.DataTable();
		data.addColumn('string', 'Class');
		data.addColumn('number', 'Points');
		data.addRows([
			['Freshmen', '<?=$score[9]?>'],
			['Sophmores', '<?=$score[10]?>'],
			['Juniors', '<?=$score[11]?>'],
			['Seniors', '<?=$score[12]?>']
		]);

		var options={
			'hAxis': {'title': 'Class', 'titleTextStyle': {'color': 'red'}},
		};

		var chart=new google.visualization.ColumnChart(document.getElementById('chart_div'));
		chart.draw(data, options);
	  }
	</script>
</head>
<body>
<div id="title"><p>NCP Attend-a-thon</p></div>
<div id="chart_div"></div>
</body>
</html>