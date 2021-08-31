<?php

$q=$_GET["q"];
include 'sql.php';
$x = 0;

if (strlen($q)>0) {
  $friend_search="";
  $search_result = "SELECT user_id, username FROM users WHERE username REGEXP '$q' ORDER BY user_id DESC;";
  $result = $sql->query($search_result);
  if($row = $result->fetch_assoc()){
    $id_result = $row["user_id"];
    $usernanme_result = $row["username"];
    if($friend_search == ""){
        $friend_search = "<a href='messages.php?id=".$id_result."'>".$usernanme_result."</a>";
    } else {
        $friend_search = $friend_search."<a href='messages.php?id=".$id_result.">".$usernanme_result."</a>";
    }
}
}

if ($friend_search=="") {
  $response="no suggestion";
} else {
  $response=$friend_search;
}

//output the response
echo $response;
?>