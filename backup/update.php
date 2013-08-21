<?php
session_start();
$nextPage=$_REQUEST['nextPage'] . ".php";
include("functions.php");
connectDB();
#echo "Next Page: $nextPage <br><br>";

#phpinfo();

if (($nextPage == "intro.php") || ($nextPage == "clientDetails.php")) {
header("location:/osma/index.php?page=$nextPage");
} 

## If the referrer was the clientDetails page then update the dbase
if (preg_match('/page=clientDetails.php/',$_SERVER["HTTP_REFERER"])){
#if (preg_match('/clientDetails.php/',__FILE__)){

if (isset($_POST['updateStuff'])) { 
 $_SESSION['clientName'] = $_POST['clientName'];
 $_SESSION['clientContactDetailsName'] = $_POST['clientContactDetailsName'];
 $_SESSION['clientContactDetailsEmail'] = $_POST['clientContactDetailsEmail'];
 $_SESSION['clientContactDetailsPhone'] = $_POST['clientContactDetailsPhone'];
 $_SESSION['clientDomain'] = $_POST['clientDomain'];
 $_SESSION['clientName'] = $_POST['clientName'];
 $_SESSION['clientLocation'] = $_POST['clientLocation'];

 
 # Update the database and get the new clientId
 $qq = "INSERT into clientDetails (clientName, clientContactDetailsName, clientContactDetailsEmail, clientContactDetailsPhone, clientDomain, clientLocation, lastUpdated)
 VALUES
 ('" . $_SESSION['clientName'] . "','" . $_SESSION['clientContactDetailsName'] . "','" . $_SESSION['clientContactDetailsEmail'] . "','" . $_SESSION['clientContactDetailsPhone'] . "','" . $_SESSION['clientDomain'] . "','" . $_SESSION['clientLocation'] . "',NOW())";

mysql_query($qq) or die("Unable to insert client details" . mysql_error());

$_SESSION['clientId'] = mysql_insert_id();
}
header("location:/osma/index.php?page=1.php");

}

## We must have an answer to update by now!


if (isset($_POST["Submit"])) {
if (isset($_POST["clientId"])) {
  $clientID=$_POST["clientId"];  
} else {
  $clientID=$_SESSION["clientId"];  
}

foreach($_POST as $key => $value) {
  $pos = strpos($key , 'question');
  if ($pos === 0){
    $qNumber = preg_replace("/[^0-9]/","",$key);
    $answer = $value;
    ## Check if and answer already exists.  If so, update
 #   $qcheck = "select count(*) from answers where questionId = '" . $qNumber . "' AND clientId = '" . $clientID . "'";
 #   print "QCheck: $qcheck <br>";
 #   $res = mysql_query($qcheck);
 #   $num_rows = mysql_num_rows($res);
 #   print "Num rows: $num_rows <br>";
 #   if (( $num_rows == "0" )) {
    ## Lazy but update the db each time as their aint many
    $qq = "INSERT into answers (questionId,answer,clientId) VALUES ('" . $qNumber . "','" . $value . "','" . $clientID . "')";
 #   } else {
 #   $qq = "UPDATE answers set questionId = '" . $qNumber . "', answer = '" . $value . "' WHERE clientId = '" . $clientID . "'";    
 #   }
 #   print "Query to run: $qq <br>";
    mysql_query($qq) or die("Cannot insert the answers" . mysql_error());
#    echo $qq . "<br>";
  }
  
}
## Bounce on to the next page
header("location:/osma/index.php?page=$nextPage");

}

?>
