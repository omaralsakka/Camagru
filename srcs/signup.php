<?php

// error_reporting(-1);
// ini_set('display_errors', 'On');
// set_error_handler("var_dump");


error_reporting(0);

// NOTE, check about adding require_once(deploy.php) soo it creates the schema on load.
// including the connection to mysql database file.
include('config.php');

// starting session to pass through server the user data.
session_start();

// if $_POST global variable in session have received submit button clicked,
// save the values of those keys into variables.
if(isset($_POST['submit'])){
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	$fullname = $_POST['fullname'];
	$username = $_POST['username'];

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

			$code=substr(md5(mt_rand()),0,15);
			// mysqli_select_db($connection, 'camagru_website');
			$verify_query = mysqli_query($connection, "INSERT INTO `user_verify` (`fullname`, `username`, `email`, `password`, `code`)
			VALUES ('$fullname', '$username', '$email', '$password', '$code')");


			$db_id = mysqli_insert_id($connection);
			$emailmessage = "Your Activation Code is ".$code."";
			$to=$email;
			$subject="Activation Code For Camagru.com";
			$from = 'info@camagru.dev';
			$body='Your Activation Code is '.$code.' Please Click On This link <a href="verification.php">Verify.php?id='.$db_id.'&code='.$code.'</a>to activate your account.';
			$headers = "From:".$from;
			$mail_result = mail($to,$subject,$body,$headers);
			echo $mail_result."<br>";
			echo $email."<br>";
			echo $body."<br>";
			echo "An Activation Code Is Sent To You Check You Emails";

			// we create a query message that will take the given variables and
			// insert them into the db into each corresponding column.
			$query = "INSERT INTO `user_verify` (`fullname`, `username`, `email`, `password`) 
			VALUES ('$fullname','$username','$email','$password')";

			
			$query_result = mysqli_query($connection, $query);

		}
	}
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id=$_GET['id'];
	$code=$_GET['code'];

	$query = "SELECT `fullname`, `username`, `email`, `password` FROM `user_verify`
	WHERE `id` = '$id' AND `code` = '$code'";
	$select = mysqli_query($connection, $query);
	if(mysqli_num_rows($select)==1)
	{
		while($row=mysqli_fetch_array($select))
		{
			$user_id=$row['user_id'];
			$email=$row['email'];
			$username=$row['username'];
			$fullname=$row['fullname'];
			$password=$row['password'];
		}
		$insert_q = "INSERT INTO `user` (`fullname`, `username`, `email`, `password`) 
		VALUES ('$fullname','$username','$email','$password')";

		$insert_user=mysqli_query($connection, $insert_q);
		$_SESSION['user_id'] = $user_id;
		$_SESSION['username'] = $username;

		$delete_q = "DELETE FROM `user_verify` WHERE `id` = '$id' AND `code`='$code'";
		$delete = mysqli_query($connection, $delete_q);
		$message = "<h6>"."user created successfully"."<h6>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<?php include_once("../frontend/head.html")?>	
	<title>Camagru Signup</title>

	<style>
		
		.credentials-container{
			display: flex;
			flex-direction: column;
			margin-top: 10%;
		}

		.instagram-container{
			width: 100%;
			max-width: 350px;
			margin: auto;
			/* border: 1px solid #ccc; */
			margin-top: 15px;
			padding: 5px;
			border-radius: 5px;
			box-shadow: 5.6px 11.2px 11.2px hsl(0deg 0% 0% / 0.33);
			background-color: #F6F6F6;
		}

		.instagram-logo{
			width: 100%;
			max-width: 400px;
			margin: auto;
			margin-top: 10px;
			/* align-content: center; */
		}

		.instagram-logo img{
			width: 100%;
		}

		.instagram-status{
			font-size: 18px;
			text-align: center;
			color: #aaa;
		}

		.instagram-container-inside{
			padding: 25px;
		}

		.instagram-container-inside button{
			width: 100%;
			padding: 8px;
			margin: 8px;
			border: none;
			font-size: 12px;
			color: #111111;
			background-color: #FFCB74;
			/* color: white; */
			/* background-color: #3897f0; */
			border-radius: 5px;
			cursor: pointer;
			box-shadow: 0.8px 1.6px 1.6px hsl(0deg 0% 0% / 0.48);
		}

		.instagram-container-inside h5{
			color: #111111;
			/* color: #C0C0C0; */
			text-align: center;
		}

		
		.instagram-container-inside input[type=email], input[type=text], 
		input[type=password]{
			width: 100%;
			padding: 8px;
			margin: 6px;
			display: inline-block;
			box-sizing: border-box;
			box-shadow: 0.8px 1.6px 1.6px hsl(0deg 0% 0% / 0.48);
			border: 1px solid #e9e9e9;
			/* border: 1px solid yellow; */
			background-color: #F0F0F0;
			font-size: 12px;
			border-radius: 4px;
		}

		.instagram-container-inside p{
			font-size: 16px;
			text-align: center;
			color: #aaa;
		}

		.or{
			display: flex;
			justify-content: center;
			align-items: center;
		}

		/* The error message */
		.instagram-container-inside h6{
			text-align: center;
			color: red;
			font-size: 18px;
		}

		.instagram-bottom-container{
			width: 100%;
			max-width: 350px;
			margin: auto;
			/* border: 1px solid #ccc; */
			margin-top: 15px;
			border-radius: 5px;
			box-shadow: 7.2px 14.4px 14.4px hsl(0deg 0% 0% / 0.28);
			background-color: #F6F6F6;
		}

		.instagram-bottom-container h4{
			margin-top: 20px;
			margin-bottom: 20px;
			text-align: center;
		}

		.instagram-bottom-container a{
			color: #111111;
			background-color: #FFCB74;
			border-radius: 5px;
			padding: 5px;
			margin: 8px;
			border: none;
			cursor: pointer;
			box-shadow: 0.8px 1.6px 1.6px hsl(0deg 0% 0% / 0.48);
		}
	</style>
</head>
<body>

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
					
					<!-- provided by fontawesome.com / to log in with facebook account -->
					<button><i class="fa-brands fa-facebook-square"></i> Log in with 
					facebook</button>
					
					<!-- the word or surrounded by 2 horizontal lines -->
					<div class="or">
						<hr style="width:30%; margin: 10px; opacity: 0.3;">
						<h5 style="opacity: 0.5;">OR</h5>
						<hr style="width:30%; margin: 10px; opacity: 0.3;">
					</div>

					<!-- the message which will appear when submit is clicked -->
					<?php echo $message;?>

					<!-- Sign up options -->
					<input type="email" name="email" placeholder="Mobile Number or Email">
					<input type="text" name="fullname" placeholder="Full Name">
					<input type="text" name="username" placeholder="Username">
					<input type="password" name="password" placeholder="Password">

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
</html>