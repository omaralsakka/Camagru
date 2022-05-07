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
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- font awesome cdn to include their styling kit -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
	<!-- google fonts cdn -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../style/style.css">
	
	<title>Home</title>
</head>
<body>

    <div class="home-container">
        <div class="home-top-nav">

			<div class="home-top-nav-icon">
				<div class="home-top-nav-logo">
					<a href="home.php"><img src="../media/logos/Camagru-logos_sideBySide_black.png" alt="Camagru logo"></a>
				</div>
			</div>

			<div class="home-top-nav-icon">
				<div class="home-top-nav-search">
					<input type="text" placeholder="Search">
					<!-- <script>
						function hideGlass(){
							let glass = document.getElementById("searchbar");
							if (glass.style.backgroundImage == 'url("../media/icons/icons8-search.svg")')
								glass.style.backgroundImage = "none";
							document.getElementById("searchbar").style.backgroundImage = "none";
						}
					</script> -->
				</div> 
			</div>
			
			<div class="home-top-nav-icon">
				
				<div class="home-top-nav-icon-inside">
					
					<div class="home-top-nav-icons">

						<a class="outline active" href=""><img src="../media/icons/icons8-home-empty.svg" alt="home icon"></a>
						
						<a class="inline active" href=""><img src="../media/icons/icons8-home-filled.svg" alt="home icon"></a>

					</div>
					<div class="home-top-nav-icons">
		
						<a class="outline" href=""><img src="../media/icons/icons8-cursor-outline.png" alt="cursor icon"></a>

						<a class="inline" href=""><img src="../media/icons/icons8-cursor-filled.png" alt="cursor icon"></a>

					</div>
					<div class="home-top-nav-icons">
		
						<a class="outline" href=""><img src="../media/icons/icons8-explore-outline.png" alt="explore icon"></a>
						
						<a class="inline" href=""><img src="../media/icons/icons8-explore-inline.png" alt="explore icon"></a>
		
					</div>
					<div class="home-top-nav-icons">
		
						<a class="outline" href=""><img src="../media/icons/icons8-heart-outline.png" alt="heart icon"></a>

						<a class="inline" href=""><img src="../media/icons/icons8-heart-inline-red.png" alt="heart icon"></a>

					</div>
					<div class="home-top-nav-icons">
		
						<a class="outline" href=""><img src="../media/icons/icons8-cat-profile-outline.png" alt="profile image icon"></a>

					</div>

				</div>

			</div>
        </div>
    </div>

</body>
</html>