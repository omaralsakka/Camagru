<!-- This is the entry file for the application. It starts by sending the
user to the sign up page. Incase the user has an account, there is a bottom
option to log in -->

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
		
		/* default settings for all elements */
		*{
			margin:0;
			padding:0;
			box-sizing: border-box;
			font-size: 1em;
			/* color: #000; */
			font-family: 'Space Grotesk', sans-serif;
		}
		
		body{
			background-color: #F6F6F6;
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
			/* object-fit: cover;
			object-position: center;
			height: 100px;
			width: 250px; */
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

			<div class="instagram-container-inside">
				
				<!-- provided by fontawesome.com / to log in with facebook account -->
				<button><i class="fa-brands fa-facebook-square"></i> Log in with 
				facebook</button>

				<h5>OR</h5>

				<!-- Sign up options -->
				<input type="email" placeholder="Phone Number or Email">
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
			<h4>Have an account? <a href="signin.php" style="text-decoration: none; 
			">Log In</a></h4>

		</div>
	</div>
</body>
</html>