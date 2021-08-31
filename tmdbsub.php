<?php
include 'sql.php';// grabes sql connection to database 
//
/*
using ajax we send information using method POST to subscribe to movies 
*/
//

$user_ = $_POST["user_id"];
$movie_ = $_POST["movie_id"];
$subtomov = "INSERT INTO submoviedb(user_id, movie_id) VALUES ('$user_', '$movie_');"; //subsribing 


$subtomov_res = mysqli_query($sql, $subtomov);

if($subtomov_res -> query($sql)){ //error handaling 
    $out.="";
} else {
    $out.="Erooor";
}
?>



