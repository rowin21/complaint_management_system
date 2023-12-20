<?php
$conn = mysqli_connect("localhost", "root", "", "ocms");
if($conn === false){
    die("ERROR: Could not connect. ". mysqli_connect_error());
}
// else
//     echo "connected";
?>