
<h2>Summary of Answers for <?php echo $_SESSION['clientName'] ?></h2>
<br>
<p>
Thank you for completing the assessment.  Click on a question below to see your answers:</p>


<div id="accordion">
<?php
#phpinfo();
#session_start();
$qq = "SELECT * FROM questions as q, questionCatagories as qc, answers as a where a.questionId = q.questionNumber AND qc.categoryId = q.categoryId AND a.clientId = '" . $_SESSION['clientId'] . "'";
#$qq = "SELECT * FROM questions as q, questionCatagories as qc, answers as a where a.questionId = q.questionNumber AND qc.categoryId = q.categoryId AND a.clientId = '1'";
$res = mysql_query($qq) or die ("Problem getting results: " . mysql_error());

while ($row = mysql_fetch_assoc($res)) {
$catagoryTotal = array();
$catagoryMax = array();

$questionText = $row['questionText'];
$questionNumber = $row['questionNumber'];
echo "<h4>Question $questionNumber:  $questionText </h4>";

#echo "<b>Question $questionNumber:</b>  $questionText <br>";
$maxScore = $row['maxScore'];
$totalScore = $row['answer'];

$qq2 = "select option" . $row['answer'] . ", maxScore FROM questions where questionNumber = '" . $row['questionNumber'] . "'";
#print $qq2 . "<br>";
$res2 = mysql_query($qq2) or die ("Cannot get results: " . mysql_error());
$row2 = mysql_fetch_array($res2);
$ans = $row2[0];
$max = $row2[1];
if ($totalScore < 2) {
$col = "#FF0000";
} else {
$col = "#00FF00";
}
print "<div><font color=$col><b>$ans </b></font> &nbsp ($totalScore out of " . $max . ")</div>";

}
?>
</div>
