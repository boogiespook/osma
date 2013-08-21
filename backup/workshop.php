<h2>Proposed Workshop Sessions</h2>
<br>
<?php
#print_r($_SESSION);

date_default_timezone_set('Europe/London');
$totalSessions = count($_SESSION['redFlagCategories']);
$startTime = strtotime('10:00:00');
#$totalSessions = 6;
$lunch = "0";

if ($totalSessions < 4 ) {
  $duration = "Half";
  $sessionLength = roundToQuarterHour(180 / $totalSessions);
#  foreach ($_SESSION['redFlagCategories'] as $sessionNumber) {
#  }
  } else {
  $duration = "Full";
  $sessionLength = roundToQuarterHour(360 / $totalSessions);
#  foreach ($_SESSION['redFlagCategories'] as $sessionNumber) {
#  }
}
#print "<br>Session Length: " . $sessionLength . " minutes<br>";
?>

<p>Red Het would recommend the following <?php echo $duration . " day "; ?> workshop to assist <?php echo $_SESSION['clientName']; ?> in increasing their maturity level from Level 
<?php 
echo $_SESSION['maturityLevel']; 
echo " (<i>" . getMaturityLabel($_SESSION['maturityLevel']) . "</i>) ";
?>
to Level 
<?php echo $_SESSION['maturityLevel'] + 1; 
echo " (<i>" . getMaturityLabel($_SESSION['maturityLevel'] + 1) . ")</i>";
?>
</p>

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

## Create a standalone version based on clientId
$id = $_SESSION['clientId'];
#$str = '/bin/php /var/www/html/osma/getClientHistory2.php ' . $id . ' > /tmp/client' . $id . '.html ';
#print "<br>$str<br>";
#exec('/bin/php /var/www/html/osma/getClientHistory2.php ' . $id . ' > /tmp/client' . $id . '.html');
#exec($str,$out,$retval);
exec('./createAgenda.sh ' . $id . ' ' . str_replace(" ","",$_SESSION['clientName']));

#error_reporting(E_ALL);
#    ini_set('display_errors', '1');
#    $cmd = "/bin/wkhtmltopdf client" . $id . ".html client " . $id . ".html";
#    $t = shell_exec($cmd);

#$whoami = exec('whoami');
#echo "I am : $whoami <br>";

#$newPage = join("\n", $out);
#$ourFileName = '/tmp/client' . $id . '.html';
#echo "<br>$ourFileName<br>";
#$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
#file_put_contents($ourFileHandle, $newPage) or die("Unable to append file");
#fwrite($ourFileHandle,$newPage);
#fclose($ourFileHandle);
#print $newPage;

#if ($code) {
#    die("An error occurred while attempting to run");
#} else {
#    echo "Output was: ", join("\n", $out);
#}
#echo "Return value: $retval <br>";
#var_dump($out);
?>


