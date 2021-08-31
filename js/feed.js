
$(document).ready(function(){

    setInterval(updatenewposts,1000);

  function updatenewposts() {
      $.ajax({
          url: "feed1.php",
          type:'POST',
          cache: false,
          dataType: "html",
          success: function(data) {
            $('#posts').html(data);
          }
        });
  }
});

