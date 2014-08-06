<h2>Email Workshop and Assessment Links</h2>
<br>
<br>
<?php

?>
<p> Click the link below to send an email to <?php getClientName($_SESSION['clientId']); print " at "; getEmailAddress($_SESSION['clientId']); ?>? (A CC will also be sent to Malcolm) </p>
<?php
echo '<a id=emailButton href="index.php?page=sendemail.php" class="button">Email Results</a>';
?>

