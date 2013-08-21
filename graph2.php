<?php
session_start();
include('functions.php');
connectDB();
## Get results for each catagory
$q1 = "SELECT * from questionCatagories";
$res1 = mysql_query($q1) or die ("Problem getting q1: " . mysql_error());

$totalMaturity = 0;
$redFlagCategories = array();

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
$catAverage = round($catagoryTotal / $totalQuestions);
$percentComplete = round(($catagoryTotal / $catagoryMax) * 100);
$flag = ""; 

if ($percentComplete < 26) {
$maturityLevel = "1";
$maturityLevelLabel = getMaturityLabel($maturityLevel);
$flag = "red_flag.png";
} elseif ($percentComplete > 26 && $percentComplete < 51) 
  {
$maturityLevel = "2";
$maturityLevelLabel = getMaturityLabel($maturityLevel);
$flag = "red_flag.png";
    } elseif ($percentComplete > 50 && $percentComplete < 74)
    {
    $maturityLevel = "3";
    $maturityLevelLabel = getMaturityLabel($maturityLevel);
  } else {
      $maturityLevel = "4";
    $maturityLevelLabel = getMaturityLabel($maturityLevel);
}
$shortCategory = str_replace(" ","",$categoryName);
$sc="$shortCategory" . "$maturityLevel";
$totalMaturity = $maturityLevel + $totalMaturity;
$desc = getMaturityLevel($shortCategory, $maturityLevel);
}

}

$roundedAverageMaturity = round($totalMaturity / 6);
$averageMaturity = round($totalMaturity / 6,1);
$averageMLabel = getMaturityLabel($roundedAverageMaturity);

$catAverage = $averageMaturity;

if ($catAverage < 4) {
## Create a target values
  if (preg_match('/\./',$catAverage)) {
    $target = round($catAverage + 1);
  } else {
    $target = round($catAverage);
  }
} else {
$target = 4;
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
          ['Overall','Assessment', 'Target'],
          <?php
	    print "[''," . $catAverage . "," . $target . "]"; 
          ?>
	  <?php 
	  ?>
        ]);

        var options = {
	    title: 'Overall Source Maturity Assessment for <?php echo $_SESSION['clientName']; ?>',titleTextStyle: {color: '#336699', fontSize: 18},
	    hAxis: {minValue:0,format:'0'}
	  };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  
<body>

    <div id="chart_div" style="width: 100%; height: 600px;"></div>

</body>
</html>
    
    
    