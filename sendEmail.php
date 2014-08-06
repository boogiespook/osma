<?php
$clientName = getClientName($_SESSION['clientId']);
$clientEmailAddress =  getEmailAddress($_SESSION['clientId']);
// multiple recipients
$to  = '$clientEmailAddress';

// subject
$subject = 'Open Source Maturity Assessment';

// message
$message = '
<html>
<head>
  <title>OSMA Results</title>
</head>
<body>
  <h2>Thank you for taking part in the Open Source Maturiy Assessment</h2>
  <p>The links to your assessment and workshop are below:</p>
  <table>
	<tr>
	<td>Assessment</td><td>' . $_SESSION['assessmentURL'] . '</td>
	</tr>
	<tr>
	<td>Workshop</td><td>' . $_SESSION['workshopURL'] . '</td>
	</tr>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
?>
