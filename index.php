<?php
//
/*
logins to a webaplication 
*/
//  
ini_set('display_errors', 1);

include 'session.php';
include 'sql.php';
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];

//from empoyers from first lab, which was also marked unfarly 
//$q = "SELECT * FROM users ORDER BY user_id;";
//$result = $sql->query($q);

//if ($result !== false) {
    //printResult($result);
//} else { //                 
//    echo "error: " . $sql->error;
//}
?>

<html>
  <head>
    <style>
      h3 {
          font-size: 4em;
          font-family: arial;
          font: bold;
      }
      .login {
      float: right;
      float: top;
      text-align: center;
        border-style: ridge;
        border-width: 2px;
        border-color: #8ebf42;
        background-color: #d9d9d9;
      }
    </style>
    <script src="js/jquery-3.6.0.js"> </script>
  </head>
  <header>
    <h3>Video Service</h3>
         <div id="login" class="login">
          <button id="myBTN"><?php
		if(!isset($_SESSION["user_id"])){
			echo "login";
		} else {
		  echo $username;
		}
	  ?></button>
	  <script>
	  var btn = document.getElementById('myBTN');
	  btn.addEventListener('click', function(){
	  document.location.href = '<?php echo "https://khavronin.ursse.org/login.php";?>';
	  });
	  </script>
        </div>
  </header>
  <div>Your Username: <a href="https://khavronin.ursse.org/mypage.php"><?php echo $_SESSION["username"]; ?></a></div>

  <form action="index.php" method="POST">
  <table id="">
  	 <div id="moviespictures"></div>  
  </table>
  </form>
  <div>
  first you need to press on login, than sign up, after you sign up, press login, eneter your username and password, and you will see you username where was a login
  </div>

  <script>
    //disspalys movies
	$(document).ready(function(){
      $.ajax({
          url: "tmdbdisplaymovies.php",
          type:'POST',
          cache: false,
          data:{
            user_id: <?=$user_id?>
          },
          dataType: "html",
          success: function(data) {
            $('#moviespictures').html(data);
          }
        });
    	});
  </script>

</html>

