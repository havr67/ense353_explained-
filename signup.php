<?php
//
/*
signups to a webaplication 
*/
//  
if ($_SERVER["REQUEST_METHOD"] == "POST") { //uses Method post to get inputs from fileds
        $firstname = trim($_POST["firstname"]);
        $username = trim($_POST["username"]);
        $lastname = trim($_POST["lastname"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);


if (strlen($firstname) > 0 && strlen($email) > 0 && strlen($password) > 0 && strlen($username) > 0 && strlen($lastname) > 0) { //checks if fields are empty 
$sql = new mysqli("localhost", "root", "", "");
if($sql->connect_error) {
die("connetion failed: " . $sql->connect_error);
}


$check = "SELECT * FROM users WHERE email = '$email';"; // checks if email alreday exist 
$rs = mysqli_query($sql, $check);

if(mysqli_num_rows($rs)){
echo "user already exists";
header("Location: https://khavronin.ursse.org/signup.php");
} else {
$vkey = rand(100000, 999999); //creates random vkey

$q = "INSERT INTO users (username, firstname, lastname, email, user_password, vkey) VALUES ('$username', '$firstname', '$lastname', '$email', '$password', '$vkey');"; //insers user infroamtion into database


// sends email with conformation 
if($sql->query($q)){

	$to = $email;
	$subject = "Conformation email for movie website";
	$massage = "<html><a href='https://khavronin.ursse.org/verification.php?vkey=$vkey&username=$username'>Register Account</a></html>";
	$headers = "From: khavronin@khavronin.ursse.org";
	$headers = "MIME-Version: 1.0"."\r\n";
	$headers = "Content_type:text/html;charset=UTF-8"."\r\n";
	mail($to,$subject,$massage,$headers);


header("Location: https://khavronin.ursse.org/login.php?");
$sql->close();
exit();
}
}} else {
    $error = ("You must enter non-blank fields.");
}
} else {
	$error = "There was an error submitting your form";

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
          <span>Sign Up Page</span>
        </div>
    </header>
<form id="sugnupform" action="signup.php" method="POST">
    <div class="top">
    <div><p>Sign Up Page</p></div>
    </div>
    <table class="sugnupinformation">
        <tr>
            <td><lable for="email">Email <span>*</span></lable><br></td>
            <td><input id="username" type="text" name="email" /></td>
            <td id="usernameHelp"class="help">*email address</td>
        </tr>
	<tr>
          <td><lable for="username">Username <span>*</span></lable><br></td>
          <td><input id="name_for_user" type="text" name="username" /></td>
          <td id="nameHelp" class="nameHelp">*Your Username</td>
        </tr>
        <tr>
          <td><lable for="firstname">Firstname <span>*</span></lable><br></td>
          <td><input id="name_for_user" type="text" name="firstname" /></td>
          <td id="nameHelp" class="nameHelp">*Your Name</td>
        </tr>
	<tr>
          <td><lable for="lastname">Lastame <span>*</span></lable><br></td>
          <td><input id="name_for_user" type="text" name="lastname" /></td>
          <td id="nameHelp" class="nameHelp">*Your Lastame</td>
        </tr>
        <tr>
            <td><lable for="password">Password <span>*</span></lable><br></td>
            <td><input id="password" type="password" name="password" /></td>
            <td id="passwordHelp" class="passwordHelp">*your password</td>
        </tr>
    </table>
    <div class="row">
      <button id="signipsubmit" type="submit" class="btn" name="submitted">Sign Up</button>
    </div>
    <div class="row">
            <span>Have an account yet?<a href="https://khavronin.ursse.org/login.php">Log In</a></span>
    </div>
</form>
<script src="js/sugnup.js"></script>
<script type="javascript" src="js/signup_load.js"></script>
</body>
