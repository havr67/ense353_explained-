<?php
include 'session.php';
include 'sql.php';

$user_id = $_POST["user_id"];
$post_content = $_POST["post_content"];
$username = $_POST["username"];

echo $post_content;

$out = "";

$user_post = "INSERT INTO posts (user_id, username, post_content) VALUES ('$user_id', '$username', '$post_content');";

$user_post_res = mysqli_query($sql, $user_post);

if($user_post_res -> query($sql)){
    $out.="";
} else {
    $out.="Erooor";
}
?>

