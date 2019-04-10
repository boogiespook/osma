<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Open Source Maturity Assessment</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css"/>
<link rel="stylesheet" type="text/css" href="https://overpass-30e2.kxcdn.com/overpass.css"/>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/jquery.dataTables.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/jquery.dataTables.js"></script>
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>

    <script>
  $( function() {
    $( "input" ).checkboxradio();
  } );
  </script>

</head>
<body>
<?php # include_once("analyticstracking.php") ?>
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="myosma.php"><img src="images/innovate.png">  Open Source Maturity Assessment</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<?php if (isset($_SESSION['usr_id'])) { ?>
				<li><a href="assess.php">Run Assessment</a></li>
				<li><a href="osma.php">Signed in as <?php echo $_SESSION['usr_name']; ?></a></li>
				<li><a href="logout.php">Log Out</a></li>
				<li><a target="_blank" href="https://github.com/boogiespook/osma">GitHub</a></li>
				<?php } else { ?>
				<li><a href="register.php">Register</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a target="_blank" href="https://github.com/boogiespook/osma">GitHub</a></li>
				<?php } ?>

			</ul>
		</div>
	</div>
</nav>

<?php
if(isset($_SESSION['usr_id'])) {
include 'dbconnect.php';
$userId = $_SESSION['usr_id'];
$userName = $_SESSION['usr_name'];

?>
    <div class="container">
<h3>Completed Assessments for <?php print $userName; ?> </h3>
<table  class="bordered" id="assessmentTable">
    <thead>
    <tr>
        <th>Client Name</th>        
        <th>Country</th>
        <th>Line of Business</th>
        <th>Timestamp</th>
        <th>Link to Output</th>
    </tr>
    </thead>
    <tbody>
<?php
connectDB();
$qq = "SELECT * FROM data WHERE user='".$userName."'";
$res = mysqli_query($db, $qq);
while ($row = $res->fetch_assoc()) {
print "<tr><td>" . $row['client'] . "</td><td>" . $row['country'] . "</td><td>" . $row['lob'] . "</td><td>" . $row['date'] . "</td><td><a target=_ href=results.php?hash=" . $row['hash'] . ">Link</a></td></tr>";
}

?>
<tbody>
</table>
	<a href="assess.php">
      <button type="button">Run new assessment</button>
</a>
      </div>


    </div> <!-- /container -->
<?php    }
####  End of Logged on bit ######
?>

<script>
$(document).ready( function () {
    $('#assessmentTable').DataTable();
} );
</script>


</body>
</html>
