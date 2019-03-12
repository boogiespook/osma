<?php
function connectDB() {
## Database stuff
global $db;
if ($_SERVER["HTTP_HOST"] == "localhost") {
	$db = mysqli_connect('localhost','adminzvJZccK','5Et6HuymAm_j');
} else {
	#$db = mysqli_connect('mysql-innovate.44fs.preview.openshiftapps.com','adminzvJZccK','5Et6HuymAm_j');
	$db = mysqli_connect('172.30.132.205','adminzvJZccK','5Et6HuymAm_j');
}
	if (!$db) {
	die("Unable to connect to database");
	}
if (!mysqli_select_db($db, 'spider')) {
		die("Unable to access innovate database");
	}
}
?>
