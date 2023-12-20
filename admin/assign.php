<?php

include "../config.php";

$a =json_decode(file_get_contents('php://input'), true);
$string = $a['myJsonString'];
$stringarray = explode('|',$string);

date_default_timezone_set('Asia/Calcutta');
$d = date("Y-m-d");
// echo $time;

$insert = "INSERT INTO assign_complaint VALUES ('$stringarray[1]','$stringarray[0]','$d')";
$result = $conn->query($insert);
if($result === true){
    $update = "update complaint set status='assigned' where complaint_id='".$stringarray[0]."'";
    $res = $conn->query($update);
    if($res === true){
        echo 'Success';
    }
    
}
else{
    echo $conn->error;
}
?>