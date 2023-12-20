<?php

include "../config.php";

$a =json_decode(file_get_contents('php://input'), true);
$string = $a['myJsonString'];
$stringarray = explode('|',$string);

//echo $stringarray[0] . "\n" . $stringarray[1]. "\n" .$stringarray[2];
$countsql = "select count(comp_id) as count from complainttypes;";
$rowCount = mysqli_query($conn,$countsql);
$val = $rowCount->fetch_array();
$id = 1+$val['count'];
$compID = "C".$id;
//echo $compID;
date_default_timezone_set('Asia/Calcutta');
$d = date("Y-m-d");
// echo $time;

$insert = "INSERT INTO complainttypes VALUES ('$compID','$stringarray[0]','$stringarray[1]','$d','$stringarray[2]')";
$result = $conn->query($insert);
if($result === true){
    echo 'Success';
}
else{
    echo $mysqli->error;
}
?>