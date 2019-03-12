<?php
include('functions.php');
date_default_timezone_set('Europe/London');
if( $_POST ){
	
    $origin = $_POST['txt_origin'];
    $destination = $_POST['txt_destination'];
    $date = $_POST['txt_date'];
    $userId = $_POST['txt_userid'];
    $departureTime = $_POST['txt_departure'];

    $departEpoch = strtotime($date . " " . $departureTime);
        
    
     $request_url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . urlencode($origin) . "&destinations=" . urlencode($destination) . "&mode=transit&departure_time=" . $departEpoch . "&key=XXXXXXXXXXXXXXXXXX";
    $details = json_decode(file_get_contents($request_url));
	
	 $distance = $details->rows[0]->elements[0]->distance->value;
	 $duration = $details->rows[0]->elements[0]->duration->value;
	 $response = $details->status;
	 
	 if($response != "OK") {
	 	exit;
	 }
	 connectDB();
	 
    $qq = "INSERT into data (userID,origin,destination,distance,duration,date) VALUES ($userId,'" . $origin . "','" . $destination . "',$distance,$duration,'" . $date . "')";
    $result = mysql_query($qq);
    ?>
    
    <table class="table table-striped" border="0">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong>Success</strong>, Journey Submitted Successfully...
    	</div>
    </td>
    </tr>
    
    <tr>
    <td>Origin</td>
    <td><?php echo $origin ?></td>
    </tr>
    
    <tr>
    <td>Destination</td>
    <td><?php echo $destination ?></td>
    </tr>

    <tr>
    <td>Distance</td>
    <td><?php echo ceil($distance/1000) . " Kms"; ?></td>
    </tr>

    <tr>
    <td>Duration</td>
    <td><?php echo secondsToTime($duration); ?></td>
    </tr>

    
    <tr>
    <td>Date</td>
    <td><?php echo $date; ?></td>
    </tr>
        
    </table>
    <?php
	
}
