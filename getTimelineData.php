<?php       
include 'dbconnect.php';
connectDB();
$data = array();

$result = mysqli_query($db, "select count(*) as total, YEAR(date) as year, MONTH(date) as month, DAY(date) as day, date from data group by DAY(date) order by date asc");
$i=0;
foreach ($result as $row) {
	$data[] = $row;
	$i++;
}

    
echo json_encode($data, JSON_NUMERIC_CHECK);

?>