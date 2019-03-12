<!DOCTYPE html>
<html>
<head>
    <script src="Chart.bundle.js"></script>
    <script src="utils.js"></script>
    <script src="raphael-2.1.4.min.js"></script>
    <script src="justgage.js"></script>
    <title>Ready to Innovate Assessment</title>
    <link href="http://static.jboss.org/css/rhbar.css" media="screen" rel="stylesheet">
<style>

body {

    margin: 5px auto;
    font-family: 'trebuchet MS', 'Lucida sans', Arial;
    font-size: 14px;
    color: #444;
}

#wrapper {
width: 95%;
background-color: #FFF;
margin-left:auto;
margin-right:auto;
}

header {
height: 30px;
border-bottom: thin solid #000000;
}

#rh-logo img {
    position: absolute;
    top: 2px;
    right: 2px;
    float: right;
}

#content {
width: 50%;
align-content: center;
}

#rightcol {
float: right;
width: 50%;
vertical-align: middle;
}

footer {
clear:both;
height: 50px;
}

table {
    *border-collapse: collapse; /* IE7 and lower */
    border-spacing: 0;
    width: 100%;    
}

  
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


</head>

<body>
<?php  
date_default_timezone_set("Europe/London");
## Connect to the Database 
include 'dbconnect.php';
connectDB();

# Retrieve the data
$qq = "SELECT avg(d1) as d1, avg(d2) as d2, avg(d3) as d3, avg(d4) as d4, avg(d5) as d5, avg(o1) as o1,avg(o2) as o2, avg(o3) as o3, avg(o4) as o4, avg(o5) as o5 FROM data";
$res = mysqli_query($db, $qq);
$data_array = mysqli_fetch_assoc($res);

$ops_arr = $dev_arr = array();

foreach( $data_array as $var => $value )
    {
    	if($var=='date') continue;
      if(substr($var[0],0,1) == "o") { $ops_arr[]=$value; };
      if(substr($var[0],0,1) == "d") { $dev_arr[]=$value;};
    }
    
 ?>
      <div id="wrapper">
      <header>

      <center>
      <h2>Average of Ready to Innovate Assessments</h2>
      </center>
      </header>
      
<div id="content">       

        <canvas id="canvas"></canvas>
        <script>

    var customerName = ''
    var customerNameNoSpaces = '';


