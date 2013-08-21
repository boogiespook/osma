<html>
<head>
<link href="table.css" rel="stylesheet" type="text/css" media="screen" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />

<script>
function showUser(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getClientHistory.php?id="+str,true);
xmlhttp.send();
}
</script>

</head>
<body id="body2">
<div id="wrapper">
		<div id="header">
			<div id="logo">
					<img src="images/red-hat-logo.png" height="60px" width="60px">
				<?php if (isset($_SESSION['clientName']) && $_SESSION['clientName'] != "") {
				echo "<h1><a href=''>Open Source Maturity Assessment (" . $_SESSION['clientName'] . ")</a></h1>";
				} else {
				echo '<h1><a href="#">Open Source Maturity Assessment</a></h1>';
				}
				?>
			</div>
		</div>
	
	<!-- end #header -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
<form>
<select name="users" onchange="showUser(this.value)">
<option value="">Select Client</option>
<?php
include("functions.php");
connectDB();
$q = "SELECT clientName, clientId from clientDetails ORDER BY clientName";
$rr = mysql_query($q);
while ($row = mysql_fetch_assoc($rr)) {
print "<option value='" . $row['clientId'] . "'>" . $row['clientName'] . "</option>";
}

?>
</select>
</form>
<div id="txtHint"></div>

</div>
					<div style="clear: both;">&nbsp;</div>
				</div>
				<!-- end #content -->
				<div style="clear: both;">&nbsp;</div>
		
</body>
</html>