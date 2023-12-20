<?php
    include '../config.php';

        $a =json_decode(file_get_contents('php://input'), true);
        $string = $a['myJsonString'];
        $str = explode('|',$string);

        /*generating user id*/
        $countsql = "select count(user_id) as count from userdata;";
        $result = mysqli_query($conn,$countsql);
        $val = $result->fetch_array();
        $id = 1+$val['count'];
        $userID = "U".$id;
        date_default_timezone_set('Asia/Calcutta');
        $d = date("Y-m-d");
        if($userID !=NULL && $str[0] != NULL && $str[1] != NULL && $str[2] != NULL && $str[3] != NULL && $str[4] != NULL && $str[5] != NULL && $str[6] != NULL && $str[7] !=NULL){
            $sql = "insert into userdata values ('$userID','$str[0]','$str[1]','$str[2]','$str[3]','$str[4]','$str[5]','$str[6]','$str[7]','$d','$d','123')";
            //echo $sql;
            $result = $conn->query($sql);
            if($result === true){
                echo 'Success';
            }
            else{
                echo $conn->error;
            }
        }
?>