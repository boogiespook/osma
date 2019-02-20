<?php
session_start();
include_once 'dbconnect.php';
connectDB();
parse_str($_SERVER["QUERY_STRING"], $data);
$data['client'] = $data['customerName']; // FIXME hack

$chars = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
$data['hash'] = substr(str_shuffle($chars), 0, 5);

## Get the username from the userId
#$q1 = "select name from users where id = '" . $data['userId'] . "'";
$q1 = "select name from users where id = '" . $_SESSION['usr_id'] . "'";
$res = mysqli_query($db, $q1);
$row = mysqli_fetch_assoc($res);
$data['user'] = $row['name'];

$fields = array('user','client','rhEmail','country','lob','consume','collaborate','createOS','policy','question11','question12','question13','question14','question15','question21','question22','question23','question24','question25','question26','question31','question32','question33','question41','question42','question43','question44','question51','question52','question53','area1_comments','area2_comments','area3_comments','area4_comments','area5_comments','hash');
foreach ($fields as $field) {
	$$field = mysqli_real_escape_string($db, $data[$field]);
}
#var_dump($fields);
$qq = "INSERT INTO data (" . implode(',', $fields).") VALUES ('$user','$client','$rhEmail','$country','$lob',$consume,$collaborate,$createOS,$policy,$question11,$question12,$question13,$question14,$question15,$question21,$question22,$question23,$question24,$question25,$question26,$question31,$question32,$question33,$question41,$question42,$question43,$question44,$question51,$question52,$question53,'$area1_comments','$area2_comments','$area3_comments','$area4_comments','$area5_comments','$hash')";
#print $qq;
$result = mysqli_query($db, $qq);

if (!$result) {
    printf("Errormessage: %s\n", mysqli_error($db));
}

#print_r($result);

// TODO check $result

header("Location: results.php?hash=$hash");
?>