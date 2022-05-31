<?php

error_reporting(0);

// NOTE, check about adding require_once(deploy.php) soo it creates the schema on load.
// including the connection to mysql database file.
include('config.php');
require_once('security_functions.php');
// starting session to pass through server the user data.
session_start();


// if $_POST global variable in session have received submit button clicked,
// save the values of those keys into variables.
if(isset($_POST['submit'])){
	
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		$message = "<h6>"."Incorrect email!"."<h6>";
	
	else if (!preg_match("/^[a-zA-Z\s]+$/", $_POST['fullname']))
		$message = "<h6>"."Fullname can contain only letters and spaces"."<h6>";
	
	else if (strlen($_POST['username']) > 30)
		$message = "<h6>"."Fullname is too long"."<h6>";
	
	else if (!preg_match("/^[a-zA-Z]*$/", $_POST['username']))
		$message = "<h6>"."Username can contain only letters"."<h6>";
	
	else if (strlen($_POST['username']) > 30)
		$message = "<h6>"."Username is too long"."<h6>";
	
	else if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['password']))
		$message = "<h6>"."Password should contain only letters and numbers"."<h6>";
	
	else if (!validate_password($_POST['password']))
		$message = "<h6>"."Password should contain at least 1 lowercase letter, 1 uppercase letter 1 number and length of 8"."<h6>";
	
	else {
		$email = validate_data ($_POST['email']);
		$password = validate_data ( $_POST['password'] );
		$fullname = validate_data ( $_POST['fullname'] );
		$username = validate_data ( $_POST['username'] );

		// created an sql query to fetch from the db the info of one user. 
		$sql = "SELECT * FROM `user` WHERE `username` = '$username'";

		// we use the query line to fetch the data from $connection that is already
		// connected to the db, and save the results into $results variable.
		$result = mysqli_query($connection, $sql);

		// if on sign up we found that there are data saved for this user.
		// it means we cant re-create it and we inform that user exists.
		if(mysqli_num_rows($result) > 0){

			$message = "<h6>"."username already exist"."<h6>";

		} else {

			// check if one info is not givin by user, return error message
			if(empty($email) || empty($password) || empty($fullname) || empty($username)){

				$message = "<h6>"."please fill all the fields"."<h6>";
			
			} else {

				$code= rand(10000, 99999);
				$password = hash('whirlpool', $password);

				mysqli_query($connection, "INSERT INTO `user_verify` (`fullname`, `username`, `email`, `password`, `code`)
				VALUES ('$fullname', '$username', '$email', '$password', '$code')");

				$db_id = mysqli_insert_id($connection);
				$emailmessage = "Your Activation Code is ".$code."";
				$to=$email;
				$subject="Activation Code For Camagru.com";
				$from = 'info@camagru.hive';
				$body= "Your activation code is: ".$code.". Please enter your code in the verification page";
				$headers = "From:".$from;
				$mail_result = mail($to,$subject,$body,$headers);

				$_SESSION['verify'] = 1;
				header('location:verify-code.php');

			}
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<?php include_once("../frontend/head.html")?>	
	<link rel="stylesheet" href="../style/signup.css">
	<title>Camagru Signup</title>
</head>
<body>
	<img id="main-logo" src="../media/logos/Camagru-logos_textAndCat2_black.png" alt="">
	<!-- container for user entry box -->
	<div class="credentials-container">
		
		<!-- sign up container box -->
		<div class="instagram-container">
			
			<!--website logo  -->
			<div class="instagram-logo">
				<img src="../media/logos/Camagru-logos_sideBySide_black.png" alt="brand logo">
			</div>
			
			<!-- text status -->
			<div class="instagram-status">
				<p>Sign up to see photos and videos</p>
				<p>from your friends. </p>
			</div>

			<!-- form that will send the created user to config.php -->
			<form action="" method="post">

				<!-- container for the user entry elements -->
				<div class="instagram-container-inside">

					<!-- the message which will appear when submit is clicked -->
					<?php echo $message;?>

					<!-- Sign up options -->
					<div class="input-block">
						<span id="espan">Email</span>
						<input type="email" name="email" 
						onfocus="focusSpan('espan')" onfocusout="focusOut('espan')" required>
					</div>
					<div class="input-block">
						<span id="fspan">Full name</span>
						<input type="text" name="fullname" 
						onfocus="focusSpan('fspan')" onfocusout="focusOut('fspan')" required>
					</div>
					<div class="input-block">
						<span id="uspan">Username</span>
						<input type="text" name="username" 
						onfocus="focusSpan('uspan')" onfocusout="focusOut('uspan')" required>
					</div>
					<div class="input-block">
						<span id="pspan">Password</span>
						<input type="password" name="password" 
						onfocus="focusSpan('pspan')" onfocusout="focusOut('pspan')" required>
					</div>
					<!-- Sign up button tag -->
					<button type="submit" name="submit">Sign up</button>

					<!-- Terms and policy text -->
					<p>By signing up, you agree to our</p>
					<p>Terms, Data policy and Cookies</p>
					<p>Policy.</p>

				</div>

			</form>

		</div>
		
		<!-- Bottom container has the log in option -->
		<div class="instagram-bottom-container">
			
			<!-- Log in option -->
			<h4>Have an account? <a href="signin.php" style="text-decoration: none; 
			">Log In</a></h4>

		</div>
	</div>
</body>
<script>
	function focusSpan(thisId){
		let spanFocused = document.getElementById(thisId);
		spanFocused.className = "span-focus";
	}
	function focusOut(thisId){
		let spanFocused = document.getElementById(thisId);
		spanFocused.className = "";
	}
</script>
</html>