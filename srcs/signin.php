<!-- This is the entry file for the application. It starts by sending the
user to the sign up page. Incase the user has an account, there is a bottom
option to log in -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- font awesome cdn to include their styling kits -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
	<title>Camagru Signin</title>

	<style>
		
		/* default size for all elements */
		*{
			margin:0;
			padding:0;
			box-sizing: border-box;
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
			border: 1px solid #ccc;
			margin-top: 15px;
			padding: 5px;
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
			/* object-position: center; */
			/* height: 100px;
			width: 350px; */
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
			cursor: pointer;
		}

		.instagram-container-inside h5{
			color: #3897f0;
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
	<div class="credentials-container">

		<!-- sign up container box -->
		<div class="instagram-container">
			
			<!--website logo  -->
			<div class="instagram-logo">
				<img src="../media/logos/Camagru-logos_sideBySide_black.png" alt="brand logo">
			</div>

			<div class="instagram-container-inside">

				<!-- Sign in options -->
				<input type="email" placeholder="Phone Number, username or Email">
				<input type="password" placeholder="Password">

				<!-- Sign in button tag -->
				<button>Log In</button>
				
				<h5>OR</h5>
				
				<!-- provided by fontawesome.com / to log in with facebook account -->
				<h5><i class="fa-brands fa-facebook-square"></i> Log in with 
				facebook</h5>

				<!-- Forgot password tag text -->
				<p>Forgot password?</p>

			</div>

		</div>
		
		<!-- Bottom container has the log in option -->
		<div class="instagram-bottom-container">
			
			<!-- Log in option -->
			<h4>Don't have an account? <a href="index.php" style="text-decoration: none; 
			color: #3897f0;">Sign Up</a></h4>

		</div>
	</div>
</body>
</html>