<?php       
include 'dbconnect.php';
connectDB();
$qq = "";
if (isset($_GET['country']) && $_GET['country'] != "") {
$qq = "select lob as Industry, count(*) as Total from data WHERE country = '" . $_GET['country'] . "' group by lob order by total desc";
} 

if (isset($_GET['lob']) && $_GET['lob'] != "") {
$qq = "select lob as Industry, count(*) as Total from data WHERE lob = '" . $_GET['lob'] . "' group by lob order by total desc";
}

if ((isset($_GET['lob']) && $_GET['lob'] != "") && isset($_GET['country']) && $_GET['country'] != "") {
$qq = "select lob as Industry, count(*) as Total from data WHERE lob = '" . $_GET['lob'] . "' and country = '" .  $_GET['country'] . "' group by lob order by total desc";
}


if ($qq == "") {
$qq = "select lob as Industry, count(*) as Total from data group by lob order by total desc";	
}

#print $qq;
$result = mysqli_query($db, $qq);
$data = array();
$i=0;
foreach ($result as $row) {
	$data[] = $row;
	$i++;
}

print json_encode($data);

?>