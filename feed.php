<?php

include 'session.php';
include 'sql.php';
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];
?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="mystyle.css">
  <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script src="js/jquery-3.6.0.js"> </script>
  <style>
	table { 
  border-spacing: 10px; 
  	}
	#hidDiv {
	    display: none;
	}
  </style>
</head>
<body class="loginpage">
    <header>
        <div id="logo" onclick="slowScroll('#top')">
          <span>Messgae with </span>
        </div>
    </header>
    <div id="sender_ajax" style="display:none"><?=$sender_id?></div>
    <div id="resiver_ajax" style="display:none"><?=$resiver_id?></div>
    <form>
    <input type="text" size="30" onkeyup="showResult(this.value)">
    <div id="livesearch"></div>
    </form>

    <div>Your Username: <a href="https://khavronin.ursse.org/mypage.php"><?php echo $_SESSION["username"]; ?></a></div>
    <div><a href="https://khavronin.ursse.org/index.php">Go to movies</a></div>
    <div>______________________________________________________</div>
    <div id='post_content'><textarea name="sendpost" class="post_content from-control" style="height: 70px;"></textarea></div>
    <button id="send_post" return="false">Send</button>
    <div>______________________________________________________</div>
    <form action="feed.php" method="POST">
      <table id="postscontent">
      <div id="posts">NO post</div>
      </table>
    </form>

    <script type="text/javascript">
        $(document).ready(function(){
        $("#send_post").on("click", function(event) {
          $.ajax({
            url:"feed2.php",
            method:"POST",
            data:{
              user_id:  <?=$user_id; ?>,
              post_content: $(".post_content").val(),
              username: "<?=$username; ?>"
            },
            dataType:"text",
            success: function (event) {
            $(".post_content").val("");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
          });
        });
        });
    </script>


    <script src="js/searchbar.js"> </script>
    <script src="js/feed.js"> </script>
</body>


