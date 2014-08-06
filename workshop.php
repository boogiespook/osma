<?php
## check if a uuid has been passed, if so get the details from the dbase
checkUUID();

## Get results for each catagory
	
$q1 = "SELECT * from questionCatagories";
$res1 = mysql_query($q1) or die ("Problem getting q1: " . mysql_error());
#print_r($_SESSION);
$id = $_SESSION['clientId'];
$qa = "SELECT clientName,uuid from clientDetails where clientId = '" . $id . "'";
$rq = mysql_query($qa);
$rr = mysql_fetch_assoc($rq);
$clientName = $rr['clientName'];
$uuid = $rr['uuid'];

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
?>

<h2>Proposed Workshop Sessions</h2>
<?php
$_SESSION['workshopURL'] = printURL();
print "This page is available at: <a href='" . $_SESSION['workshopURL'] . "'>" . $_SESSION['workshopURL'] . "</a><br>";
?>

<br>
<?php

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

<p>Red Het would recommend the following <?php echo $duration . " day "; ?> workshop to assist <?php echo $_SESSION['clientName']; ?> in increasing their maturity level from Level 
<?php 
echo $maturityLevel; 
echo " (<i>" . getMaturityLabel($maturityLevel) . "</i>) ";
?>
to Level 
<?php echo $maturityLevel + 1; 
echo " (<i>" . getMaturityLabel($maturityLevel + 1) . ")</i>";
?>
</p>
<?php
printURL();

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
                <td colspan="2" class="rounded-foot-left">' . date('H:i',$startTime) . '</td>
                <td class="rounded-foot-right"  id="lunch"><b>Finish</b></td>
        </tr>
    </tfoot>


</table>';

}

$id = $_SESSION['clientId'];
exec('./createAgenda.sh ' . $id . ' ' . str_replace(" ","",$_SESSION['clientName']));

echo '<a id=emailButton href="index.php?page=emailResults.php" class="button">Email Results</a>';

?>


