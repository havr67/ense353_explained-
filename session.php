<?php
//
/*
starts session on pages where its needed and redirects to login page if user is not logged in 
*/
//  
	session_start();

	if(!isset($_SESSION['user_id'])){
  	header("location: login.php");
  	}
	
	function logged_in() {
		return isset($_SESSION['user_id']);
	}
	
	function confirm_logged_in() {
		if (!logged_in()) {?>
			<script type="text/javascript">
				window.location = "login.php";
			</script>

		<?php
		}
	}