<?php

include "../config.php";

$a =json_decode(file_get_contents('php://input'), true);
$string = $a['myJsonString'];

$update = "update officer set status = 'approved' where officer_id = '$string'";
$result = $conn->query($update);
if($result === true){
    echo 'Success';
}
else{
    echo $mysqli->error;
}
?>