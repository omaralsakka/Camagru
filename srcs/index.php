<!-- This is the entry file for the application. It starts by sending the
user to the sign up page. Incase the user has an account, there is a bottom
option to log in -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Camagru Signup</title>

	<style>
		
		/* default size for all elements */
		*{
			margin:0;
			padding:0;
			box-sizing: border-box;
		}

		.instagram-container{
			width: 100%;
			max-width: 350px;
			margin: auto;
			border: 1px solid #ccc;
			margin-top: 15px;
		}

		.instagram-logo{
			width: 100%;
			max-width: 400px;
			margin: auto;
			margin-top: 10px;
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
			color: white;
			background-color: #3897f0;
			border-radius: 5px;
		}

		.instagram-container-inside h5{
			color: #C0C0C0;
			text-align: center;
		}
		
		.instagram-container-inside input[type=email], input[type=text], 
		input[type=password]{
			width: 100%;
			padding: 8px;
			margin: 6px;
			display: inline-block;
			box-sizing: border-box;
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

		.instagram-bottom-container{
			width: 100%;
			max-width: 350px;
			margin: auto;
			border: 1px solid #ccc;
			margin-top: 15px;
		}

		.instagram-bottom-container h4{
			margin-top: 20px;
			margin-bottom: 20px;
			text-align: center;
		}
	</style>
</head>
<body>
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

		<div class="instagram-container-inside">
			
			<!-- provided by fontawesome.com / to log in with facebook account -->
			<button><i class="fa-brands fa-facebook-square"></i>Log in with 
			facebook</button>

			<h5>OR</h5>

			<!-- Sign up options -->
			<input type="email" placeholder="Mobile Number or Email">
			<input type="text" placeholder="Full Name">
			<input type="text" placeholder="Username">
			<input type="password" placeholder="Password">

			<!-- Sign up button tag -->
			<button>Sign up</button>

			<!-- Terms and policy text -->
			<p>By signing up, you agree to our</p>
			<p>Terms, Data policy and Cookies</p>
			<p>Policy.</p>

		</div>

	</div>
	
	<!-- Bottom container has the log in option -->
	<div class="instagram-bottom-container">
		
		<!-- Log in option -->
		<h4>Have an account? <a href="" style="text-decoration: none; 
		color: #3897f0;">Log In</a></h4>

	</div>

</body>
</html>