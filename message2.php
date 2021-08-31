<?php
include 'session.php';
include 'sql.php';

$resiver_id = $_POST["resiver_id"];
$sender_id = $_POST["sender_id"];
$message_content = $_POST["message_content"];
$sender = $_POST["sender"];

$out = "";

$sender_massage = "INSERT INTO messages (resiver_id, sender_id, sender, message_content) VALUES ('$resiver_id', '$sender_id', '$sender', '$message_content');";

$sender_massage_res = mysqli_query($sql, $sender_massage);

if($sender_massage_res -> query($sql)){
    $out.="";
} else {
    $out.="Erooor";
}
?>