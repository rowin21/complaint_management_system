<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/navigation_user.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <?php
        include 'userHeader.html';
        include '../config.php';
    ?>
    <div class="actionContainer">
        <div class="navigation">
            <ul>
                <li data-li="Account" class="nav_btn">Account</li>
                <li data-li="RegisterComplaint" class="nav_btn">Register Complaint</li>
                <li data-li="Track" class="nav_btn">Track Status</li>
                <li data-li="View" class="nav_btn">View Report</li>
                <!-- <li data-li="ChangePassword" class="nav_btn">Change Password</li> -->
            </ul>
        </div>
        <div class="action">
            <div class="dash">
                <?php
                date_default_timezone_set('Asia/Calcutta');
                $Hour = date('G');
                $email=$_COOKIE["username"];
                $name = "select first_name,last_name,user_id from userdata where email='$email';";
                $name_res = mysqli_query($conn,$name);
                $name_val = $name_res->fetch_array();
                if ( $Hour >= 5 && $Hour <= 11 ) {
                    echo "<p>Good Morning, ". $name_val[0]." ".$name_val[1] ."</p>";
                } else if ( $Hour >= 12 && $Hour <= 14 ) {
                    echo "<p>Good Afternoon, ". $name_val[0]." ".$name_val[1] ."</p>";
                } else if ( $Hour >= 15 || $Hour <= 4 ) {
                    echo "<p>Good Evening, ". $name_val[0]." ".$name_val[1] ."</p>";
                }
                $dt = new DateTime(); 
                echo "<p> It's ".$dt->format('l')." today.</p>"; 
                ?>
            </div>
            <div class="tab Account">
                <div class="actionHeading">Profile</div>
                <div class="form">
                <?php

                    $sql = "select * from userdata where email='$email' ";
                    $result = mysqli_query($conn,$sql);
                    $val = $result->fetch_assoc();
                    //print_r($val);
                ?>
                <div class="profileHead"><?php echo "Welcome " . $val["first_name"] ." ". $val['last_name'] ?></div>
                <div class="profile"><?php echo "Registered on: ". $val["update_date"]?></div>
                <table class="profile_table">
                    <tr>
                        <td>User ID : <?php echo $val["user_id"]?></td>
                        <td>Name : <?php echo $val["first_name"] ." ". $val['last_name']?></td>
                    </tr>
                    <tr>
                        <td>Phone : <?php echo $val["phone"]?></td>
                        <td>Email : <?php echo $val["email"]?></td>
                    </tr>
                    <tr>
                        <td>Street : <?php echo $val["street"]?></td>
                        <td>District : <?php echo $val["district"]?></td>
                    </tr>
                    <tr>
                        <td>Pincode : <?php echo $val["pin_code"]?></td>
                    </tr>
                </table>
                </div>
            </div>
            <div class="tab RegisterComplaint">
                <div class="actionHeading"></div>
                <div class="form">
                    <div class="formheading">Register Complaint</div>
                        <form method="post" action="reg_Complaint.php" enctype="multipart/form-data">
                        <table class="RegComplaint">
                            <tr>
                                <td><label for="contact">Contact Number</label></td>
                                <td><input type="text" id="contact_no" name="c_no" required ></td>
                                <td><input type="text" name="user_id" value="<?php echo $name_val[2];?>" hidden></td>
                            </tr>
                            <tr>
                                <td><label for="c_type">Complaint type</label></td>
                                <td>
                                <?php
                                $selectSQL = "SELECT * FROM complainttypes";
                                $sql = mysqli_query($conn,$selectSQL);
                                //print_r($sql->fetch_assoc());
                                echo "<select id='c_type' name='c_type'>";
                                echo "<option value='#'>select...</option>";
                                while($row=$sql->fetch_assoc())
                                {                    
                                ?>
                                    <option value="<?php echo $row['comp_id']?>"><?php echo $row['comp_name']?></option>
                                <?php
                                }   
                                echo "</select>";
                                ?>
                                </td>
                                <td><label for="c_level">Complaint level</label></td>
                                <td>
                                    <select name="c_level" id="c_level">
                                        <option value="-1">Select</option>
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Average">Average</option>
                                        <option value="High">High</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="c_des">Complaint description</label></td>
                                <td colspan="3"><textarea rows="5" name="desc" id="desc"></textarea></td>                 
                            </tr>
                            <tr>
                                <td><label for="loc">Location</label></td>
                                <td><input type="text" name="loc" id="loc"></td>
                                <td><label for="pincode">Pincode</label></td>
                                <td><input type="text" name="pin_code" id="pin"></td>
                            </tr>
                            <tr>
                                <td><label for="img">Upload Image</label></td>
                                <td colspan="3"><input type="file" name="image" id="img"></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2"><input type="submit" value="Register Complaint" name="rcomplaint" id="submit"></td>
                            </tr>
                        </table>
                        <!-- </form> -->
                        <div id="msg_comp"></div>
                    </div>
                </div>
            
            <div class="tab Track">
                <div class="actionHeading">Track Complaint Status</div>
                <div class="form">
                    <div class="complaintListHeading">
                        <div class="listHeading_15">Complaint ID</div>
                        <div class="listHeading_15">Complaint Type</div>
                        <div class="listHeading_15">Location</div>
                        <div class="listHeading_15">Officer Assigned</div>
                        <div class="listHeading">Status</div>
                        <div class="listHeading_15"></div>
                        <div class="listHeading_15"></div>
                    </div>
                    <?php
                        $sql = "select * from complaint c,assign_complaint ac where user_id ='$name_val[2]' and status='assigned' and complaint_id = comp_id";
                        //echo $sql;
                        $sql = mysqli_query($conn,$sql);
                        while($res = $sql->fetch_assoc()){
                            $comp_name="select comp_name from complainttypes where comp_id='".$res['type_id']."'";
                            $sql = mysqli_query($conn,$comp_name);
                            $complaintName = $sql->fetch_assoc();
                            
                            $officer_name="select first_name, last_name from officer where officer_id='".$res['officer_id']."'";
                            $sql = mysqli_query($conn,$officer_name);
                            $officerName = $sql->fetch_assoc();
                        ?>
                        <div class="complaintListData">
                            <div class="listData_15"> <?php echo $res['complaint_id'];  ?> </div>
                            <div class="listData_15"> <?php echo $complaintName['comp_name']?> </div>
                            <div class="listData_15"> <?php echo $res['location'];  ?> </div>
                            <div class="listData_15"> <?php echo $officerName['first_name']." ".$officerName['last_name'] ;  ?> </div>
                            <div class="listData"> <?php echo $res['status'];  ?> </div>
                            <!-- <div class="listData_15"> <button class="view_btn" onclick="openDetails('<?php //echo $res['complaint_id'];  ?>')">View Details</button> </div> -->
                            <div class="listData_15"> <button class="del_btn"> <a href="#?id=<?php echo $res['complaint_id']; ?>" class="text-white"> Cancel </a></button> </div>
                        </div>
                        <?php
                        }
                    ?>
                </div>
            </div>
            <div class="tab View">
                <div class="actionHeading">View Complaints</div>
                <div class="form">
                    <div class="complaintListHeading">
                        <div class="listHeading_15">Complaint ID</div>
                        <div class="listHeading_15">Complaint Type</div>
                        <div class="listHeading_15">Location</div>
                        <div class="listHeading_15">Officer Assigned</div>
                        <div class="listHeading_15">Complaint Date</div>
                        <div class="listHeading_15">Status</div>
                        <div class="listHeading_15"></div>
                    </div>
                    <?php
                        $sql = "select * from complaint c,assign_complaint ac where (user_id ='$name_val[2]' and c.status='closed') and complaint_id = comp_id";
                        //echo $sql;
                        $sql = mysqli_query($conn,$sql);
                        while($res = $sql->fetch_assoc()){
                            $comp_name="select comp_name from complainttypes where comp_id='".$res['type_id']."'";
                            $sql = mysqli_query($conn,$comp_name);
                            $complaintName = $sql->fetch_assoc();
                            
                            $officer_name="select first_name, last_name from officer where officer_id='".$res['officer_id']."'";
                            $sql = mysqli_query($conn,$officer_name);
                            $officerName = $sql->fetch_assoc();
                        ?>
                        <div class="complaintListData">
                            <div class="listData_15"> <?php echo $res['complaint_id'];  ?> </div>
                            <div class="listData_15"> <?php echo $complaintName['comp_name']?> </div>
                            <div class="listData_15"> <?php echo $res['location'];  ?> </div>
                            <div class="listData_15"> <?php echo $officerName['first_name']." ".$officerName['last_name'] ;  ?> </div>
                            <div class="listData_15"> <?php echo $res['comp_date'];  ?> </div>
                            <div class="listData_15"> <?php echo $res['status'];  ?> </div>
                            <div class="listData_15"></div>
                            <!-- <div class="listData_15"> <button class="view_btn" onclick="openDetails('<?php //echo $res['complaint_id'];  ?>')">View Details</button> </div> -->
                            <!-- <div class="listData_15"> <button class="del_btn"> <a href="#?id=<?php //echo $res['complaint_id']; ?>" class="text-white"> Delete </a></button> </div> -->
                        </div>
                        <?php
                        }
                    ?>
                </div>
            </div>
            
        </div>
    <?php
        include 'userFooter.html';
    ?>
    <script src="js/navbarDisplay.js"></script>
    <!-- <script src="js/openDetails.js"></script> -->
</body>
</html>