function checkVal(inNo) {
	if (inNo == "0") {
		var outNo = "0.01";
	} else {
	   var outNo = inNo;	
	}
	return outNo
}

    var d1 = checkVal(<?php echo $data_array['d1'] ?>)
    var d2 = checkVal(<?php echo $data_array['d2'] ?>)
    var d3 = checkVal(<?php echo $data_array['d3'] ?>)
    var d4 = checkVal(<?php echo $data_array['d4'] ?>)
    var d5 = checkVal(<?php echo $data_array['d5'] ?>)
    
    var totalDev = d1 + d2 + d3 + d4 + d5

    var o1 = checkVal(<?php echo $data_array['o1'] ?>)
    var o2 = checkVal(<?php echo $data_array['o2'] ?>)
    var o3 = checkVal(<?php echo $data_array['o3'] ?>)
    var o4 = checkVal(<?php echo $data_array['o4'] ?>)
    var o5 = checkVal(<?php echo $data_array['o5'] ?>)

    var totalOps = o1 + o2 + o3 + o4 + o5

    var chartTitle = "DevOps Chart - " + customerName
    var overall1 = (d1+o1)/2;
    var overall2 = (d2+o2)/2;
    var overall3 = (d3+o3)/2;
    var overall4 = (d4+o4)/2;
    var overall5 = (d5+o5)/2;
    
    var randomScalingFactor = function() {
        return Math.round(Math.random() * 4);
    };

    var color = Chart.helpers.color;
    var config = {
        type: 'radar',
        data: {
            labels: ["Automation", "Methodology", "Architecture", "Strategy", "Resources"],
            datasets: [{
                label: "Dev",
                backgroundColor: color(window.chartColors.red).alpha(0.2).rgbString(),
                borderColor: window.chartColors.red,
                pointBackgroundColor: window.chartColors.red,
                data: [d1,d2,d3,d4,d5]
            }, {
                label: "Ops",
                backgroundColor: color(window.chartColors.blue).alpha(0.2).rgbString(),
                borderColor: window.chartColors.blue,
                pointBackgroundColor: window.chartColors.blue,
                data: [o1,o2,o3,o4,o5]

            }]
        },
        options: {
            legend: {
                position: 'bottom',
            },
            title: {
                display: true,
                text: chartTitle
            },
            scale: {
            
              ticks: {
                beginAtZero: true,
                max: 4,
                min: 0
              }
            },
            			animation:{
        			onComplete : function(){
						var dataURL = canvas.toDataURL("image/png",1.0);
						$.ajax({ 
				   	 	type: "POST", 
    						url: "chartSave.php",
    						data: "spider="+dataURL+"&customer="+customerNameNoSpaces+"&chartType=spider",
						});
    			} 
        }
    }
 }
    window.onload = function() {
        window.myRadar = new Chart(document.getElementById("canvas"), config);

var ctx = document.getElementById("myChartDev").getContext("2d");
var data = {
  labels: ["Automation", "Methodology", "Architecture", "Strategy", "Resources"],
  datasets: [{
    label: customerName,
    backgroundColor: 'green',
    data: [d1, d2, d3, d4, d5]
  }, {
    label: "Average",
    backgroundColor: "orange",
    data: <?php 
    $qq = "select avg(d1) as d1,avg(d2) as d2, avg(d3) as d3, avg(d4) as d4, avg(d5) as d5 from data;";    
    $res = mysqli_query($GLOBALS["___mysqli_ston"], $qq);
    $row = mysqli_fetch_array($res);
     echo "[" . $row[0] . "," . $row[1] . "," . $row[2] . "," . $row[3] . "," . $row[4] . "]"; 
     ?>
  },
  ]
};

var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: data,
  options: {
    barValueSpacing: 20,
    scales: {
      yAxes: [{
        ticks: {
          min: 0,
          max: 4
        }
      }]
    },
                			animation:{
        			onComplete : function(){
						var dataURLDev = myChartDev.toDataURL("image/png",1.0);
//						console.log(dataURLDev);
						$.ajax({ 
				   	 	type: "POST", 
   						url: "chartSave.php",
   						data: "spider="+dataURLDev+"&customer="+customerNameNoSpaces+"&chartType=comparisonDev",
						});
    			} 
        }
  }
});  		

var ctx2 = document.getElementById("myChartOps").getContext("2d");
var dataOps = {
  labels: ["Automation", "Methodology", "Architecture", "Strategy", "Resources"],
  datasets: [{
    label: customerName,
    backgroundColor: 'green',
    data: [o1, o2, o3, o4, o5]
  }, {
    label: "Average",
    backgroundColor: "orange",
    data: <?php 
    $qq = "select avg(o1) as d1,avg(o2) as d2, avg(o3) as d3, avg(o4) as d4, avg(o5) as d5 from data;";    
    $res = mysqli_query($GLOBALS["___mysqli_ston"], $qq);
    $row = mysqli_fetch_array($res);    
     echo "[" . $row[0] . "," . $row[1] . "," . $row[2] . "," . $row[3] . "," . $row[4] . "]"; 
     ?>
  },
  ]
};

var myBarChart2 = new Chart(ctx2, {
  type: 'bar',
  data: dataOps,
  options: {
    barValueSpacing: 20,
    scales: {
      yAxes: [{
        ticks: {
          min: 0,
          max: 4
        }
      }]
    },
                			animation:{
        			onComplete : function(){
						var dataURLOps = myChartOps.toDataURL("image/png",1.0);
//						console.log(dataURLDev);
						$.ajax({ 
				   	 	type: "POST", 
   						url: "chartSave.php",
   						data: "spider="+dataURLOps+"&customer="+customerNameNoSpaces+"&chartType=comparisonOps",
						});
    			} 
        }
  }
});  				
  		
};
             


    var colorNames = Object.keys(window.chartColors);
    </script>

</div>



</body>
</html>
