<!DOCTYPE html>
<html>
<head>
    <script src="js/Chart.bundle.js"></script>
    <script src="js/utils.js"></script>
    <script src="js/raphael-2.1.4.min.js"></script>
    <script src="js/justgage.js"></script>
    <title>Open Source Maturity Assessment - Results</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="http://overpass-30e2.kxcdn.com/overpass.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css"/>

<!--	<script src="js/jquery-1.10.2.js"></script>-->
<!--- <link rel="stylesheet" href="/resources/demos/style.css"> -->


</head>

<body>
<script>
	//style all the dialogue
	$( function() {
		$(".dialog_help").dialog({
			modal: true,
			autoOpen: false,
			width: 500,
			height: 500,
			dialogClass: 'ui-dialog-osx'
		});
	});
	
	//opens the appropriate dialog
	$( function() {
		$(".opener").click(function () {
			//takes the ID of appropriate dialogue
			var id = $(this).data('id');
		   //open dialogue
			$(id).dialog("open");
		});
	});
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
  			<a class="navbar-brand" href="index.php"><img src="images/innovate.png">  Open Source Maturity Assessment</a>
  		</div>
  		<div class="collapse navbar-collapse" id="navbar1">
  			<ul class="nav navbar-nav navbar-right">
  				<?php if (isset($_SESSION['usr_id'])) { ?>
  				<li><a href="assess.php">Run Assessment</a></li>
  				<li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
  				<li><a href="logout.php">Log Out</a></li>
				<li><a target="_blank" href="https://github.com/boogiespook/osma2">Github</a></li>
  				<?php } else { ?>
  				<li><a href="register.php">Register</a></li>
  				<li><a href="login.php">Login</a></li>
 				<li><a target="_blank" href="https://github.com/boogiespook/osma2">Github</a></li>
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

switch ($overallRating) {
	case "1":
		$rating = "Rudimentary";
		$ratingDescription = "Governance practices are either non-existent or in the very early stages of development";
		break;
	case "2":
		$rating = "Developing";
		$ratingDescription = "Shortfalls in governance practices have been identified and initial steps have been taken to
rectify them. There is significant room for improvement.";
		break;
	case "3":
		$rating = "Acceptable";
		$ratingDescription = "The minimum governance practices are in place. There is still room for improvement.";
		break;
	case "4":
		$rating = "Advanced";
		$ratingDescription = "Advanced governance practices are in place and exceed performance and compliance requirements. Only minor improvements are required to achieve and be recognised as leading practices.";
		break;
	case "5":
		$rating = "Leading";
		$ratingDescription = "All processes and practices are recognised by others to be of the highest standard";
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
    window.onload = function() {
        window.myRadar = new Chart(document.getElementById("canvas"), config);

};
    </script>

</div>

<div id="rightcol">
<table class="bordered">
<tr>
	<td colspan="2" style="text-align:center"><h3>Overall Rating</h3></td>
	</tr>
	<?php print '<td class="' . strtolower($rating) . '">' . $rating . "</td>"; ?>
	<td style="padding-left: 5px;"><?php print $ratingDescription; ?></td>
</tr>
</table>
<br>
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

#var_dump($overallScores);
#print "<br><br>";
#asort($overallScores);
#var_dump($overallScores);

  
?>
</table>

<?php
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

print '<br><table width=50%><tr><td align=center><h4>Focus Area 1</h4></td><td align=center><h4>Focus Area 2</h4></td><td align=center><h4>Focus Area 3</h4></td></tr><tr><td align=center><img src="' . itemToSearch($firstItem) . '">';
print "<em class='icon-info opener' data-id='#dialog_" . $firstItem . "' style='cursor: pointer;'></em></p></td>";
print '<td align=center><img src="' . itemToSearch($secondItem) . '">';
print "<em class='icon-info opener' data-id='#dialog_" . $secondItem . "' style='cursor: pointer;'></em></p></td>";
print '<td align=center><img src="' . itemToSearch($thirdItem) . '">';
print "<em class='icon-info opener' data-id='#dialog_" . $thirdItem . "' style='cursor: pointer;'></em></p></td>";

# Space for comparisons
#print "<td align=center>Comparisons graph link here</td>";
print "</tr></table>";
?>

	
<?php	

	?>
	
	<div class='dialog_help' id='dialog_Consume' title='Consume'>
		<h4>To-Do List</h4>
		<ul>
<li>Understand Open Source license obligations</li>
<li>Define how Open Source integrates with existing proprietary solutions</li>
<li>Investigate Open Source software already running in the organiation</li>
		</ul>
	</div>
	<div class='dialog_help' id='dialog_Collaborate' title='Collaborate'>
		<h4>To-Do List</h4>
		<ul>
<li>Identify value proposition</li>
<li>Identify strategic communities</li>
<li>Release policy creation</li>
<li>IP governance</li>
<li>Process for open source participation</li>
<li>Take pulse of community</li>
<li>Prepare for first contribution</li>
		</ul>
	</div>	
	<div class='dialog_help' id='dialog_Create' title='Create'>
		<h4>To-Do List</h4>
		<ul>
<li>Identify projects</li>
<li>Identify collaborators and audience</li>
<li>Define clear objectives</li>
<li>Define a governance model</li>
<li>Choose a license/contribution model</li>
<li>Define shared control strategy</li>
<li>Community success tactics</li>
		</ul>
	</div>
	<div class='dialog_help' id='dialog_Policy' title='Strategy & Governance'>
		<h4>To-Do List</h4>
		<ul>
<li>Value proposition</li>
<li>Business objectives</li>
<li>Company direction</li>
<li>Risk tolerance</li>
<li>Management & control processes</li>
<li>Cultural changes & requirements</li>
<li>Removal of obstacles</li>
<li>Success metrics</li>
		</ul>
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
        
        console.log(between(dc, first, second));
        
        if( between(dc, first, second) ){
          th.addClass(value);
        }
      });
    
  });
});
</script>

</body>
</html>
