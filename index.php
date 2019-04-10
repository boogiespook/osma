<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Open Source Maturity Assessment</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css"/>
	<link rel="stylesheet" type="text/css" href="https://overpass-30e2.kxcdn.com/overpass.css"/>

<!--	<script src="js/jquery-1.10.2.js"></script>-->
<!--- <link rel="stylesheet" href="/resources/demos/style.css"> -->
<link rel="stylesheet" href="css/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
			<a class="navbar-brand" href="index.php"><img src="images/innovate.png">  Open Source Maturity Assessment</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<?php if (isset($_SESSION['usr_id'])) { ?>
				<li><a href="assess.php">Run Assessment</a></li>
				<li><a href="#">Signed in as <?php echo $_SESSION['usr_name']; ?></a></li>
				<li><a href="logout.php">Log Out</a></li>
				<li><a target="_blank" href="https://github.com/boogiespook/osma">GitHub</a></li>
				<?php } else { ?>
				<li><a href="register.php">Register</a></li>
				<li><a target="_blank" href="https://github.com/boogiespook/osma">GitHub</a></li>
				<?php } ?>

			</ul>
		</div>
	</div>
</nav>
    <div class="center-div">
<?php
if(isset($_SESSION['usr_id'])) {
include 'dbconnect.php';
$userId = $_SESSION['usr_id'];

?>



<?php } else {?>
<a href="login.php"><button type="button">Login</button></a>

<?php }?>
    </div> <!-- /container -->

</body>
</html>
