<?php

function connectDB() {
## LOCAL
$db = mysql_connect('localhost','root','xxxxxxxx');
	if (!$db) {
	die("Unable to connect to database");
}
## LOCAL
if (!mysql_select_db('osma')) {
		die("Unable to access dodgeball database");
}

}

function getUUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,20,12);
        return $uuid;
    }
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

## Add a comments field
echo '<hr><label for="comments">Comments</label>
<input size="60" type="text" name="comments">';

echo '<input type="hidden" name="clientId" value="' . $_SESSION['clientId'] . '">';
echo '<input type="hidden" name="categoryId" value="' . $category . '">';
echo '<br><br><input class="button" type="submit" name="Submit" value="Next" id="nextButton" />';

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
