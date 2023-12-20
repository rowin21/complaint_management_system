<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/navigation_admin.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/ajaxResponse.css">
    <link rel="stylesheet" href="css/collapsible.css">

</head>
<body>
    <?php
        include 'adminHeader.html';
        include '../config.php';
    ?>
    <div class="actionContainer">
        <div class="navigation">
            <div class="add">
                <ul>
                    <li data-li="AddDepartment" class="nav_btn">Add Department</li>
                    <li data-li="AddCategory" class="nav_btn">Add Category</li>
                </ul>
            </div>
            <div class="manage">
                <ul>
                    <li data-li="ManageOfficers" class="nav_btn">Manage Officers</li>
                    <li data-li="ManageComplaints" class="nav_btn">Manage Complaints</li>
                </ul>
            </div>
            <div class="login">
                <ul>
                    <li data-li="Assign" class="nav_btn">Assign Complaint</li>
                    <li data-li="Approve" class="nav_btn">Approve Officers</li>
                    <!-- <li data-li="ChangePassword" class="nav_btn">Change Password</li> -->
                </ul>
            </div>  
        </div>
        <div class="action">
            <div class="dash">
                <?php
                date_default_timezone_set('Asia/Calcutta');
                $Hour = date('G');

                if ( $Hour >= 5 && $Hour <= 11 ) {
                    echo "<p>Good Morning,</p>";
                } else if ( $Hour >= 12 && $Hour <= 14 ) {
                    echo "<p>Good Afternoon,</p>";
                } else if ( $Hour >= 15 || $Hour <= 4 ) {
                    echo "<p>Good Evening,</p>";
                }
                $dt = new DateTime(); 
                echo "<p> It's ".$dt->format('l')." today.</p>"; 
                ?>
            </div>

            <!--Add Department tab containing a form which will be submitted to addDepartment.php page for processing and storing in database-->
            <div class="tab AddDepartment">
                <div class="actionHeading">Add Department</div>
                <div class="form">
                    <div class="tabRow">
                        <!-- <div class="lableName">Department Name</div> -->
                        <div class="lableInput"><input type="text" name="deptName" id="deptName" placeholder="Department Name"></div>
                    </div>
                    <div class="tabRow">
                        <!-- <div class="lableName">Department Location</div> -->
                        <div class="lableInput"><input type="text" name="deptLoc" id="deptLoc" placeholder="Department Location"></div>
                    </div>
                    <div class="tabRow">
                        <div class="addBtn"><button class="submit_btn" type="submit" name="addDepartment" id="addDepartment" value="Add Department" onclick="addDepartment()">Add Department</button></div>
                    </div>
                    <div id="validDepartment"></div>
                </div>
                <div id="msgDepartment"></div>
            </div>

            <!--Add Category tab containing a form which will be submitted to addCategory.php page for processing and storing in database-->
            <div class="tab AddCategory">
                <div class="actionHeading">Add Category</div>
                <div class="form">
                    <div class="tabRow">
                        <!-- <div class="lableName">Complaint Name</div> -->
                        <div class="lableInput"><input type="text" name="compName" id="compName" placeholder="Complaint Name"></div>
                    </div>
                    <div class="tabRow">
                        <!-- <div class="lableName">Complaint Name</div> -->
                        <div class="lableInput">
                            <?php
                                $sql = "select * from department";
                                $res = mysqli_query($conn,$sql);
                                echo "<select id='val'>";
                                echo "<option value='#'>select department...</option>";
                                while($row = $res->fetch_assoc())
                                {

                            ?>
                                <option value="<?php echo $row['dept_id']?>"><?php echo $row['dept_name']?></option>
                            <?php
                                }
                                echo "</select>";?>
                        </div>
                    </div>
                    <div class="tabRow">
                        <!-- <div class="lableName">Complaint Description</div> -->
                        <div class="lableInput"><textarea name="compDesc" id="compDesc" cols="30" rows="10" placeholder="Complaint Description"></textarea></div>
                    </div>
                    <div class="tabRow">
                        <div class="addBtn"><button class="submit_btn" type="submit" name="addComplaint" id="addComplaint" value="Add Complaint" onclick ="addCategory()">Add Complaint</button></div>
                    </div>
                    <div id="validCategory"></div>
                </div>
                <div id="msgCategory"></div>
            </div>

            <!--Manage officer tab-->
            <div class="tab ManageOfficers">
                <div class="actionHeading">Manage Officers</div>
                <!--All officers list retrived from officers table from database-->
                <div class="btns" id="addOfficer">
                    <button class="add-btn" name="addOfficer" id="addOfficer" value="Add Officer" onclick="openForm()">ADD OFFICER</button>
                    <button class="add-btn" name="backButton" id="backButton" value="back" onclick="closeForm()" style="display:none;">BACK</button>
                </div>
                <div id="officerForm" style="display:none">
                    <div class="form_row">
                        <span class="fromHeading"><h2>Enter the Officer Details</h2></span>    
                    </div>
                    <div class="form_row">
                        <div class="form_col">
                            <input type="text" id="fname" name="fname" placeholder="First name">
                        </div>
                        <div class="form_col">
                            <input type="text" id="lname" name="lname" placeholder="Lastname">
                        </div>
                    </div>
                    <div class="form_row">
                        <div class="form_col">
                            <input type="text" id="phone" name="phone" placeholder="Phone">
                        </div>
                        <div class="form_col">
                            <input type="email" id="email" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form_row">
                        <div class="form_col">
                            <?php
                                $selectSQL = "SELECT * FROM department";
                                $sql = mysqli_query($conn,$selectSQL);
                                //print_r($sql->fetch_assoc());
                                echo "<select id='val'>";
                                echo "<option value='#'>select...</option>";
                                while($row=$sql->fetch_assoc())
                                {                    
                                ?>
                                    <option value="<?php echo $row['dept_id']?>"><?php echo $row['dept_name']?></option>
                                <?php
                                }   
                                echo "</select>";
                            ?>
                        </div>
                        <div class="form_col">
                            <input type="text" id="desig" name="desig" placeholder="Designation">
                        </div>
                    </div>
                    <div class="form_row">
                        <div class="form_col">
                            <input type="text" id="username" name="username" placeholder="Username">
                        </div>
                        <div class="form_col">
                            <input type="password" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form_row">
                        <div class="form_col">
                            <input class = "save_btn" type="button" value="Save">
                        </div>
                        <div class="form_col">
                            <input class="cancel_btn" type="button" value="Cancel"> 
                        </div>
                    </div>
                    
                    <div id="validOfficer"></div>       
                </div>
                <div id="msgOfficer"></div>

                <div class="officerList" id="officerList">
                    <div class="officerListHeading">
                        <div class="listHeading">Officer ID</div>
                        <div class="listHeading_15">Name</div>
                        <div class="listHeading_15">Email</div>
                        <div class="listHeading_15">Phone</div>
                        <div class="listHeading">Department</div>
                        <div class="listHeading">Designation</div>
                        <div class="listHeading">Location</div>
                        <div class="listHeading_15"></div>
                    </div>
                    <?php
                        $selectSQL = "SELECT * FROM officer where status='approved'";
                        $sql = mysqli_query($conn,$selectSQL);

                        //print_r($resultArray);
                        while($res = $sql->fetch_assoc()){
                           ?>
                            <div class="officerListData">
                                <div class="listData"> <?php echo $res['officer_id'];  ?> </div>
                                <div class="listData_15"> <?php echo $res['first_name'] . " " . $res['last_name'];  ?> </div>
                                <!-- <span> <?php ?> </span> -->
                                <div class="listData_15"> <?php echo $res['email'];  ?> </div>
                                <div class="listData_15"> <?php echo $res['phone'];  ?> </div>
                                <div class="listData"> <?php echo $res['dept_id'];  ?> </div>
                                <div class="listData"> <?php echo $res['designation'];  ?> </div>
                                <div class="listData"> <?php echo $res['location'];  ?> </div>
                                <div class="listData_15"> <button class="del_btn"> <a href="#?id=<?php echo $res['registration_no']; ?>" class="text-white"> Delete </a></button> </div>
                            </div>
                           <?php 
                           }
                    ?>
                </div>
            </div>

            <!--Manage Complaints tab-->
            <div class="tab ManageComplaints">
                <div class="actionHeading">
                    <span>Manage Complaints</span>
                </div>
                <div class="btns" id="compBtn">
                    <button class="add-btn" name="pending" id="pending" value="Pending" onclick="openComplaintPending()">PENDING</button>
                    <button class="add-btn" name="closed" id="closed" value="closed" onclick="openComplaint()">CLOSED</button>
                </div>
                <!--All officers list retrived from officers table from database-->
                <div class="complaintList" id="complaintListPending" style = "display:block">
                    <div class="officerListHeading">
                        <div class="listHeading_25">Complaint ID</div>
                        <div class="listHeading_25">Officer Assigned</div>
                        <div class="listHeading_25">Location</div>
                        <div class="listHeading_25"></div>
                    </div>
                    <?php
                        $pending = "SELECT * FROM complaint c, assign_complaint ac where (c.status='pending' or c.status='assigned') and complaint_id=comp_id";
                        $sql = mysqli_query($conn,$pending);
                        while($res = $sql->fetch_assoc()){
                            $officer_name="select first_name, last_name from officer where officer_id='".$res['officer_id']."'";
                            $sql1 = mysqli_query($conn,$officer_name);
                            $officerName = $sql1->fetch_assoc();
                           ?>
                            <div class="officerListData">
                                <div class="listData_25"> <?php echo $res['complaint_id'];  ?> </div>
                                <div class="listData_25"> <?php echo $officerName['first_name']." ".$officerName['last_name'] ;?> </div>
                                <div class="listData_25"> <?php echo $res['location']?> </div>
                                <div class="listData_25"> <button class="del_btn"> <a href="#?id=<?php echo $res['registration_no']; ?>" class="text-white"> Delete </a></button> </div>
                            </div>
                           <?php 
                           }
                    ?>
                </div>
                <div class="complaintList" id="complaintListClosed" style="display:none">
                    <div class="officerListHeading">
                        <div class="listHeading_25">Complaint ID</div>
                        <div class="listHeading_25">Officer Assigned</div>
                        <div class="listHeading_25">Location</div>
                        <div class="listHeading_25"></div>
                    </div>
                    <?php
                        $selectSQL = "SELECT * FROM complaint c, assign_complaint ac where c.status='closed' and complaint_id=comp_id ";
                        $sql = mysqli_query($conn,$selectSQL);

                        //print_r($resultArray);
                        while($res = $sql->fetch_assoc()){
                            $officer_name="select first_name, last_name from officer where officer_id='".$res['officer_id']."'";
                            $sql1 = mysqli_query($conn,$officer_name);
                            $officerName = $sql1->fetch_assoc();
                           ?>
                            <div class="officerListData">
                                <div class="listData_25"> <?php echo $res['complaint_id'];  ?> </div>
                                <div class="listData_25"> <?php echo $officerName['first_name']." ".$officerName['last_name'] ;?> </div>
                                <div class="listData_25"> <?php echo $res['location']?> </div>
                                <div class="listData_25"> <button class="del_btn"> <a href="#?id=<?php echo $res['registration_no']; ?>" class="text-white"> Delete </a></button> </div>
                            </div>
                           <?php 
                           }
                    ?>
                </div>
            </div>

            <!--Assign complaint-->
            <div class="tab Assign">
                <div class="actionHeading">
                    <span>Assign Complaints</span>
                </div>
                <?php
                    $sql = "select * from department";
                    $res = mysqli_query($conn,$sql);
                    while($row = $res->fetch_assoc()){
                ?>
                <!--All officers list retrived from officers table from database-->
                <button class="accordion"><?php echo $row['dept_name'];?></button>
                <div class="panel">
                    
                    <div class="officerListHeading">
                        <div class="listHeading_15">Complaint Id</div>
                        <div class="listHeading_15">Officer</div>
                        <div class="listHeading_15">location</div>
                        <div class="listHeading_15"></div>
                    </div>
                    <?php
                        $complaints= "select complaint_id,location, dept_id from complaint c, complainttypes ct, department d where ct.deptID = d.dept_id and d.dept_name='".$row['dept_name']."' and status='pending'";
                        //echo  $complaints;
                        $res_comp = mysqli_query($conn,$complaints); 
                        while($row = $res_comp->fetch_assoc()){
                            ?>
                            <div class="officerListData">
                                <div class="listData_15"> <?php echo $row['complaint_id'];  ?> </div>
                                <div class="listData_15">
                                    <?php
                                        $selectOfficer = "select * from officer where dept_id ='".$row['dept_id']."'";
                                        $res_officer = mysqli_query($conn,$selectOfficer);
                                            echo "<select id='off'>";
                                            echo "<option value='#'>select...</option>";
                                            while($row1=$res_officer->fetch_assoc())
                                            {                    
                                            ?>  
                                                <option value="<?php echo $row1['officer_id']?>"><?php echo $row1['first_name']?></option>
                                            <?php
                                            }   
                                            echo "</select>";
                                    ?>
                                </div>
                                <div class="listData_15"> <?php echo $row['location'];  ?> </div>
                                <div class="listData_15"> <button class="approve_btn" onclick="assignWork('<?php echo $row['complaint_id']?>')">Assign</a></button> </div>
                            </div>
                           <?php
                        }
                    ?>
                </div>
                <?php
                    }
                ?>
                <div id="msgAssign"></div>
            </div>

            <!--User login log-->
            <div class="tab Approve">
                <div class="actionHeading">
                    <span>Officers</span>
                </div>
                <!--All officers list retrived from officers table from database-->
                <div class="officerList" id="officerList">
                    <div class="officerListHeading">
                        <div class="listHeading">Officer ID</div>
                        <div class="listHeading_15">Name</div>
                        <div class="listHeading_15">Email</div>
                        <div class="listHeading_15">Phone</div>
                        <div class="listHeading">Department</div>
                        <div class="listHeading">Location</div>
                        <div class="listHeading">Status</div>
                        <div class="listHeading_15"></div>
                    </div>
                    <?php
                        $selectSQL = "SELECT * FROM officer where status='pending'";
                        $sql = mysqli_query($conn,$selectSQL);

                        //print_r($resultArray);
                        while($res = $sql->fetch_assoc()){
                           ?>
                            <div class="officerListData">
                                <div class="listData"> <?php echo $res['officer_id'];  ?> </div>
                                <div class="listData_15"> <?php echo $res['first_name'] . " " . $res['last_name'];  ?> </div>
                                <!-- <span> <?php ?> </span> -->
                                <div class="listData_15"> <?php echo $res['email'];  ?> </div>
                                <div class="listData_15"> <?php echo $res['phone'];  ?> </div>
                                <div class="listData"> <?php echo $res['dept_id'];  ?> </div>
                                <div class="listData"> <?php echo $res['location'];  ?> </div>
                                <div class="listData"> <?php echo $res['status'];  ?> </div>
                                <div class="listData_15"> <button class="approve_btn" onclick="approveOfficer('<?php echo $res['officer_id'];  ?>')">Approve</a></button> </div>
                            </div>
                           <?php 
                           }
                    ?>
                </div>
                <div id="msgApprove"></div>
            </div>

        </div>
    </div>
    <?php
        include 'adminFooter.html';
    ?>
    <script src="js/navbarDisplay.js"></script>
    <script src="js/addDepartment.js"></script>
    <script src="js/addCategory.js"></script>
    <script src="js/addOfficer.js"></script>
    <script src="js/openComplaint.js"></script>
    <script src="js/approveOfficer.js"></script>
    <script src="js/collapsible.js"></script>
    <script src="js/assignWork.js"></script>
</body>
</html>