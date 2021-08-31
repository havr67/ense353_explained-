<?php
include 'sql.php';
include 'session.php';
$resiver_id=$_GET["id"];
$sender_id=$_SESSION["user_id"];
$sender = $_SESSION["username"];
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
    <div>Your Username: <a href="https://khavronin.ursse.org/mypage.php"><?php echo $_SESSION["username"]; ?></a></div>
    <div><a href="https://khavronin.ursse.org/feed.php">Go to feed</a></div>
    <div><a href="https://khavronin.ursse.org/index.php">Go to movies</a></div>
    </form>
    <?php
	$un = "SELECT * FROM users WHERE user_id = 'resiver_id';";
	$un_res = $sql->query($un);
	if($row = mysqli_fetch_assoc($un_res)){
	$outun = $row[username];
	echo $outun;
	}
    ?>
    <div>______________________________________________________</div>
    <form action="messages.php" method="POST">
      <table id="messagecontent">
      	     <tr><td>  <div id="messages">NO messages</div></td></tr>
      </table>

       <div>______________________________________________________</div>
      <div id='resiver_id'><textarea name="sendmessage" class="resiver_id from-control" style="height: 70px;"></textarea></div>
    </form>
    <button id="send_massage" return="false">Send</button>
    <script type="text/javascript">
        $(document).ready(function(){
        $("#send_massage").on("click", function(event) {
          $.ajax({
            url:"message2.php",
            method:"POST",
            data:{
	      resiver_id:  <?=$resiver_id; ?>,
              sender_id:   <?=$sender_id; ?>,
              message_content: $(".resiver_id").val(),
              sender: "<?=$sender; ?>"
            }, 
            dataType:"text",
	    success: function (event) {
	    $(".resiver_id").val("");
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
      <script src="js/messages1.js"> </script>
</body>