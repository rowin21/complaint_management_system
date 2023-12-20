<?php

include "../config.php";

$a =json_decode(file_get_contents('php://input'), true);
$string = $a['myJsonString'];
$stringarray = explode('|',$string);

//echo $stringarray[0] . "\n" . $stringarray[1];
$countsql = "select count(dept_id) as count from department;";
$rowCount = mysqli_query($conn,$countsql);
$val = $rowCount->fetch_array();
$id = 1+$val['count'];
$deptID = "D".$id;

$insert = "INSERT INTO department VALUES ('$deptID','$stringarray[0]','$stringarray[1]')";
$result = $conn->query($insert);
if($result === true){
    echo 'Success';
}
else{
    echo $mysqli->error;
}
?>