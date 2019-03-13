<!DOCTYPE html>
<html>
<head>
    <script src="js/Chart.bundle.js"></script>
    <script src="js/utils.js"></script>
    <script src="js/raphael-2.1.4.min.js"></script>
    <script src="js/justgage.js"></script>
    <title>Open Source Maturity Assessment - Results</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://overpass-30e2.kxcdn.com/overpass.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css"/>
<script src="js/Chart.bundle.js"></script>
</head>

<body>
<script>
	$( function() {
		$(".dialog_help").dialog({
			modal: true,
			autoOpen: false,
			width: 500,
			height: 500,
			dialogClass: 'ui-dialog-osx'
		});
	});
	
	$( function() {
		$(".opener").click(function () {
			//takes the ID of appropriate dialogue
			var id = $(this).data('id');
		   //open dialogue
			$(id).dialog("open");
		});
	});
</script>
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>

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
  				<li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
  				<li><a href="logout.php">Log Out</a></li>
				<li><a target="_blank" href="https://github.com/boogiespook/osma">Github</a></li>
  				<?php } else { ?>
  				<li><a href="register.php">Register</a></li>
  				<li><a href="login.php">Login</a></li>
 				<li><a target="_blank" href="https://github.com/boogiespook/osma">Github</a></li>
  				<?php } ?>
  			</ul>
  		</div>
  	</div>
  </nav>
<?php
date_default_timezone_set("Europe/London");

$string = file_get_contents("comments.json");
$json = json_decode($string, true);

## Connect to the Database
include 'dbconnect.php';
connectDB();

# Retrieve the data
$hash = $_REQUEST['hash'];
$qq = "SELECT * FROM data WHERE hash='".mysqli_real_escape_string($db, $hash)."'";
$res = mysqli_query($db, $qq);
$data_array = mysqli_fetch_assoc($res);

## If nothing returns (i.e. no customer), just exit
if (empty($data_array)) {
	exit;
}

$area1 = $area2 = $area3 = $area4 = $area5 = 0;
$area1Total = $area2Total = $area3Total = $area4Total = $area5Total = 0;
$totalAreas = $areasForAction = array();
$areasForAction['consume'] = $data_array['consume'];
$areasForAction['collaborate'] = $data_array['collaborate'];
$areasForAction['create'] = $data_array['createOS'];
$areasForAction['policy'] = $data_array['policy'];

$totalAreasNames = array('General','Standards and Tools','Upstream Participation','Legal and Governance','Management Support');
$i = 1;
$totalRatingScore = 0;
foreach ($data_array as $key => $value) {
	$regEx = "question";
	if (substr($key,0,8) == "question") {
		$area = substr($key,8,1);
		${'area' . $area . 'Total'}++;
		${'area' . $area} += $value;
		$totalRatingScore += $value;
	}
}

## Do a bit of maths
while ($i < 6) {
	$avg = ${'area' . $i} / ${'area' . $i . 'Total'};
	${'areaAvg' . $i} = $avg;
#	$totalAreas[$i] = $avg;
	$totalAreas[$i] = round($avg,2);
#print "New Agv: " . ${'area' . $i} . "  total: " .${'area' . $i . 'Total'} . "<br>";
#print "Area $i average is $avg <br>";
$i++;
}

# Create an overall rating
$overallRating = round($totalRatingScore / 21);
$isBold = "";
switch ($overallRating) {
	case "1":
		$rating = "Rudimentary";
		$ratingRank = "<b>Rudimentary:</b>: ";
		$ratingDescription = $ratingRank . "Governance practices are either non-existent or in the very early stages of development";
		break;
	case "2":
		$rating = "Developing";
		$ratingRank = "<b>Developing</b>: ";
		$ratingDescription = $ratingRank . "Potential shortfalls in governance practices have been identified and initial steps have been taken to
rectify them. There is significant room for improvement.";
		break;
	case "3":
		$rating = "Acceptable";
		$ratingRank = "<b>Acceptable</b>: ";
		$ratingDescription = $ratingRank . "The minimum governance practices are in place. There is still room for improvement.";
		break;
	case "4":
		$rating = "Advanced";
		$ratingRank = "<b>Advanced</b>: ";
		$ratingDescription = $ratingRank . "Governance practices are in place and exceed performance and compliance requirements. Only minor improvements are required to achieve and be recognised as leading practices.";
		break;
	case "5":
		$rating = "Leading";
		$rating = "<b>Leading</b>: ";
		$ratingDescription = $ratingRank .  "All processes and practices are recognised by others to be of the highest standard";
		break;
}

 ?>
      <div id="wrapper">
      <header>

      <center>
      <h2>Open Source Maturity Assessment for <?php echo $data_array['client']; ?></h2>
      </center>
      </header>
      <div class="container-fluid">

