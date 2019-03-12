<?php
date_default_timezone_set('Europe/London');	
$data = $_POST['spider'];
$customer = $_POST['customer'];
$chartType = $_POST['chartType'];
list($type, $data) = explode(';', $data);
list($type, $data) = explode(',', $data);
$data = str_replace(' ','+',$data);
$data = base64_decode($data);
#file_put_contents("charts/".$customer."-".$chartType."-".date('Y-m-d').'.png', $data);
file_put_contents("charts/".$customer."-".$chartType.'.png', $data);
die;
?>


