<h2>Client Details</h2>
<?php
#phpinfo();
if (isset($_POST['Submit'])) { 
 $_SESSION['clientName'] = $_REQUEST['clientName'];
 $_SESSION['clientContactDetailsName'] = $_REQUEST['clientContactDetailsName'];
 $_SESSION['clientContactDetailsEmail'] = $_REQUEST['clientContactDetailsEmail'];
 $_SESSION['clientContactDetailsPhone'] = $_REQUEST['clientContactDetailsPhone'];
 $_SESSION['clientDomain'] = $_REQUEST['clientDomain'];
}
 ## Update the database and get the new clientId
 #$qq = "INSERT into clientDetails (clientName, clientContactDetailsName, #clientContactDetailsEmail, clientContactDetailsPhone, clientDomain)
 #VALUES
 #('" . $_SESSION['clientName'] . "','" . $_SESSION['clientContactDetailsName'] . "','" #. $_SESSION['clientContactDetailsEmail'] . "','" . #$_SESSION['clientContactDetailsPhone'] . "','" . $_SESSION['clientDomain'] . "')";
#
#mysql_query($qq);
## echo "<br>To insert: $qq <br><br>";
#
#$_SESSION['clientID'] = mysql_insert_id();
#
# } else {
# $_SESSION['clientName'] = "";
# $_SESSION['clientContactDetailsName'] = "";
# $_SESSION['clientContactDetailsEmail'] = "";
# $_SESSION['clientContactDetailsPhone'] = "";
# $_SESSION['clientDomain'] = ""; 
# }
#print_r($_SESSION);
 
#if (isset($_POST['Clear'])) {
#session_destroy();
#session_start();
#}
#function updateIfSet($field) {
#if (isset($_SESSION[$field])) {
##  echo '<input type="text" name="' . $field . '" value="' . $_SESSION['$field'] . '"/>';
#  } else {
 # echo '<input type="text" name="' . $field . '"/>';
#
#}
?>
<table>
<form method="POST" action="update.php?nextPage=1" id="clientDetails">
<tr>
  <td>
    <label for="clientName">Client Name</label>
  </td>
  <td>
    <input type="text" name="clientName" minlength="3" required>
  </td>
</tr>

<tr>
<td>
  <label for="clientContactDetailsName">Contact Name</label>
</td>
<td>                                 
  <input type="text" name="clientContactDetailsName" required>
</td>
</tr>

<tr>
  <td>
    <label for="clientContactDetailsEmail">Contact Email</label>
  </td>
  <td>
    <input type="email" name="clientContactDetailsEmail" required>
  </td>                        
</tr>

<tr>
  <td>			
    <label for="clientContactDetailsPhone">Contact Phone</label>
  </td>
  <td>                        
    <input type="text" name="clientContactDetailsPhone" required>
  </td>
</tr>

<tr>
<td>
<fieldset>
<table>
                                <legend>Client Domain</legend>
                                <tr>
				  <td><input type="radio" class="styled" name="clientDomain" value="Government" id="clientDomain" />
                                        <label for="govt">Government</label>
                                  </td>
                                </tr>
                                
                                <tr>
				  <td> <input type="radio" class="styled" name="clientDomain" value="Finance" id="clientDomain" />
                                        <label for="finance">Financial Services</label>
                        
				</td>
                                </tr>                                        <tr>
				  <td><input type="radio" class="styled" name="clientDomain" value="Retail" id="clientDomain" />
                                        <label for="retail">Retail</label>
				</td>
                                </tr>    
                                
                                <tr>
				  <td><input type="radio" class="styled" name="clientDomain" value="Manufacturing" id="clientDomain" />
                                        <label for="manufacturing">Manufacturing</label>
                                  </td>
                                 </tr>
                                 
                                  <tr>
				  <td> <input type="radio" class="styled" name="clientDomain" value="Health" id="clientDomain" />
                                        <label for="health">Healthcare</label>
				  </td>
				  </tr>

                                   <tr>
				  <td> <input type="radio" class="styled" name="clientDomain" value="Media" id="clientDomain" />
                                        <label for="media">Media & Entertainment</label>
				  </td>
				  </tr>
				  
                                   <tr>
				  <td> <input type="radio" class="styled" name="clientDomain" value="Telecoms" id="clientDomain" />
                                        <label for="telecoms">Telecommunications</label>
				  </td>
				  </tr>

				  
                         </fieldset>
</table>                         
</td>
<td>
<fieldset>

<table>
                                <legend>Client Location</legend>
                                <tr>
				  <td><input type="radio" class="styled" name="clientLocation" value="EMEA" id="clientLocation" />
                                        <label for="EMEA">Europe</label>
                                  </td>
                                </tr>
                                
                                <tr>
				  <td> <input type="radio" class="styled" name="clientLocation" value="APAC" id="clientLocation" />
                                        <label for="APAC">Asia & Pacific</label>
                        
				</td>
                                </tr>                                        <tr>
				  <td><input type="radio" class="styled" name="clientLocation" value="LATAM" id="clientLocation" />
                                        <label for="LATAM">Latin America</label>
				</td>
                                </tr>    
                                
                                <tr>
				  <td><input type="radio" class="styled" name="clientLocation" value="NA" id="clientLocation" />
                                        <label for="NA">North America</label>
                                  </td>
                                 </tr>
                                 				  
                         </fieldset>
</table>                         

</td>
</tr>
<tr>
 <input type="hidden" name="updateStuff" value="yes"/>
<td> <input class="button" type="submit" name="Submit" value="Next" /></td>
</td>
</form>
</table>