<div id="content">
    <div style="width:90%">
        <canvas id="canvas"></canvas>
    </div>
        <script>
    var customerName = '<?php echo $data_array['client'] ?>'
    //console.log(customerName);
    var customerNameNoSpaces = customerName.replace(/\s+/, "");

      var d1 = <?php print round($areaAvg1,2) . "\n"; ?>
      var d2 = <?php print round($areaAvg2,2) . "\n"; ?>
      var d3 = <?php print round($areaAvg3,2) . "\n"; ?>
      var d4 = <?php print round($areaAvg4,2) . "\n"; ?>
      var d5 = <?php print round($areaAvg5,2) . "\n"; ?>


    var totalDev = d1 + d2 + d3 + d4 + d5

//    var chartTitle = "Open Source Maturity Assessment (" + customerName + ")"
    var chartTitle = ""


    var randomScalingFactor = function() {
        return Math.round(Math.random() * 4);
    };

    var color = Chart.helpers.color;
    var config = {
        type: 'polarArea',
        data: {
            labels: ["General", "Standards and Tools", "Upstream Participation", "Legal & Governance", "Management Support"],
            datasets: [{
                label: "Overall",
                borderColor: window.chartColors.blue,
                pointBackgroundColor: window.chartColors.blue,
                data: [d1,d2,d3,d4,d5],
    backgroundColor: [
      "rgba(255, 0, 0, 0.5)",
      "rgba(100, 255, 0, 0.5)",
      "rgba(200, 50, 255, 0.5)",
      "rgba(0, 100, 255, 0.5)",
      "rgba(0, 100, 100, 0.5)"    ]                
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
                max: 5,
                min: 0
              }
            },

    }
 }
        window.myRadar = new Chart(document.getElementById("canvas"), config);

    </script>

</div>

<div id="rightcol">

<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Overview</a></li>
    <li><a href="#tabs-2">Details</a></li>
    <li><a href="#tabs-4">Notes</a></li>  
    <li><a href="#tabs-3">To Do Lists</a></li>
    <li><a href="#tabs-5">Comparisons</a></li>  </ul>
      <div id="tabs-1">
<table class="bordered" width="100%">
		<tr>
			<td class="rudimentary">Rudimentary</td>		
			<td class="developing">Developing</td>		
			<td class="acceptable">Acceptable</td>		
			<td class="advanced">Advanced</td>		
			<td class="leading"> Leading</td>		
		</tr>     
<tr>

<!-- 	<?php print '<td colspan="5" class="' . strtolower($rating) . '">' . $rating . "</td></tr><tr>"; ?> -->
	<td style="padding-left: 5px;padding-right: 5px;" colspan="5" class="<?php print strtolower($rating) ?>"><?php print $ratingDescription; ?></td></tr>

 
<tr>
</table>
<table class="bordered" ">
<tr>
<td><div id="overallGauge" class="200x160px"></div></td>
	<td><div id="generalGauge" class="200x160px"></div></td>
	<td><div id="toolsGauge" class="200x160px"></div></td>
</tr>
	<tr>
	<td><div id="upstreamGauge" class="200x160px"></div></td>
	<td><div id="legalGauge" class="200x160px"></div></td>
	<td><div id="managementGauge" class="200x160px"></div></td>
</tr>
</table>  
</div>
  <div id="tabs-2">
