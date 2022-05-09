<!-- This is the entry file for the application. It starts by sending the
user to the sign up page. Incase the user has an account, there is a bottom
option to log in and leads to signin.php file -->

<?php

error_reporting(0);

// NOTE, check about adding require_once(deploy.php) soo it creates the schema on load.
// including the connection to mysql database file.
require_once('config.php');

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
	$sql = "SELECT * FROM `user` WHERE `fullname` = '$fullname'";

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
			
			// we create a query message that will take the given variables and
			// insert them into the db into each corresponding column.
			$query = "INSERT INTO `user` (`fullname`, `username`, `email`, `password`) 
			VALUES ('$fullname','$username','$email','$password')";

			
			$query_result = mysqli_query($connection, $query);
			// if the query result valid print success message, else print error
			if($query_result){

				// created an sql query to fetch from the db the info of one user. 
				$sql = "SELECT * FROM `user` WHERE `fullname` = '$fullname'";

				// we use the query line to fetch the data from $connection that is already
				// connected to the db, and save the results into $results variable.
				$result = mysqli_query($connection, $sql);

				//we get the row of the user with the mentioned fullname
				while($row = mysqli_fetch_assoc($result)){

					//we save the specific user id into the session
					$_SESSION['user_id'] = $row['user_id'];

					//we use this session inside home.php file
					header('location:home.php');

					$message = "<h6>"."user data insert successfully"."<h6>";

				}
				
				$message = "<h6>"."user created successfully"."<h6>";
			
			} else {
			
				$message = "<h6>"."error.."."<h6>";
			
			}
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- font awesome cdn to include their styling kit -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
	<!-- google fonts cdn -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600&display=swap" rel="stylesheet"> 
	
	<title>Camagru Signup</title>

	<style>
		
		html{
			background-image: url("../media/031 Blessing.png");
			/* background-image: url("../media/122 Cheerful Caramel.png"); */
			/* background-image: url("../media/076 Premium Dark.png"); */
		}
		
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