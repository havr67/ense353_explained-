<?php


//in email you should get a conformation link with your vkey and username in it
if(isset($_GET['vkey']) && isset($_GET['username'])) { //we are using GET to get info from link// link expmle //'https://khavronin.ursse.org/verification.php?vkey=327482?username=lol'
	$vkey = $_GET['vkey'];
	$username = $_GET['username'];
	$sql =  new mysqli("localhost", "root", "Olimp110", "employels"); //database connection 
	     	    	if($sql->connect_error) {
			die("connetion failed: " . $sql->connect_error);
	       }
	$q = "SELECT * FROM users WHERE username='$username' AND confirmed = 0 AND vkey = '$vkey';"; //confirming if user exists 
	$result = mysqli_query($sql, $q);
	if($row = mysqli_fetch_row($result)) {
	$q = "UPDATE users SET confirmed = 1 WHERE username='$username' AND vkey = '$vkey';"; //updating user conformation of email
	$update = $sql->query($q);
	echo "Your account has been varified";
	} else {
	echo "this account haven't been verified or does not existing ";
	echo "Check your email, or ";
	echo '<a href="https://khavronin.ursse.org/signup.php">Sign Up</a>'; // in case of a misatke 
	}
} else {
die("something went wrong");
}

?>


<html>
<head>

</head>
<body>


</body>

</html>