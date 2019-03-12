<?php
 
$option = $_REQUEST['option'];
$search = $_REQUEST['s']; 
 
function listCharts() {
$dir = "charts";
$urlStem = "http://" . $_SERVER['HTTP_HOST'] . "/charts";
$output = array_diff(scandir("charts"), array('..', '.'));
foreach($output as $file) {
   echo "$urlStem/$file\n";
}
}

function searchCharts($str) {
$dir = "charts";
$urlStem = "http://" . $_SERVER['HTTP_HOST'] . "/charts";
$output = array_diff(scandir("charts"), array('..', '.'));
foreach($output as $file) {
    if (preg_match("/$str/i",$file)) { 
      echo "$urlStem/$file\n";
   	}
	}
}
	
function getCustomers() {
$output = array_diff(scandir("charts"), array('..', '.'));
$custArray = array();
foreach($output as $file) {
	$arr = explode("-", $file, 2);
	        if(!in_array($arr[0], $custArray)){
        $custArray[]=$arr[0];
        }
	}
sort($custArray);
$clist = "";
foreach ($custArray as $cust) {
$clist .= "$cust, ";
	}
echo substr($clist,0,-2);
}

 
// create SQL based on vars
switch ($option) {
  case 'list':
		listCharts();
		break;
  case 'search':
  		searchCharts($search);
  		break;
  case 'getCustomers' :
  	   getCustomers();
}

?>