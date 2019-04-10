<?php
session_start();
include('functionPutFieldsets.php');
#phpinfo();

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="https://overpass-30e2.kxcdn.com/overpass.css"/>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
<!-- <link rel="stylesheet" href="css/jquery-ui.css"> -->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/muuri.css">
<link rel="stylesheet" href="css/image-picker.css">


<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/image-picker.js"></script>

<title>Open Source Maturity Assessment</title>

</head>
<body>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="myosma.php"><img src="images/innovate.png" alt="image">  Open Source Maturity Assessment</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
        <?php if (isset($_SESSION['usr_id'])) { ?>
				<li><p class="navbar-text"><a href="assess.php">Run Assessment</a></p></li>
				<li><a href="myosma.php">Signed in as <?php echo $_SESSION['usr_name']; ?></a></li>
				<li><p class="navbar-text"><a href="logout.php">Log Out</a></p></li>
				<li><a target="_blank" href="https://github.com/boogiespook/osma">GitHub</a></li>
								<?php } else { ?>
				<li><a href="register.php">Register</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a target="_blank" href="https://github.com/boogiespook/osma">GitHub</a></li>
			<?php } ?>

			</ul>
		</div>
	</div>
</nav>
    <div class="container">


<form id="regForm" action="tmp.php">
  <h1>Open Source Maturity Assessment</h1>
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
  <h3>Welcome to the Open Source Maturity Assessment.</h3>

    <p class="mainText">
<b>AIM</b>: This maturity assessment provides a high level overview on where your organisation stands regarding the use of Open Source software and associated practices.
</p>

<p class="mainText">
The assessment looks at a variety of areas regarding Open Source software including:
<ul>
    <ul>
<!--         <li class="mainText">Business Goals</li> -->
        <li class="mainText">Areas of Interest</li>
        <li class="mainText">General Knowledge of Open Source</li>
        <li class="mainText">Development Standards and Tools</li>
        <li class="mainText">Community Participation</li>
        <li class="mainText">Governance & Legal Policies</li>
        <li class="mainText">Senior Management Support</li>
        </ul>
</ul>
</p>
<p  class="mainText">At the end of this assessment you will have a better understanding of your business goals within your organisation regarding Open Source software and methodologies and will take away an idea of next steps and recommended follow-up sessions to dive deep into the challenges and opportunities that face your business.</p>

<br>
  </div>
  <div class="tab"><h3>Organisation Details</h3>
    <p><input placeholder="Contact Name" oninput="this.className = ''" name="customerName"></p>
    <p><input placeholder="Email Address" oninput="this.className = ''" name="rhEmail"></p>
<?php putCountries();?>

<?php putLoBs();?>
<br>
 
  </div>

<?php
function printQuestions($area,$section) {
# Read in all the questions
$string = file_get_contents("questions.json");
$json = json_decode($string, true);
$i = $ii = 1;

while( $i < 7) {
  $question = $json[$area][$i]['question'];
  if ($question != "X") {
	   print "<p class=questions>$question</p>";
	   print '<select name=question' . $section . $i . ' class="styled">';
		   while ($ii < 7) {
				## Output the possible answers
		#		print "<li>" . $json[$area][$i]['options'][$ii] . "</li>";
		      $answer = $json[$area][$i]['options'][$ii];
				if ($answer != "X") {
					     print '<option value="' . $ii . '">' .  $answer . "</option>";
				    }
				$ii++;
				}
		$ii = 1;
	   print "</select>";
	}
	$i++;
}
## Add a comments field
print '<hr><label for="comments">Notes</label>
<input size="60" type="text" name="area' . $section . '_comments">';
}



?>

