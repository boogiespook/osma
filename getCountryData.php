<?php       
include 'dbconnect.php';
connectDB();
$data = array();
$qq = "";

if (isset($_GET['lob']) && $_GET['lob'] != "") {
$qq = "select country as country, count(*) as total from data WHERE lob = '" . $_GET['lob'] . "' group by country order by total desc";
} 

if (isset($_GET['country']) && $_GET['country'] != "") {
$qq = "select country as country, count(*) as total from data WHERE country = '" . $_GET['country'] . "' group by country order by total desc";
}

if ($qq == "") {
$qq = "select country as country, count(*) as total from data group by country order by total desc";
}

#print $qq;
$result = mysqli_query($db, $qq);

$i=0;
foreach ($result as $row) {
	$data[] = $row;
	$i++;
}
    
#    while($row = mysqli_fetch_array($result))
#    {        
#        $point = array("x" => $row['date'], "y" => $row['total']);
#        $point = array("x" => $row['country'], "y" => $row['total'], "legendText" => $row['country'], "label" => $row['country']);
#        $point = array("x" => $row['date'], "y" => $row['total']);
#        array_push($data_points, $point);        
#    }
    
    echo json_encode($data, JSON_NUMERIC_CHECK);

?>