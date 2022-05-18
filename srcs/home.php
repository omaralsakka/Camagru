<!-- This is the home page file for the user -->

<?php

error_reporting(0);

// including the connection to mysql database file.
require_once('config.php');

// starting session to pass through server the user data.
session_start();

//if the session does not have a user_id value, return to signin.php file
if(!isset($_SESSION['user_id'])){

    header('location:signin.php');

} else {

    // save the user_id into a variable
    $userId = $_SESSION['user_id'];
}

?>

<!DOCTYPE html>
<html>
<head>

	<title>Home</title>
	
	<?php include_once("../frontend/head.html")?>	

</head>
<body>
	<!-- <div class="navbar"> -->
		<?php include_once("../frontend/navbar.html");?>
	<!-- </div> -->

    <div class="home-container">
		<!-- nav bar -->
    </div>

</body>
</html>