<!--  <div class="tab">


  <h2>Business Goals for Open Source</h2>

  <div class="board">
  <div class="board-column todo">
    <div class="board-column-header">Low</div>
    <div class="board-column-content-wrapper">
      <div class="board-column-content">
        <div class="board-item"><div class="board-item-content"><span>Promote Innovation</span></div></div>
        <div class="board-item"><div class="board-item-content"><span>Culture Change</span></div></div>
        <div class="board-item"><div class="board-item-content"><span>Improve Product Quality</span></div></div>
        <div class="board-item"><div class="board-item-content"><span>Efficiency</span></div></div>
        <div class="board-item"><div class="board-item-content"><span>Brand Perception</span></div></div>
        <div class="board-item"><div class="board-item-content"><span>Business Development</span></div></div>
        <div class="board-item"><div class="board-item-content"><span>Competitive Advantage</span></div></div>
        <div class="board-item"><div class="board-item-content"><span>Improve Collaboration</span></div></div>
        <div class="board-item"><div class="board-item-content"><span>Revenue</span></div></div>
      </div>
     </div>
  </div>
  <div class="board-column working">
    <div class="board-column-header">Medium</div>
    <div class="board-column-content-wrapper">
      <div class="board-column-content">

      </div>
    </div>
  </div>
  <div class="board-column done">
    <div class="board-column-header">High</div>
    <div class="board-column-content-wrapper">
      <div class="board-column-content">
      </div>
    </div>
  </div>
</div>



  </div>
-->

  <div class="tab">
  <h2>Areas of Interest</h2>

<p class="mainText">To better understand an organisation’s main areas of interest when it comes to Open Source software, this assessment categories the areas according to <b>Consume</b>, <b>Collaborate</b> and <b>Create</b>.  These areas are underpinned by <b>Strategy and Governance policies</b>. </p>
<center>
<table>
<tr>
<td class="paraStyle"><b>Consume</b><br>
<ul>
	<li>Lower operating expenditures & licensing costs</li>
	<li>Access to rapid innovation</li>
	<li>Freedom from vendor lock-in</li>
	<li>Ability to ‘try before you buy’</li>
</ul><br>
<b>Collaborate</b><br>
<ul>
	<li>Shared development cost & risk</li>
	<li>Shared support costs</li>
	<li>Ability to influence project direction</li>
	<li>Autonomy from vendor agendas</li>
</ul>

<br>
<b>Create<br></b>
<ul>
	<li>Ability to lead/influence project direction</li>
	<li>New business contacts inherent to new community</li>
	<li>Wide-scale adoption creates services and support opportunities</li>
</ul>
</td>
<td><img src="images/roundal.png"></td>
</tr>
</table>
</center>
</div>
  <div class="tab">
<p class="mainText">Which of these are the highest priority for your organisation?</p>


<div class="row">
  <div class="column left">
<i class="arr-left"></i><h4>Low Priority (0)</h4>
</div> 

<div class="column middle">
	<h3>Consuming Open Source software</h3><input type="range" name="consume" min="0" max="5" value="0"> 
	<h3>Collaborate with Open Source communities</h3><input type="range" name="collaborate" min="0" max="5" value="0"> 
	<h3>Creating Open Source projects</h3><input type="range" name="createOS" min="0" max="5" value="0"> 
	<h3>Open Source Strategy and Governance</h3><input type="range" name="policy" min="0" max="5" value="0"> 
</div>

  <div class="column right">
<i class="arr-right"></i><h4>High Priority (5)</h4>
</div>

</div>
</div>

  <div class="tab">
  <h2>General Knowledge of Open Source</h2>
  <h4>  </h4>
<?php printQuestions("General Knowledge of Open Source","1");  ?>

</div>


  <div class="tab">
  <h2>Development Standards and Tools</h2>
  <h4></h4>

<?php printQuestions("Development Standards and Tools","2");  ?>

  </div>

  <div class="tab">
  <h2>Community Participation</h2>
  <h4></h4>

<?php printQuestions("Upstream Community Participation","3");  ?>

  </div>

  <div class="tab">
  <h2>Governance & Legal Policies</h2>
  <h4></h4>
<?php printQuestions("Governance and Legal Policies","4");  ?>
  </div>

  <div class="tab">
  <h2>Senior Management Support</h2>
  <h4></h4>
<?php printQuestions("Senior Management Support","5");  ?>

  </div>

  <div class="tab">
  <h2>Discussion Points</h2>
  <h4> Please add any discussion points or other information here</h4>
<hr>
<textarea form=regForm name="comments" id="comments" wrap="soft" rows="20"></textarea>
  </div>

  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtnCJ" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtnCJ").style.display = "none";
  } else {
    document.getElementById("prevBtnCJ").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  //if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
    var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  // ***** DISABLED FOR TESTING PURPOSES ***** //
  valid = true;
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}


</script>


</div>
<script src='js/web-animations.min.js'></script>
<script src='js/hammer.min.js'></script>

</body>
</html>
