

$(document).ready(function(){

    setInterval(updatenewmessages,1000);

    
    function updatenewmessages() {
 let sender_ajax = $('#sender_ajax').text();
let resiver_ajax = $('#resiver_ajax').text();
      $.ajax({
          url: "message1.php",
          type:'POST',
          cache: false,
          data:{
            resiver_id:  resiver_ajax,
            sender_id:  sender_ajax
          },
          dataType: "html",
          success: function(data) {
            $('#messages').html(data);
          }
        });
  }



});






