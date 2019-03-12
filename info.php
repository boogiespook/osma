<!DOCTYPE html>
<html>
<head>
	<title>Train Diary</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
	<script src="js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/datatables.min.js"></script>
	
	<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable({
				        "aaSorting": [[ 4, "desc" ]]
				});
			} );
	</script>
	
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php"><img src="images/train.png">  Train Journeys</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<?php if (isset($_SESSION['usr_id'])) { ?>
				<li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
				<li><a href="logout.php">Log Out</a></li>
				<?php } else { ?>
				<li><a href="login.php">Login</a></li>
				<li><a href="register.php">Sign Up</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>

    <div class="container">

      <div class="jumbotron">
<?php
include 'functions.php';
connectDB();
$dudeId = $_GET['dudeId'];
$qq = "select name, id from users where uuid = '" . $dudeId . "'";
$result = mysql_query($qq);
$row = mysql_fetch_assoc($result);
$dudeIndex = $row['id'];
print "<h2>Train Journeys for " . $row['name'] . "</h2>";

print '
<table id="example" class="display compact" cellspacing="0" width="100%" >
<thead><tr>
<th>Origin</th>
<th>Destination</th>
<th>Distance Travelled (Km)</th>
<th>Duration</th>
<th>Date</th>
</tr></thead>
<tbody>';

date_default_timezone_set('Europe/London');
$totalDistance = $totalDuration = 0;
connectDB();
$dudeId = $_GET['dudeId'];
$qq = "select * from data where userID = '" . $dudeIndex . "'";
$result = mysql_query($qq);
while ($row = mysql_fetch_assoc($result)) {
#$totalDistance = $totalDistance + ceil($row['distance']/1000);
$totalDistance = $totalDistance + $row['distance'];
$totalDuration = $totalDuration + $row['duration'];
$destinationEncoded = urlencode($row['destination']);
$originEncoded = urlencode($row['origin']);
print "<tr><td><a target=_blank href=https://www.google.co.uk/maps/place/" . $originEncoded . ">" . $row['origin'] . "</td><td><a target=_blank href=https://www.google.co.uk/maps/place/" . $destinationEncoded ."> " . $row['destination'] . "</a></td><td>" . ceil($row['distance']/1000) . "</td><td>" . secondsToHoursMins($row['duration']) . "</td></td><td>" . $row['date'] . "</td></tr>";
}
?>
</tbody>
</table>
<hr>
<b>Total Distance:</b> <?php print ceil($totalDistance/1000) ?> Kms<br>
<b>Total Duration:</b> <?php print secondsToTime($totalDuration)?>

     </div>

    </div> <!-- /container -->

?>
 


<script src="js/bootstrap.min.js"></script>

</body>
</html>

