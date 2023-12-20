<link rel="stylesheet" href="css/successStyle.css">
<?php
include '../config.php';

if(!empty($_POST["username"])){
    setcookie("username",$_POST["username"],time()+300000);
}
else{
    setcookie("username","");
}
$user = $_POST['username'];
$pass = $_POST['password'];

$sql = "select username,password from admin where username='$user' and password='$pass';";
$result = mysqli_query($conn,$sql);
$value = $result->fetch_array();

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if($value['username'] == $user && $value['password'] == $pass){
        header("Location: adminDashboard.php");
    }
    else{
        ?>
        <div id='card' class="animated fadeIn">
            <div id='upper-side1'>
                <img src="assets/wrong.png" alt="tick" height="125px" width="125px">
                <h3 id='status'>Access Denied!</h3>
            </div>
            <div id='lower-side'>
                <p id='message'>Invalid Username or Password.</p>
                <p>Please try again.</p>
                <a href="adminLogin.php" id="contBtn-w">TRY AGAIN!!</a>
            </div>
        </div>
        <?php
    }
}

?>