<table class="bordered">
<thead>
<tr>
<th>Area</th>
<th>Score</th>
<th>Comments</th>
<th>Actions</th>
</tr>
</thead>
<?php
#sort($totalAreas);
#var_dump($json);
$overallScores = array();
$i = 0;
while ($i < 5) {
	$ii = $i + 1;
	$colorScore = $totalAreas[$ii] * 20;
#	print "Color Score: $colorScore";
   $tmpIntScore = round($totalAreas[$ii]);
   $actionItem = $tmpIntScore . "-action";
	print '<tr><td><p data-color="' . round($colorScore,0) . '">' . $totalAreasNames[$i] . '</p></td><td>' . round($totalAreas[$ii]) . '</td><td>' . $json[$totalAreasNames[$i]][$tmpIntScore] .'</td><td>' . $json[$totalAreasNames[$i]][$actionItem] . '</td></tr>';
#   print "Area: " . $totalAreasNames[$i] . " Score: " . $totalAreas[$ii] . "<br>";
   $overallScores[$totalAreasNames[$i]] = $totalAreas[$ii];
$i++;
}


  
?>
</table>

  </div>
  <div id="tabs-3">

<?php

function toDoConsume() {
print '
	<p>Understand Open Source license obligations</p>
	<p>Define how Open Source integrates with existing proprietary solutions</p>
	<p>Investigate Open Source software already running in the organisation</p>
';
}

function toDoCreate() {		
print '
	<p class="topTips">Identify projects</p>
	<p class="topTips">Identify collaborators and audience</p>
	<p class="topTips">Define clear objectives</p>
	<p class="topTips">Define a governance model</p>
	<p class="topTips">Choose a license/contribution model</p>
	<p class="topTips">Define shared control strategy</p>
	<p class="topTips">Community success tactics</p>';
	}

function toDoCollaborate() {
print '
	<p class="topTips">Identify value proposition</p>
	<p class="topTips">Identify strategic communities</p>
	<p class="topTips">Release policy creation</p>
	<p class="topTips">IP governance</p>
	<p class="topTips">Process for open source participation</p>
	<p class="topTips">Take pulse of community</p>
	<p class="topTips">Prepare for first contribution</p>
';
}	

function toDoPolicy() 
{		
print '
	<p class="topTips">Value proposition</p>
	<p class="topTips">Business objectives</p>
	<p class="topTips">Company direction</p>
	<p class="topTips">Risk tolerance</p>
	<p class="topTips">Management & control processes</p>
	<p class="topTips">Cultural changes & requirements</p>
	<p class="topTips">Removal of obstacles</p>
	<p class="topTips">Success metrics</p>
';
	}
arsort($areasForAction);
reset($areasForAction);
#var_dump($areasForAction);
$firstItem = ucfirst(key($areasForAction));
#$secondItem = current(array_slice($areasForAction,1,2));
$secondItem = ucfirst(array_keys($areasForAction)[1]);
$thirdItem = ucfirst(array_keys($areasForAction)[2]);
#print "Second item: " . $secondItem . "<br>";
$actionImage = "";

function itemToSearch($itemToSearch) {
switch($itemToSearch) {
	case "Policy":
		$actionImage = "images/roundal-transparent_strategy.png";
		break;
	case "Consume":
		$actionImage = "images/roundal-transparent_consume.png";
		break;
	case "Collaborate":
		$actionImage = "images/roundal-transparent_collaborate.png";
		break;
	case "Create":
		$actionImage = "images/roundal-transparent_create.png";
		break;
}
return $actionImage;
}

function tipToSearch($itemToSearch) {
switch($itemToSearch) {
	case "Policy":
		$tips = toDoPolicy();
		break;
	case "Consume":
		$tips = toDoConsume();
		break;
	case "Collaborate":
		$tips = toDoCollaborate();
		break;
	case "Create":
		$tips = toDoCreate();
		break;
}
return $tips;
}

print '<br><table width=100%>
<thead>
<tr>
	<td><h4>Focus Area 1</h4></td>
	<td><h4>Focus Area 2</h4></td>
	<td><h4>Focus Area 3</h4></td>
	</tr>
