<link rel="stylesheet" href="css/successStyle.css">
<?php

include "../config.php";

$officer_id = $_POST['officer_id'];
$compID = $_POST['comp_id'];
$desc = $_POST['desc'];
$file_name = $_FILES['image']['name'];
$file_tmp_name = $_FILES['image']['tmp_name'];
$file_path = "uploads/" . $file_name;
move_uploaded_file($file_tmp_name,"uploads/" . $file_name);

$countsql = "select count(report_id) as count from report;";
$rowCount = mysqli_query($conn,$countsql);
$val = $rowCount->fetch_array();
$id = 1+$val['count'];

date_default_timezone_set('Asia/Calcutta');
$d = date("Y-m-d");

if($officer_id != NULL && $compID != NULL && $desc != NULL)
        {
            $sql = "insert into report values('$id','$officer_id','$compID','$d','$desc','$file_name','$file_path')";
            echo $sql;
            $res = mysqli_query($conn,$sql);
            if($res === true){
                $updateStatus = "update complaint set status='closed' where complaint_id='$compID'";
                $UpdateRes = mysqli_query($conn,$updateStatus);
                if($UpdateRes === true){
                    
                ?>
                <div id='card' class="animated fadeIn">
                        <div id='upper-side'>
                            <img src="assets/greenTick.png" alt="tick" width="100px">
                                <h3 id='status'>Success</h3>
                        </div>
                        <div id='lower-side'>
                            <p id='message'>Your Complaint has been successfully created.</p>
                            <p>Your complaint will be processed soon.</p>
                            <script>
                                setTimeout(function(){
                                    location.href = "officerDashboard.php";
                                }, 5000);
                            </script>
                        </div>
                    </div>
                    <?php
                }
                else{
                    echo $conn->error;
                }
            }
            else{
                echo $conn->error;
            }

        }
?>