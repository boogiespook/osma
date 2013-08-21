<h2>Assessment by Category</h2>

<?php

## Get results for each catagory
$q1 = "SELECT * from questionCatagories";
$res1 = mysql_query($q1) or die ("Problem getting q1: " . mysql_error());

$totalMaturity = 0;
$redFlagCategories = array();
$_SESSION['redFlagCategories'] = array();
print '
<table id="rounded-corner" summary="Maturity Level Assessment">
    <thead>
        <tr>
                <th scope="col" class="rounded-company">Category</th>
            <th scope="col" class="rounded-q1">Maturity Level</th>
            <th scope="col" class="rounded-q4">Description</th>
        </tr>
    </thead>
    <tbody>';


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
#print_r($row);
$catagoryTotal = $row['catagoryTotal'];
$catagoryMax = $row['catagoryMax'];
$categoryId = $row['categoryId'];
$categoryName = $row['categoryName'];
$totalQuestions = $row['totalQuestions'];
$catAverage = round($catagoryTotal / $totalQuestions,1);
if ($catAverage > 4 )
{
$catAverage = "4";
}
#print "Cat average: $catAverage <br>";
$percentComplete = round(($catagoryTotal / $catagoryMax) * 100);
$flag = ""; 

if ($percentComplete < 26) {
$maturityLevel = "1";
$maturityLevelLabel = getMaturityLabel($maturityLevel);
array_push($_SESSION['redFlagCategories'],$categoryId) ;
$flag = "red_flag.png";
} elseif ($percentComplete > 26 && $percentComplete < 51) 
  {
$maturityLevel = "2";
$maturityLevelLabel = getMaturityLabel($maturityLevel);
array_push($_SESSION['redFlagCategories'],$categoryId) ;
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
#$totalMaturity = $maturityLevel + $totalMaturity;
$totalMaturity = $catAverage + $totalMaturity;
$desc = getMaturityLevel($shortCategory, $maturityLevel);
print "
<tr>
  <td>$categoryName</td>";

#if (strlen($flag) > "0") {
#  echo "<img align=middle src=images/$flag>";
#  echo "<td><b>$maturityLevel</b>";
  echo "<td><b>$catAverage</b>";
#} else {
#  echo "<td>$catAverage";
#}
  

$flag = ""; 
print "</td>
  <td>$desc</td>
  </tr>";

}

}

$roundedAverageMaturity = round($totalMaturity / 6,1);
$averageMaturity = round($totalMaturity / 6,1);
#$averageMLabel = getMaturityLabel($maturityLevel);
$averageMLabel = getMaturityLabel($roundedAverageMaturity);

print '</tbody>
        <tfoot>
        <tr>
                <td colspan="2" class="rounded-foot-left">Average: 
                ' . $averageMaturity . ' (' . $averageMLabel . ') </td>
                <td class="rounded-foot-right">&nbsp;</td>
        </tr>
    </tfoot>

</table>';
$_SESSION['maturityLevel'] = $averageMaturity;

?>