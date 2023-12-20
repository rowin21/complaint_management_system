<link rel="stylesheet" href="css/successStyle.css">
<?php
    include '../config.php';

    if(isset($_POST['rcomplaint']))
    {
        $user_id = $_POST['user_id'];
        $contact_no = $_POST['c_no'];
        $complaint_type = $_POST['c_type'];
        $complaint_level = $_POST['c_level'];
        $description = $_POST['desc'];
        $location = $_POST['loc'];
        $pin = $_POST['pin_code'];

        $file_name = $_FILES['image']['name'];
        $file_tmp_name = $_FILES['image']['tmp_name'];
        $file_path = "uploads/" . $file_name;
        move_uploaded_file($file_tmp_name,"uploads/" . $file_name);

        // echo $user_id . "<br>";
        // echo $contact_no;
        // echo "<br>" . $description;

        //INSERT INTO `complaint`(`complaint_id`, `user_id`, `type_id`, `phone`, `pincode`, `description`, `image`, `image_path`, `comp_date`, `comp_level`, `status`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]')


        date_default_timezone_set('Asia/Calcutta');
        $d = date("Y-m-d");


        $countsql = "select count(complaint_id) as count from complaint;";
        $rowCount = mysqli_query($conn,$countsql);
        $val = $rowCount->fetch_array();
        $id = 1+$val['count'];
        $complaint_id = date('y').date('m').date('d').$id;

        //echo  $complaint_id;
        $status ="pending";
        if($user_id != NULL && $contact_no != NULL && $complaint_type != NULL && $complaint_level != NULL && $description != NULL && $location != NULL && $pin != NULL && $complaint_id!= NULL)
        {
            $sql = "insert into complaint values ('$complaint_id','$user_id','$complaint_type','$contact_no','$pin','$description','$location','$file_name','$file_path','$d','$complaint_level','$status')";
            $res = mysqli_query($conn,$sql);
            if($res === true){
                //echo 'Success';
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
                                    location.href = "userDashboard.php";
                                }, 5000);
                            </script>
                        </div>
                    </div>
                    <?php
            }
            else{
                echo $mysqli->error;
            }

        }
    }
?>