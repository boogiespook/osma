<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Open Source Maturity Assessment</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
<script type="text/javascript" src="js/progressbar.js"></script>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:400,300' rel='stylesheet' type='text/css'>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="table.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/custom-form-elements.js"></script>
</head>
<body id="body3">
<div id="wrapper">
                <div id="header">
                        <div id="logo">
                                        <img src="images/osma.png" height="60px" width="60px">
                                <?php if (isset($_SESSION['clientName']) && $_SESSION['clientName'] != "") {
                                echo "<h1><a href=''>Open Source Maturity Assessment (" . $_SESSION['clientName'] . ")</a></h1>
";
                                } else {
                                echo '<h1><a href="#">Open Source Maturity Assessment</a></h1>';
                                }
                                ?>
                        </div>
                </div>

        <!-- end #header -->
        <div id="page">
                <div id="page-bgtop">
                        <div id="page-bgbtm">
                                <div id="content">
                                        <div class="post">


<?php
include("functions.php");
connectDB();

#$id = $_GET['id'];
$id = $argv[1];
## Get results for each catagory
$q1 = "SELECT * from questionCatagories";
$res1 = mysql_query($q1) or die ("Problem getting q1: " . mysql_error());

$qa = "SELECT clientName from clientDetails where clientId = $id";
$rq = mysql_query($qa);
$rr = mysql_fetch_assoc($rq);
$clientName = $rr['clientName'];
print "<h3>Proposed Workshop for $clientName</h3>";

$totalMaturity = 0;
$redFlagCategories = array();
$_SESSION['redFlagCategories'] = array();
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
AND a.clientId = '" . $id . "'";

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
array_push($_SESSION['redFlagCategories'],$categoryId);
array_push($redFlagCategories, $categoryId);
$flag = "red_flag.png";
} elseif ($percentComplete > 26 && $percentComplete < 51) 
  {
$maturityLevel = "2";
$maturityLevelLabel = getMaturityLabel($maturityLevel);
array_push($_SESSION['redFlagCategories'],$categoryId) ;
array_push($redFlagCategories, $categoryId);
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

$averageMaturity = round($totalMaturity / 6);
$averageMLabel = getMaturityLabel($maturityLevel);

date_default_timezone_set('Europe/London');
$totalSessions = count($_SESSION['redFlagCategories']);
$startTime = strtotime('10:00:00');
#$totalSessions = 6;
$lunch = "0";

if ($totalSessions < 4 ) {
  $duration = "Half";
  $sessionLength = roundToQuarterHour(180 / $totalSessions);
  } else {
  $duration = "Full";
  $sessionLength = roundToQuarterHour(360 / $totalSessions);
}
?>

<table id="rounded-corner" summary="Workshop">
    <thead>
        <tr>
                <th scope="col" class="rounded-company">Start</th>
            <th scope="col" class="rounded-q1">End</th>
            <th scope="col" class="rounded-q4">Details</th>
        </tr>
    </thead>
    <tbody>
<tr>
  <td>09:00</td><td>09:30</td><td>Welcome and Introductions</td>
</tr>

<tr>
  <td>09:30</td><td>10:00</td><td>Overview of Open Source</td>
</tr>

<?php

if ($duration == "Half") {
## Morning Sessions
foreach ($_SESSION['redFlagCategories'] as $sessionNumber) {
$sessionName = getCategoryName($sessionNumber);
$sessionDetails = getCategoryDetails($sessionNumber);
$endTime = $startTime + ($sessionLength * 60);
$redHatters = getCategoryExperts($sessionNumber);

if (preg_match("/13/",date('H:i',$startTime)) && $lunch != "1") {
$endTime = $startTime + 1800;
$lunch = "1";
print '
<tr>
  <td id="lunch"><b>' . date('H:i',$startTime)  . '</b></td><td id="lunch"><b>' . date('H:i',$endTime) . '</b></td><td id="lunch"><b>Working Lunch</b></td>
</tr>';
$startTime = $endTime;
$endTime = $startTime + ($sessionLength * 60);

}

print '<tr>
   <td>' . date('H:i',$startTime)  . '</td><td>' . date('H:i',$endTime) . '</td><td>' . $sessionName . "<br><ul><li>" . $sessionDetails .'</li></ul></td>
</tr>';

$startTime = $endTime;
}


print '
</tbody>
        <tfoot>
        <tr>
                <td colspan="2" class="rounded-foot-left">' . date('H:i',$startTime) . ' </td>
                <td class="rounded-foot-right">Finish</td>
        </tr>
    </tfoot>


</table>';
} else {
foreach ($redFlagCategories as $sessionNumber) {
$sessionName = getCategoryName($sessionNumber);
$sessionDetails = getCategoryDetails($sessionNumber);
$endTime = $startTime + ($sessionLength * 60);

if (preg_match("/13/",date('H:i',$startTime)) && $lunch != "1") {
$endTime = $startTime + 1800;
$lunch = "1";
print '
<tr>
  <td id="lunch"><b>' . date('H:i',$startTime)  . '</b></td><td id="lunch"><b>' . date('H:i',$endTime) . '</b></td><td id="lunch"><b>Working Lunch</b></td>
</tr>';
$startTime = $endTime;
$endTime = $startTime + ($sessionLength * 60);

}

print '<tr>
   <td>' . date('H:i',$startTime)  . '</td><td>' . date('H:i',$endTime) . '</td><td>' . $sessionName . "<br><ul><li>" . $sessionDetails .'</li></ul></td>
</tr>';

$startTime = $endTime;
}
print '
</tbody>
        <tfoot>
        <tr>
                <td colspan="2" class="rounded-foot-left">' . date('H:i',$startTime) . '</td>
                <td class="rounded-foot-right"  id="lunch"><b>Finish</b></td>
        </tr>
    </tfoot>


</table>';


}

?>
</body>
</html>
