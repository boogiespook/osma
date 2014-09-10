<?php

function connectDB() {
## LOCAL
$db = mysql_connect('localhost','root','password');
	if (!$db) {
	die("Unable to connect to database");
	}
## LOCAL
if (!mysql_select_db('osma')) {
		die("Unable to access osma database");
	}
}

function get_current_url($strip = true) {
    // filter function
    $filter = function($input, $strip) {
        $input = urldecode($input);
        $input = str_ireplace(array("\0", '%00', "\x0a", '%0a', "\x1a", '%1a'), '', $input);
        if ($strip) {
            $input = strip_tags($input);
        }
        $input = htmlentities($input, ENT_QUOTES, 'UTF-8'); // or whatever encoding you use...
        return trim($input);
    };

    $url = array();
    // set protocol
    $url['protocol'] = 'http://';
    if (isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) === 'on' || $_SERVER['HTTPS'] == 1)) {
        $url['protocol'] = 'https://';
    } elseif (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) {
        $url['protocol'] = 'https://';
    }
    // set host
    $url['host'] = $_SERVER['HTTP_HOST'];
    // set request uri in a secure way
    $url['request_uri'] = $filter($_SERVER['REQUEST_URI'], $strip);
    return join('', $url);
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

function checkUUID() {
## check if a uuid has been passed, if so get the details from the dbase
if (isset($_REQUEST['uuid'])) {
	$uuid = $_REQUEST['uuid'];
	$qq = "select * from clientDetails where uuid = '" . $uuid . "'";
	$results = mysql_query($qq) or die("Unable to run pageNumber query " . mysql_error());
	$row = mysql_fetch_assoc($results);
	$_SESSION['clientName'] = $row['clientName'];
	$_SESSION['clientId'] = $row['clientId'];
	$_SESSION['uuid'] = $row['uuid'];
	$id = $row['clientId'];
}

}

function getEmailAddress($clientId) {
$qq = "SELECT clientContactDetailsEmail from clientDetails where clientId = '" . $clientId . "'";
$rq = mysql_query($qq);
$rr = mysql_fetch_assoc($rq);
$emailAddress = $rr['clientContactDetailsEmail'];
print $emailAddress;
}

function getClientName($clientId) {
$qq = "SELECT clientContactDetailsName from clientDetails where clientId = '" . $clientId . "'";
$rq = mysql_query($qq);
$rr = mysql_fetch_assoc($rq);
$clientName = $rr['clientContactDetailsName'];
print $clientName;
}


function printURL() {
## If the UUID is already not in the current URL, add it to the end
if (!isset($_REQUEST['uuid'])) {
$qa = "SELECT uuid from clientDetails where clientId = '" . $_SESSION['clientId'] . "'";
$rq = mysql_query($qa);
$rr = mysql_fetch_assoc($rq);
$uuid = $rr['uuid'];
$url = get_current_url() . "&uuid=" . $uuid ;
#	print "This page is available at: " . get_current_url() . "&uuid=" . $uuid ;
} else {
#	print "This page is available at: " . get_current_url();
$url = get_current_url();
}
#return "This page is available at: <a href='" . $url . "'>" . $url . "</a><br>";
return $url;

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
