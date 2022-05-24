<!-- This is the 2nd entry file for the application. It lets the user log in
if they have an account. Incase the user don't have an account, there is a bottom
option to sign up and leads to signup.php "sign up page" -->

<?php

error_reporting(0);

// including the connection to mysql database file.
require_once('config.php');

// starting session to pass through server the user data.
session_start();

if(isset($_POST['submit'])){
	
	$username = $_POST['username'];
	$password = $_POST['password'];

	// check if one info is not givin by user, return error message
	if(empty($username) || empty($password)){
		$message = "<h6>"."please fill all the fields"."<h6>";
	
	} else {
		// created an sql query to fetch from the db the info of one user. 
		$sql = "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password'";

		// we use the query line to fetch the data from $connection that is already
		// connected to the db, and save the results into $results variable.
		$result = mysqli_query($connection, $sql);

		// if on sign up we found that there are data saved for this user.
		// it means we cant re-create it and we inform that user exists.
		if(mysqli_num_rows($result) > 0){

			
			//we get the row of the user with the mentioned fullname
			while($row = mysqli_fetch_assoc($result)){
				//we save the specific user id into the session
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['fullname'] = $row['fullname'];
				$_SESSION['username'] = $row['username'];
				
				//we use this session inside home.php file
				header('location:home.php');
				
				$message = "<h6>"."Log in success"."<h6>";
			}
		
		} else {
			
			$message = "<h6>"."Incorrect username or password"."<h6>";
		}
	}

}

?>


<!DOCTYPE html>
<html>
<head>
	
	<?php include_once("../frontend/head.html")?>
	<title>Camagru Signin</title>

	<style>

		/* default settings for all elements */
		*{
			margin:0;
			padding:0;
			box-sizing: border-box;
			font-size: 1em;
			/* color: #000; */
			font-family: 'Space Grotesk', sans-serif;
		}

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
			object-fit: cover;
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
			/* color: #3897f0; */
			text-align: center;
			margin-bottom: 10px;
			margin-top: 10px;
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

			<form action="" method="post">
				
				<!-- container for the user entry elements -->
				<div class="instagram-container-inside">

					<!-- the message which will appear when submit is clicked -->
					<?php echo $message;?>

					<!-- Sign in options -->
					<input type="text" name="username" placeholder="username">
					<input type="password" name="password"  placeholder="Password">

					<!-- Sign in button tag -->
					<button type="submit" name="submit">Log In</button>
					
					<!-- the word or surrounded by 2 horizontal lines -->
					<div class="or">
						<hr style="width:30%; margin: 10px; opacity: 0.3;">
						<h5 style="opacity: 0.5;">OR</h5>
						<hr style="width:30%; margin: 10px; opacity: 0.3;">
					</div>

					
					<!-- provided by fontawesome.com / to log in with facebook account -->
					<h5><i class="fa-brands fa-facebook-square"></i> Log in with 
					facebook</h5>

					<!-- Forgot password tag text -->
					<p>Forgot password?</p>

				</div>

			</form>

		</div>
		
		<!-- Bottom container has the sign up option -->
		<div class="instagram-bottom-container">
			
			<!-- Sign up option -->
			<h4>Don't have an account? <a href="signup.php" style="text-decoration: none; 
			">Sign Up</a></h4>

		</div>
	</div>
</body>
</html>