</thead>
<tbody>
<tr>';
print '
	<td align=left><img src="' . itemToSearch($firstItem) . '">';
print tipToSearch($firstItem);
print '	
</td>';
print '
	<td align=left><img src="' . itemToSearch($secondItem) . '">';
print tipToSearch($secondItem);
print '
</td>';
print '
	<td align=left><img src="' . itemToSearch($thirdItem) . '">';
print tipToSearch($thirdItem);
print '
	</td>';

print "</tbody></tr></table>";




?>

  </div>
  
  <div id="tabs-4">
  <h4>Notes from the Assessment</h4>
<?php
$qq = "SELECT area1_comments as generalComments, area2_comments as toolsComments, area3_comments as upstreamComments, area4_comments as legalComments, area5_comments managementComments, comments from data where hash='".mysqli_real_escape_string($db, $hash)."'";
#print $qq;
$res2 = mysqli_query($db, $qq);
$row2 = $res2->fetch_assoc();

if ($row2['generalComments'] != "") {
print "<b>General Comments</b><br>" . $row2['generalComments'] . "<br><hr>";
}

if ($row2['toolsComments'] != "") {
print "<b>Standards and Tools</b><br>" . $row2['toolsComments'] . "<br><hr>";
}

if ($row2['upstreamComments'] != "") {
print "<b>Upstream Participation</b><br>" . $row2['upstreamComments'] . "<br><hr>";
}

if ($row2['legalComments'] != "") {
print "<b>Legal and Governance</b><br>" . $row2['legalComments'] . "<br><hr>";
}

if ($row2['managementComments'] != "") {
print "<b>Management Support</b><br>" . $row2['managementComments'] . "<br><hr>";
}

if ($row2['comments'] != "") {
print "<b>Overal Comments</b><br>" . $row2['comments'] . "<br><hr>";
}

?>
  </div>  

  <div id="tabs-5">

<?php
$qq3 = "select count(*) as total, avg(question11+question12+question13+question14+question15)/5 as averageGeneral, avg(question21+question22+question23+question24+question25+question25)/6 as averageTools, avg(question31+question32+question33)/3 as averageUpstream, avg(question41+question42+question43+question44)/4 as averageLegal, avg(question51+question52+question53)/3 as averageManagement from data";
$res3 = mysqli_query($db, $qq3);
$row3 = $res3->fetch_assoc();
print "Compared to " . $row3['total'] . " other organisations";
print '<canvas id="canvas2"></canvas>';


?>
  
  </div>  
  
</div>




</div>
<!-- end of main content div -->
<!-- end of wrapper div -->


</div>
<script id="jsbin-javascript">
$(document).ready(function(){
  
  var mc = {
    '0-25'     : 'red',
    '26-50'    : 'orange',
    '51-100'   : 'green'
  };
  
function between(x, min, max) {
  return x >= min && x <= max;
}
  

  
  var dc;
  var first; 
  var second;
  var th;
  
  $('p').each(function(index){
    
    th = $(this);
    
    dc = parseInt($(this).attr('data-color'),10);
    
    
      $.each(mc, function(name, value){
        
        
        first = parseInt(name.split('-')[0],10);
        second = parseInt(name.split('-')[1],10);

        
        if( between(dc, first, second) ){
          th.addClass(value);
        }
      });
    
  });
});
</script>
<script>
  var g = new JustGage({
    id: "overallGauge",
    value: <?php print $overallRating; ?>,
    min: 1,
    max: 5,
    title: "Overall Rating",
        humanFriendly : true,
        gaugeWidthScale: 1.3,
        customSectors: [{
          color: "#ff0000",
          lo: 1,
          hi: 2
        },
        {
          color: "#ffbf00",
          lo: 2.1,
          hi: 3.5
        }, {
          color: "#00ff00",
          lo: 3.6,
          hi: 5
        }],
        counter: true
  });
