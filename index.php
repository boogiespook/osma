<?php
if (!isset($_SESSION)) { 
session_start();
} 
#else {
#print_r($_SESSION); 
#}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Open Source Maturity Assessment</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
<script type="text/javascript" src="js/progressbar.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="js/custom-form-elements.js"></script>

<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:400,300' rel='stylesheet' type='text/css'>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="table.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

 <script type="text/javascript">
$(function() {
  $( "#accordion" ).accordion({
  heightStyle: "content"
  });
});
</script>

<script>
$.validator.setDefaults({
	submitHandler: function() { alert("submitted!"); }
});
</script>
<script type='text/javascript' src='https://www.google.com/jsapi'></script>
</head>
<body>
<?php
include("functions.php");
connectDB();
#print_r($_SESSION);

?>

<div id="wrapper">
	<div id="header-wrapper">
		<div id="header">
			<div id="logo">
				<?php if (isset($_SESSION['clientName']) && $_SESSION['clientName'] != "") {
				echo "<h1><a href=''>Open Source Maturity Assessment (" . $_SESSION['clientName'] . ")</a></h1>";
				} else {
				echo '<h1><a href="#">Open Source Maturity Assessment</a></h1>';
				}
				?>
			</div>
		</div>
	
	</div>
	<!-- end #header -->
	<div id="page">
		<div id="page-bgtop">
		<div id="redhatLogo">
		<img src="images/red-hat-logo.png" height="60px" width="60px">
		</div>

		<div id="progressBar"><div></div></div>	
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">

	<?php  
	if (!isset($_REQUEST['page'])) {
	  $page="welcome.html";
	  $nextpage="intro.html";
	  $prevpage="";
	  $progress=10;
	} else {
	  ## Look up prev/next pages in Dbase
	  $qq = "SELECT * from pageNumbers where page = '" . $_REQUEST['page'] . "'";
	  $results = mysql_query($qq) or die("Unable to run pageNumber query " . mysql_error());
	  $row = mysql_fetch_assoc($results);
	  $progress = $row['progress'];
	  $page = $row['page'];
	  $prevpage = $row['prevPage'];
	  $nextpage = $row['nextPage'];
	  if (!$nextpage) {
	      $nextpage = $page;
	      }
	}
	include($page);
	?>				
					
					</div>
					<div style="clear: both;">&nbsp;</div>
				</div>
				<!-- end #content -->
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>

<?php
if ($page != "clientDetails.php") {
echo '<a id = "startOver" href="destroySession.php" class="button">Start Over</a>';
#  if (($page != "clientDetails.php") || ($page != "workshop.php") || (!preg_match("/^[0-9]/",$page))) {
}
	
if (!preg_match("/^[0-9]|clientDetails|workshop/",$page)) {
    echo '<a href="index.php?page=' . $nextpage . '" class="button" id="nextButton">Next</a>';
  }   
if (preg_match("/assessment/",$page)) {
  echo '<a class="button" target=_blank href="graph1.php">Graph by Category</a>';
  echo '<a class="button" target=_blank href="graph2.php">Overall Graph</a>';
}
?>

</div>
	<!-- end #page --> 
<script>
progressBar(<?php echo $progress ?>, $('#progressBar'));
</script>
</div>
<div id="footer">
	<p>Copyright (c) 2014 Chris Jenkins. </p>
</div>
<!-- end #footer -->
</body>
</html>
