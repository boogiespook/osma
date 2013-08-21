<?php

function connectDB() {
## LOCAL
$db = mysql_connect('localhost','root','qwas1234');
	if (!$db) {
	die("Unable to connect to database");
}
## LOCAL
if (!mysql_select_db('osma')) {
		die("Unable to access osma database");
}

## Chrisj
#$db = mysql_connect('localhost','qxmyjohq_osma','qwas1234');
#	if (!$db) {
#	die("Unable to connect to database");
#}
#
#
#if (!mysql_select_db('qxmyjohq_')) {
#		die("Unable to access database");
#}



## OPENSHIFT

#define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
#define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
#define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
#define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
#define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME'));
##define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME'));
#
#$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT;
#$dbh = new PDO($dsn, DB_USER, DB_PASS);

}

function getQuestions($category) {

$qq = "select *, CONCAT(option1, option2, option3, option4, option5, option6) as all_options  from questionCatagories as qc, questions as q 
WHERE q.categoryId = qc.categoryId 
AND q.categoryId = '" . $category . "'";
$nextPage = $category + 1;
if (( $nextPage == "7.php")) {
$nextPage = "summary";
}
echo "<form action='update.php?nextPage=$nextPage' method='POST'>";
$result = mysql_query($qq) or die("Unable to run category query " . mysql_error());

while ($row = mysql_fetch_assoc($result)) {
$question=$row['questionText'];
$qNum=$row['questionNumber'];
echo "<br><br>Q" . $qNum . ": $question<br>";

$answerArray = array($row['option1'],$row['option2'],$row['option3'],$row['option4'],$row['option5'],$row['option6']);

echo "<select name=question" . $row['questionNumber'] . '" class="styled">';
$i=1;
foreach ($answerArray as $answer) {
if ($answer != "X") {
$optionValue=substr($answer, -1);
echo "<option value='" . $i . "'>$answer</option>";

}
$i++;
}

echo "</select>";
}
echo '<input type="hidden" name="clientId" value="' . $_SESSION['clientId'] . '">';
echo '<br><br><input class="button" type="submit" name="Submit" value="Next" />';

echo "</form>";
}

function getMaturityLevel($category, $level) {
$lev = "level" . $level;
$qq = "SELECT $lev as levelDesc from maturityLevels
WHERE categoryName = '"  . $category  . "'";
$res = mysql_query($qq) or die ("Cannot run query: " . mysql_error());
$row = mysql_fetch_assoc($res);
return $row['levelDesc'];
}

function getMaturityLabel($level) {
switch (round($level)) {
  case "1":
      $label = "Isolated";
      break;
  case "2":
      $label = "Consumer";
      break;
  case "3":
      $label = "Participant";
      break;
  case "4":
      $label = "Advocate";
      break;
}
return $label;
}

function roundToQuarterHour($minutes) {
    return $minutes - ($minutes % 15);
}

function getCategoryName($categoryId) {
$qq = "SELECT categoryName from questionCatagories
WHERE categoryId = '" . $categoryId . "'";
$res = mysql_query($qq) or die ("Cannot run query: " . mysql_error());
$row = mysql_fetch_assoc($res);
return $row['categoryName'];
}

function getCategoryDetails($categoryId) {
$qq = "SELECT details from questionCatagories
WHERE categoryId = '" . $categoryId . "'";
$res = mysql_query($qq) or die ("Cannot run query: " . mysql_error());
$row = mysql_fetch_assoc($res);
return $row['details'];
}

function getCategoryExperts($categoryId) {
$qq = "SELECT CONCAT(redhat1,' or ', redhat2) as redhatters from questionCatagories
WHERE categoryId = '" . $categoryId . "'";
$res = mysql_query($qq) or die ("Cannot run query: " . mysql_error());
$row = mysql_fetch_assoc($res);
return $row['redhatters'];
}


?>