</script>
<script>
  var g = new JustGage({
    id: "generalGauge",
    value: <?php print round($areaAvg1,2) . "\n"; ?>,
    min: 1,
    max: 5,
    decimals: 2,
    title: "General",
        humanFriendly : true,
        gaugeWidthScale: 1.3,
        customSectors: [{
          color: "#ff0000",
          lo: 1,
          hi: 2
        },
        {
          color: "#ffbf00",
          lo: 2.1,
          hi: 3.5
        }, {
          color: "#00ff00",
          lo: 3.6,
          hi: 5
        }],
        counter: true    
  });
</script>

<script>
  var g = new JustGage({
    id: "toolsGauge",
    value: <?php print round($areaAvg2,2) . "\n"; ?>,
    min: 1,
    max: 5,
    decimals: 2,
    title: "Standards and Tools",
            humanFriendly : true,
        gaugeWidthScale: 1.3,
        customSectors: [{
          color: "#ff0000",
          lo: 1,
          hi: 2
        },
        {
          color: "#ffbf00",
          lo: 2.1,
          hi: 3.5
        }, {
          color: "#00ff00",
          lo: 3.6,
          hi: 5
        }],
        counter: true
  });
</script>
<script>
  var g = new JustGage({
    id: "upstreamGauge",
    value: <?php print round($areaAvg3,2) . "\n"; ?>,
    min: 1,
    max: 5,
    decimals: 2,
    title: "Upstream Participation",
            humanFriendly : true,
        gaugeWidthScale: 1.3,
        customSectors: [{
          color: "#ff0000",
          lo: 1,
          hi: 2
        },
        {
          color: "#ffbf00",
          lo: 2.1,
          hi: 3.5
        }, {
          color: "#00ff00",
          lo: 3.6,
          hi: 5
        }],
        counter: true
  });
</script>
<script>
  var g = new JustGage({
    id: "legalGauge",
    value: <?php print round($areaAvg4,2) . "\n"; ?>,
    min: 1,
    max: 5,
    decimals: 2,
    title: "Legal and Governance",
            humanFriendly : true,
        gaugeWidthScale: 1.3,
        customSectors: [{
          color: "#ff0000",
          lo: 1,
          hi: 2
        },
        {
          color: "#ffbf00",
          lo: 2.1,
          hi: 3.5
        }, {
          color: "#00ff00",
          lo: 3.6,
          hi: 5
        }],
        counter: true
  });
</script>
<script>
  var g = new JustGage({
    id: "managementGauge",
    value: <?php print round($areaAvg5,2) . "\n"; ?>,
    min: 1,
    max: 5,
    decimals: 2,
    title: "Management Support",
            humanFriendly : true,
        gaugeWidthScale: 1.3,
        customSectors: [{
          color: "#ff0000",
          lo: 1,
          hi: 2
        },
        {
          color: "#ffbf00",
          lo: 2.1,
          hi: 3.5
        }, {
          color: "#00ff00",
          lo: 3.6,
          hi: 5
        }],
        counter: true
  });
</script>


<script>

		var color = Chart.helpers.color;
		var barChartData = {
			labels: ['General', 'Standards and Tools', 'Upstream Participation', 'Legal and Governance', 'Management Support'],
			datasets: [{
				label: 'Average',
				backgroundColor: color(window.chartColors.green).alpha(0.9).rgbString(),
				borderColor: window.chartColors.green,
				borderWidth: 1,
				data: [ <?php print $row3['averageGeneral'] . "," . $row3['averageTools'] . "," . $row3['averageUpstream'] . "," . $row3['averageLegal'] . "," . $row3['averageManagement'];?>]	}, {
				label: '<?php echo $data_array['client']; ?>',
				backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
				borderColor: window.chartColors.blue,
				borderWidth: 1,
				data: [ <?php print round($areaAvg1) . "," . round($areaAvg2,2) . "," . round($areaAvg3,2) . "," . round($areaAvg4,2) . "," . round($areaAvg5,2) ;?>]
			}]

		};

		window.onload = function() {
			        window.myRadar = new Chart(document.getElementById("canvas"), config);

			var ctx = document.getElementById('canvas2').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Maturity Comparison'
					},
					scales: {
            yAxes: [{
                ticks: {
                    suggestedMin: 0,
                    suggestedMax: 5
               		 }
         		   }]
			        }
				}
			});

		};
		</script>

</body>
</html>
