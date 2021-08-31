

//
$(document).ready(function(){
    let movie_id_d = $('#movie_id_d').text();
    $.ajax({
        url: "https://khavronin.ursse.org/tmdbgetmovie.php",
        type:'POST',
        cache: false,
        data:{
          movieId: movie_id_d
        },
        dataType: "html",
        success: function(data) {
          $('#movieinfo').html(data);
        }
      });

   $("#subtofilm").on("click", function(event) { event.preventDefault();
    let movie_id_d = $('#movie_id_d').text();
    let user_id_d = $('#user_id_d').text();
    $.ajax({
      url:"tmdbsub.php",
      method:"POST",
      data:{
          movie_id: movie_id_d,
          user_id: user_id_d
      }, 
      dataType:"text", 
      success: function(event) {
          document.getElementById('subtofilm').style.display = 'none';
          document.getElementById('unsubtofilm').style.display = 'inline';
      }
    });
  });

  $("#unsubtofilm").on("click", function(event) { event.preventDefault();
    let movie_id_d = $('#movie_id_d').text();
    let user_id_d = $('#user_id_d').text();
    $.ajax({
      url:"tmdbunsub.php",
      method:"POST",
      data:{
          movie_id: movie_id_d,
          user_id: user_id_d
      }, 
      dataType:"text", 
      success: function(event) {
          document.getElementById('subtofilm').style.display = 'inline';
          document.getElementById('unsubtofilm').style.display = 'none';
      }
    });
  });

  function setsuborunsub(){
    let ifsubtomovietd = $('#ifsubtomovietd').text();
      if(ifsubtomovietd == 0){
          document.getElementById('subtofilm').style.display = 'inline';
          document.getElementById('unsubtofilm').style.display = 'none';
      } else {
          document.getElementById('subtofilm').style.display = 'none';
          document.getElementById('unsubtofilm').style.display = 'inline';
      }
  }

});





