
<?php
function connectDB() {
## LOCAL
$db = ($GLOBALS["___mysqli_ston"] = mysqli_connect('localhost', 'qxmyjohq_train', '!qwas1234'));
	if (!$db) {
	die("Unable to connect to database");
	}
## LOCAL
if (!mysqli_select_db($GLOBALS["___mysqli_ston"], qxmyjohq_data)) {
		die("Unable to access data database");
	}
}

function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
    #return $dtF->diff($dtT)->format('%h hours and %i minutes');
}
function secondsToHoursMins($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    #return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
    return $dtF->diff($dtT)->format('%h hours and %i minutes');
}

function generate_uuid() {
	return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
		mt_rand( 0, 0xffff ),
		mt_rand( 0, 0x0fff ) | 0x4000,
		mt_rand( 0, 0x3fff ) | 0x8000,
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
	);
}
?>
