<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/officerLogin.css">
    <title>Officer Login</title>
</head>
<body>
    <div class="log_header">
        <span class="cms">COMPLAINT MANAGEMENT SYSTEM</span>
        <div class="h_dummy"></div>
        <div class="h_dummy1"></div>
    </div>
    
    <div class="log_container">
        <div class="img_container">
            <img src="assets/officer.png" alt="" width="100px" height="100px">
        </div>
        <div class="log_form">
            <form action="loginAction.php" method="post" autofill="off">
            <div class="log_form_row1">
                <h2 class="heading">OFFICER LOGIN</h2>
            </div>
            <div class="log_form_row2">
                <input type="text" name="username" id="username" placeholder="EMAIL">
            </div>
            <div class="log_form_row3">
                <input type="password" name="password" id="password" placeholder="PASSWORD">
            </div>
            <div class="log_form_row4">
            <input type="checkbox" name="rememberme" id="rem" value="remember" style="width: 30px;margin-left:-10px;" checked hidden><!--remember me-->
                <a href="#">forgot password?</a>
            </div>
            <div class="log_form_row5">
                <input type="submit" value="login" name="login">
            </div>
            </form>
        </div>
    </div>
    <div class="log_footer">
        <div class="f_dummy"></div>
        <div class="f_dummy1"></div>
    </div>
</body>
</html>