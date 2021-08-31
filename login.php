<?php
//
/*
logins to a webaplication 
*/
//  
ini_set('display_errors', 1);
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$username = trim($_POST["username"]);
$password = trim($_POST["password"]);
if (strlen($password) > 0 && strlen($username) > 0){


include 'sql.php';// grabes sql connection to database 
$q = "SELECT user_id, username, user_password, confirmed FROM users WHERE username = '$username' AND user_password = '$password';"; //checks if user exists


$result = $sql->query($q);

if($row = $result->fetch_assoc()) {
if ($row["confirmed"] == 0){ // if user is not confirmed redirects it to verufication page
header("Location: https://khavronin.ursse.org/verification.php?vkey=&username=");
} elseif ($row["confirmed"] == 1) {
session_start(); //starts session 
$_SESSION["user_id"] = $row["user_id"];
$_SESSION["username"] = $row["username"];
$_SESSION["password"] = $row["password"];
header("Location: https://khavronin.ursse.org/mypage.php"); //reditects to userpage 
$sql->close();
exit();
} else {
$error = ("wrong input");
$sql->close();
}}
if ($result !== false) {
    //printResult($result);
} else { // обработка ошибки
    echo "error: " . $sql->error;
}
}
}

?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="mystyle.css">
</head>
<body class="loginpage">
    <header>
        <div id="logo" onclick="slowScroll('#top')">
          <span>Log In Page</span>
        </div>
    </header>
<form id="loginform" action="login.php" method="POST">
    <div class="top">
    <div><h2>Login Page</h2></div>
    </div>
    <table class="logininformation">
        <tr>
            <td>Username</td>
            <td><input type="text" id="username" name="username" /></td>
            <td id="usernameHelp" class="usernameHelp">*</td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" id="password" name="password" /></td>
            <td id="passwordHelp" class="passwordHelp">*confirm your password</td>
        </tr>
        <tr>
            <td><p>Remember me</p></td>
            <td><input type="button" id="1" value="OFF" style="color: black" onclick="toggle(this);" /></td>
        </tr>
    </table>
    <div class="row">
        <button id="loginsubmit" type="submit" href="https://khavronin.ursse.org/index.php?" name="submittedlogin"
         class="btn">Log In</button>
      </div>
    <div class="row">
            <span>Don't have an account yet?<a href="https://khavronin.ursse.org/signup.php">Sign Up</a></span>
    </div>
</form>
</body>
