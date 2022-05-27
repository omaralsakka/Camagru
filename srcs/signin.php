<!-- This is the 2nd entry file for the application. It lets the user log in
if they have an account. Incase the user don't have an account, there is a bottom
option to sign up and leads to signup.php "sign up page" -->

<?php

error_reporting(0);

// including the connection to mysql database file.
require_once('config.php');
require_once('security_functions.php');
// starting session to pass through server the user data.
session_start();

if(isset($_POST['submit'])){
	
	if (!preg_match("/^[a-zA-Z]*$/", $_POST['username']))
		$message = "<h6>"."Incorrect username"."<h6>";
	
	else if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['password']) || 
		!validate_password($_POST['password']))
		$message = "<h6>"."Incorrect password"."<h6>";
	else {
		$username = validate_data ( $_POST['username'] );
		$password = validate_data ( $_POST['password'] );

		// check if one info is not givin by user, return error message
		if(empty($username) || empty($password)){
			$message = "<h6>"."please fill all the fields"."<h6>";
		
		} else {
			$password  = hash('whirlpool', $password);
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
					$_SESSION['email'] = $row['email'];
					$_SESSION['notifications'] = $row['notifications'];
					//we use this session inside home.php file
					header('location:home.php');
					
					$message = "<h6>"."Log in success"."<h6>";
				}
			
			} else {
				
				$message = "<h6>"."Incorrect username or password"."<h6>";
			}
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
		$_SESSION['email'] = $email;

		$delete_q = "DELETE FROM `user_verify` WHERE `id` = '$id' AND `code`='$code'";
		$delete = mysqli_query($connection, $delete_q);
		$message = "<h6>"."user created successfully"."<h6>";
		$_SESSION['verify'] = 0;
	}
}

if (isset($_POST['submit-forgot'])){
	if (!filter_var($_POST['forgot-email'], FILTER_VALIDATE_EMAIL))
		$message = "<h6>"."Incorrect email!"."<h6>";
	else{
		$forgot_email= validate_data ($_POST['forgot-email']);
		$_POST = array();
		$forgot_query = $dbh->prepare ("SELECT * FROM `user` WHERE `email` = '$forgot_email'");
		$forgot_query->execute();
		$forgot_result = $forgot_query->fetch();
		if ($forgot_result['username']){
			$forgot_code = substr(md5(mt_rand()),0,15);
			$forgot_request = $dbh->prepare("INSERT INTO `forgot_pass` (`email`, `code`) VALUES ('$forgot_email', '$forgot_code')");
			$forgot_request->execute();

			$subject="Password reset For Camagru.com";
			$from = 'info@camagru.hive';
			$body='To reset password please Click On This link http://localhost:8080/Camagru/srcs/forgot-password.php?email='.$forgot_email.'&code='.$forgot_code.' to activate your account.';
			$headers = "From:".$from;
			$mail_result = mail($forgot_email, $subject, $body, $headers);
			header('location:verify.php?msg=nwpass');
			$_SESSION['nwpass'] = 1;
		}
		else {
			$message = "<h6>"."No user found with this email!"."<h6>";
		}
	}
}

if (isset($_GET['msg'])){
	$message = "<h6>"."Your password has been updated!"."<h6>";
}

?>

<!DOCTYPE html>
<html>
<head>
	
	<?php include_once("../frontend/head.html")?>
	<link rel="stylesheet" href="../style/signin.css">
	<title>Camagru Signin</title>
</head>
<body>

	<img id="main-logo" src="../media/logos/Camagru-logos_textAndCat2_black.png" alt="">
	
	<div class="middle-container">
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
						<input type="text" name="username" placeholder="username" required>
						<input type="password" name="password"  placeholder="Password" required>

						<!-- Sign in button tag -->
						<button type="submit" name="submit">Log In</button>
						
						<!-- Forgot password tag text -->
						<div class="forgot-pass">
							<button class='forgot-button' onclick="forgotPass()">
								Forgot password?
							</button>
						</div>

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

		<div class="forgot-popup">
			<p class="popup-text">Please enter your email</p>
			<form class="forgot-form" action="" method="post">
				<input type="email" name="forgot-email">
				<button type="submit" name="submit-forgot">Submit</button>
			</form>
		</div>
	</div>
</body>
<script>
	function forgotPass(){
		let forgotPopUp = document.querySelector('.forgot-popup');
		forgotPopUp.style.display = 'flex';
        
        // to hide element when clicked outside the box
        document.addEventListener('mouseup', function(e){
            if (!forgotPopUp.contains(e.target)){
                forgotPopUp.style.display = 'none';
            }
        })
	}
</script>
</html>