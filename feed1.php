<?php
include 'sql.php';

$posts_content = "SELECT * FROM posts ORDER BY `posts`.`post_id` DESC;";

$posts_content_res = mysqli_query($sql, $posts_content);

var_dump($posts_content_res);

if (mysqli_num_rows($posts_content_res) > 0) {
  while ($row = mysqli_fetch_row($posts_content_res)){
  $out = "<tr><td>".$row[3]."</td><td>|</td><td>".$row[4]."</td><td>|Created by -</td><td>".$row[2]."</td><td><div id='hidDiv'>".$row[0]."</div></td></tr>";
  echo $out;
  }
} else {
  echo "There are no massages";
}

?>