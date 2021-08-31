<?php

include 'sql.php';// grabes sql connection to database 
//
/*
using ajax we send information using method POST to unsubscribe from movies 
*/
//
$user_id = $_POST["user_id"];
$movie_id = $_POST["movie_id"];


$unsubtomov = "DELETE FROM submoviedb WHERE user_id = '$user_id' AND movie_id = '$movie_id';"; // unsubscribing 
$unsubtomov_res = mysqli_query($sql, $unsubtomov);

if($unsubtomov_res -> query($sql)){//error handaling 
    $out.="";
} else {
    $out.="Erooor";
}
?>

