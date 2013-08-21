<?php
session_start();
include('functions.php');
connectDB();
$dataArray = array();
$q1 = "SELECT * from questionCatagories";
$res1 = mysql_query($q1) or die ("Problem getting q1: " . mysql_error());

while ($rowCat = mysql_fetch_assoc($res1)) {
$q2 = "SELECT SUM(a.answer) as catagoryTotal, 
SUM(q.maxScore) as catagoryMax,
qc.categoryName,
COUNT(q.questionId) as totalQuestions,
qc.categoryId
FROM questions as q, 
questionCatagories as qc, 
answers as a 
WHERE 
a.questionId = q.questionNumber 
AND qc.categoryId = q.categoryId 
AND q.categoryId = '" . $rowCat['categoryId'] . "'
AND a.clientId = '" . $_SESSION['clientId'] . "'";

$res = mysql_query($q2) or die ("Problem getting results for q2: " . mysql_error());

while ($row = mysql_fetch_assoc($res)) {
$catagoryTotal = $row['catagoryTotal'];
$catagoryMax = $row['catagoryMax'];
$categoryId = $row['categoryId'];
$categoryName = $row['categoryName'];
$totalQuestions = $row['totalQuestions'];
$catAverage = round($catagoryTotal / $totalQuestions,1);
if ($catAverage > 4) {
$catAverage = "4";
}

#print "Average: $catAverage <br>";
if ($catAverage < 4) {
## Create a target values
  if (!preg_match('/\./',$catAverage)) {
    $target = ceil($catAverage + 1);
  } else {
    $target = round($catAverage);
#    $target = ceil($catAverage);
  }
} else {
$target = 4;
}

$newdata = array(
'categoryId' => $categoryId,
'categoryName' => rtrim($categoryName),
'score' => $catAverage,
'target' => $target
);

array_push($dataArray,$newdata);
}

}
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Category', 'Assessment', 'Target'],
	  <?php 
	  foreach ($dataArray as $row) {
	    print "['" . $row['categoryName'] . "'," . $row['score'] . "," . $row['target'] . "],\n";
	  }	  
	  ?>
        ]);

        var options = {
          title: 'Open Source Maturity Assessment for <?php echo $_SESSION['clientName']; ?>',titleTextStyle: {color: '#336699', fontSize: 18},
          hAxis: {title: 'Category', 
		  titleTextStyle: {color: '#336699'},
		  minValue: '0', 
		  maxValue: '4', 
		  format:'0'}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  
<body>

    <div id="chart_div" style="width: 100%; height: 600px;"></div>

</body>
</html>
    
    
    