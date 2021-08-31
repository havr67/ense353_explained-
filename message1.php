<?php
include 'sql.php';

$resiver_id = $_POST["resiver_id"];
$sender_id = $_POST["sender_id"];

$messege_content = "SELECT * FROM messages WHERE resiver_id=".$resiver_id." AND sender_id=".$sender_id." OR resiver_id=".$sender_id." AND sender_id=".$resiver_id." ORDER BY`messages`.`message_id` DESC LIMIT 20;";

$messege_content_res = mysqli_query($sql, $messege_content);
//var_dump($messege_content_res);

if (mysqli_num_rows($messege_content_res) > 0) {
  while ($row = mysqli_fetch_row($messege_content_res)){
  $out = "<tr><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[3]."</td></tr>";
  echo $out;
  }
} else {
  echo "There are no massages";
}



?>

