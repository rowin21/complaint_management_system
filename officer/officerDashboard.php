<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Officer Dashboard</title>
    <link rel="stylesheet" href="css/navigation_user.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <?php
        include 'officerHeader.html';
        include '../config.php';
    ?>
    <div class="actionContainer">
        <div class="navigation">
            <ul>
                <li data-li="Profile" class="nav_btn">Profile</li>
                <li data-li="ViewComplaint" class="nav_btn">View Complaint</li>
                <li data-li="GenerateReport" class="nav_btn">Generate Report</li>
                <li data-li="WorkHistory" class="nav_btn">Work History</li>
                <!-- <li data-li="ChangePassword" class="nav_btn">Change Password</li> -->
            </ul>
        </div>
        <div class="action">
            <div class="dash">
                <?php
                date_default_timezone_set('Asia/Calcutta');
                $Hour = date('G');

                $email=$_COOKIE["username"];
                $name = "select first_name,last_name,officer_id from officer where email='$email';";
                $name_res = mysqli_query($conn,$name);
                $name_val = $name_res->fetch_array();
                if ( $Hour >= 5 && $Hour <= 11 ) {
                    echo "<p>Good Morning,". $name_val[0]." ".$name_val[1] ."</p>";
                } else if ( $Hour >= 12 && $Hour <= 14 ) {
                    echo "<p>Good Afternoon,". $name_val[0]." ".$name_val[1] ."</p>";
                } else if ( $Hour >= 15 || $Hour <= 4 ) {
                    echo "<p>Good Evening,". $name_val[0]." ".$name_val[1] ."</p>";
                }
                $dt = new DateTime(); 
                echo "<p> It's ".$dt->format('l')." today.</p>"; 
                ?>
            </div>
            <div class="tab Profile">
                <div class="actionHeading">Profile</div>
                <div class="form">
                <?php

                    $sql = "select * from officer where email='$email'";
                    $result = mysqli_query($conn,$sql);
                    $val = $result->fetch_assoc();
                    //print_r($val);
                ?>
                <div class="profileHead"><?php echo "Welcome " . $val["first_name"] ." ". $val['last_name'] ?></div>
                <div class="profile"><?php echo " on: ". $val["update_date"]?></div>
                <table class="profile_table">
                    <tr>
                        <td>User ID :<?php echo $val["officer_id"]?></td>
                        <td>Name :<?php echo $val["first_name"] ." ". $val['last_name']?></td>
                    </tr>
                    <tr>
                        <td>Phone: <?php echo $val["phone"]?></td>
                        <td>Email :<?php echo $val["email"]?></td>
                    </tr>
                    <tr>
                        <td>Department id :<?php echo $val["dept_id"]?></td>
                        <td>Designation :<?php echo $val["designation"]?></td>
                    </tr>
                    <tr><td>Location :<?php echo $val["location"]?></td>       
                        <td>Registered date :<?php echo $val["reg_date"]?></td>
                    </tr>   
                        <tr><td>Updation date :<?php echo $val["update_date"]?></td>
                    </tr>
                </table>
                </div>
            </div>
            <div class="tab ViewComplaint">
                <div class="actionHeading">View Complaint</div>
                <div class="form">
                    <div class="complaintListHeading">
                        <div class="listHeading_15">Complaint ID</div>
                        <div class="listHeading_15">Complaint Type</div>
                        <div class="listHeading_15">Location</div>
                        <div class="listHeading_15">Status</div>
                        <div class="listHeading_15"></div>
                    </div>
                    <?php
                        $sql = "select * from complaint c,assign_complaint ac where (officer_id ='$name_val[2]' and c.status='assigned') and complaint_id = comp_id";
                        //echo $sql;
                        $sql = mysqli_query($conn,$sql);
                        while($res = $sql->fetch_assoc()){
                            $comp_name="select comp_name from complainttypes where comp_id='".$res['type_id']."'";
                            $sql = mysqli_query($conn,$comp_name);
                            $complaintName = $sql->fetch_assoc();
                        ?>
                        <div class="complaintListData">
                            <div class="listData_15"> <?php echo $res['complaint_id'];  ?> </div>
                            <div class="listData_15"> <?php echo $complaintName['comp_name']?> </div>
                            <div class="listData_15"> <?php echo $res['location'];  ?> </div>
                            <div class="listData_15"> <?php echo $res['status'];  ?> </div>
                            <div class="listData_15"> <button class="view_btn" onclick="openDetails('<?php //echo $res['complaint_id'];  ?>')">View Details</button> </div>
                            <!-- <div class="listData_15"> <button class="del_btn"> <a href="#?id=<?php echo $res['complaint_id']; ?>" class="text-white"> Delete </a></button> </div> -->
                        </div>
                        <?php
                        }
                    ?>
                </div>
            </div>
            <div class="tab GenerateReport">
                <div class="actionHeading">Generate Report</div>
                <div class="form">
                        <form action="generateReport.php" method="post" enctype="multipart/form-data">
                        <table class="Report">
                            <tr>
                                <td>
                                    <input type="text" name="officer_id" id="officer_id" value="<?php echo $name_val[2]?>" hidden>
                                </td>
                            </tr>
                    <tr>
                        <td><label for="complaint">Complaint Id</label></td>
                        <td>
                            <?php
                                $sql = "select * from complaint c, assign_complaint ac where ac.officer_id='$name_val[2]' and c.status='assigned' and complaint_id=comp_id";
                                //echo $sql;
                                $res = mysqli_query($conn,$sql);
                                echo "<select id='val' name='comp_id'>";
                                echo "<option value='#'>select...</option>";
                                while($row=$res->fetch_assoc())
                                {                    
                                ?>
                                    <option value="<?php echo $row['complaint_id']?>"><?php echo $row['complaint_id']." - ". $row['location']?></option>
                                <?php
                                }   
                                echo "</select>";
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="img">Upload Image</label></td>
                        <td><input type="file" id="image" name="image" required ></td>
                    </tr>
                    <tr>
                        <td><label for="c_des">Complaint description</label></td>
                        <td colspan="3"><textarea rows="7" id="desc" name="desc"></textarea></td>                 
                    </tr>
                    <tr>
                        <td colspan="4"><button type="submit" value="Generate" name="generate_report" id="submit">Generate Report</button></td>            
                    </tr>
                </table>
                        </form>
                </div>
                
            </div>
            <div class="tab WorkHistory">
                <div class="actionHeading">Work History</div>
                <div class="form">
                    <div class="complaintListHeading">
                        <div class="listHeading_15">Complaint ID</div>
                        <div class="listHeading_15">Complaint Type</div>
                        <div class="listHeading_15">Location</div>
                        <div class="listHeading_15">Status</div>
                        <div class="listHeading_15"></div>
                    </div>
                    <?php
                        $sql = "select * from complaint c,assign_complaint ac where officer_id ='$name_val[2]' and complaint_id = comp_id";
                        //echo $sql;
                        $sql = mysqli_query($conn,$sql);
                        while($res = $sql->fetch_assoc()){
                            $comp_name="select comp_name from complainttypes where comp_id='".$res['type_id']."'";
                            $sql = mysqli_query($conn,$comp_name);
                            $complaintName = $sql->fetch_assoc();
                        ?>
                        <div class="complaintListData">
                            <div class="listData_15"> <?php echo $res['complaint_id'];  ?> </div>
                            <div class="listData_15"> <?php echo $complaintName['comp_name']?> </div>
                            <div class="listData_15"> <?php echo $res['location'];  ?> </div>
                            <div class="listData_15"> <?php echo $res['status'];  ?> </div>
                            <div class="listData_15"> <button class="view_btn" onclick="openDetails('<?php //echo $res['complaint_id'];  ?>')">View Details</button> </div>
                            <!-- <div class="listData_15"> <button class="del_btn"> <a href="#?id=<?php echo $res['complaint_id']; ?>" class="text-white"> Delete </a></button> </div> -->
                        </div>
                        <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    <?php
        include 'officerFooter.html';
    ?>
    <script src="js/navbarDisplay.js"></script>
</body>
</html>