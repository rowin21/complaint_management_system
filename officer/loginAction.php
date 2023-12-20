<link rel="stylesheet" href="successStyle.css">
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

$sql = "select email,password,first_name,last_name from officer where email='$user' and password='$pass';";
$result = mysqli_query($conn,$sql);
$value = $result->fetch_array();

$name=$value['first_name']." ".$value['last_name'];
echo $name;
if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if($value['email'] == $user && $value['password'] == $pass){
        header("Location: officerDashboard.php");
    }
    else{
        ?>
        <div id='card' class="animated fadeIn">
            <div id='upper-side1'>
                <img src="images/wrong.png" alt="tick" id="w" >
                <h3 id='status'>Access Denied!</h3>
            </div>
            <div id='lower-side'>
                <p id='message'>Invalid Username or Password.</p>
                <p>Please try again.</p>
                <a href="userLogin.php" id="contBtn-w">TRY AGAIN!!</a>
            </div>
        </div>
        <?php
    }
}

?>
