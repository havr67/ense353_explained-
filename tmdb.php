<?php
//
/*
this page is used to display information about the movie you clicked on 
*/
//
include 'session.php'; //starts a session 
include 'sql.php';// grabes sql connection to database 
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];
$movieId = $_GET["movieId"];// from link we get movieID

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
  <script src="jquery-3.6.0.js"> </script>

</head>
<body class="loginpage">
    <header>
        <div id="logo" onclick="slowScroll('#top')">
          <span>Messgae with </span>
        </div>
    </header>
    <form>
    <input type="text" size="30" onkeyup="showResult(this.value)">
    <div id="livesearch"></div>
    </form>

    <div>Your Username: <a href="https://khavronin.ursse.org/mypage.php"><?php echo $_SESSION["username"]; ?></a></div>
    <div><a href="https://khavronin.ursse.org/index.php">Go to movies</a></div>
    <div>______________________________________________________</div>
    <form action="tmdb.php" method="POST">
        <table id="movieinfo">

        </table>
    </form>
    <?php
      //
      /*
      this is used to check if user subscribed or not when he just got to the page
      this function had change from what i had previosly
      on endge and safary page js loaded faster that php so it showed subscribed at all the time when you just got to the page 
      so to fix it i decided to check it and print it rather to send information to script so it changes the display of needed button 
      */
      //
        $ifsubtomoviet = 0; //was used for js to cnhage inline of butons 
        $ifsubtomovie = "SELECT user_id, movie_id FROM `submoviedb` WHERE user_id = '$user_id' AND movie_id = '$movieId';"; // checkes if movie is subscribed 
        $ifsubtomovie_res = mysqli_query($sql, $ifsubtomovie);
        if (mysqli_num_rows($ifsubtomovie_res) == 0) { // set a string
            $ifsubtomoviet = 0;
	    $res_btn = "<button id='subtofilm' return='false' style='display:inline'>Subscribe</button><button id='unsubtofilm' return='false' style='display:none'>Unsubscribe</button>";
        } else {
            $ifsubtomoviet = 1;
	    $res_btn = "<button id='subtofilm' return='false' style='display:none'>Subscribe</button><button id='unsubtofilm' return='false' style='display:inline'>Unsubscribe</button>";
        }
	echo $res_btn; //prints a result 
	?>


    <div id="user_id_d" style="display:none"><?=$user_id?></div>
    <div id="movie_id_d" style="display:none"><?=$movieId?></div>
    <div id="ifsubtomovietd" style="display:none"><?=$ifsubtomoviet?></div>

    <script>
      //ajax to display the movie
    $(document).ready(function(){
      $.ajax({
          url: "https://khavronin.ursse.org/tmdbgetmovie.php",
          type:'POST',
          cache: false,
          data:{
            movieId: <?=$movieId?>
          },
          dataType: "html",
          success: function(data) {
            $('#movieinfo').html(data);
          }
        });

        // unsued function 
        // not working in edge and safary browsers 
    setTimeout( window.onload = function setsuborunsub(){
        if(<?=$ifsubtomoviet?> == 0){
            document.getElementById('subtofilm').style.display = 'inline';
            document.getElementById('unsubtofilm').style.display = 'none';
        } else {
            document.getElementById('subtofilm').style.display = 'none';
            document.getElementById('unsubtofilm').style.display = 'inline';
        }
    }, 5000);

    });
    </script>

    <script>
      //send post methid to tmdbsub.php to subscribe to a movie 
    $(document).ready(function(){
     $("#subtofilm").on("click", function(event) { event.preventDefault();
      $.ajax({
        url:"https://khavronin.ursse.org/tmdbsub.php",
        method:"POST",
        data:{
            movie_id: <?=$movieId?>,
            user_id: <?=$user_id?>
        }, 
        dataType:"text", 
        success: function(event) {
            document.getElementById('subtofilm').style.display = 'none';
            document.getElementById('unsubtofilm').style.display = 'inline';
        }
      });
    });
      //send post methid to tmdbunsub.php to unsubscribe from a movie 
    $("#unsubtofilm").on("click", function(event) { event.preventDefault();
      $.ajax({
        url:"https://khavronin.ursse.org/tmdbunsub.php",
        method:"POST",
        data:{
            movie_id: <?=$movieId?>,
            user_id: <?=$user_id?>
        }, 
        dataType:"text", 
        success: function(event) {
            document.getElementById('subtofilm').style.display = 'inline';
            document.getElementById('unsubtofilm').style.display = 'none';
        }
      });
    });
    });
    </script>
    
    <script src="js/searchbar.js"> </script>
</body>




