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
	<link rel="stylesheet" href="../style/home-page.css">
</head>
<body>

	<?php include_once("../frontend/navbar.html");?>

    <div class="main-container">
		<div class="item-container">
			
			<div class="picture-container">
				<img src="../media/html_image.png" alt="" class="picture">
			</div>
			
			<div class="action-container">
				<button class="action-button">
					<img src="../media/icons/icons8-heart-outline.png" alt="" class="action-image">
				</button>

				<button class="action-button">
					<img src="../media/icons/icons8-comment-64-outline.png" alt="" class="action-image">
				</button>

				<div class="username-container">
					<h3 class="username">officialomr</h3>
				</div>
			</div>

			<div class="comment-container">
				<input class="comment-field" type="text">
			</div>

			<div class="user-comments-container">
				<div class="user-comment-info">
					<h3 id="comment-username">officialomr</h3>
					<h5 id="comment-date">14.05.2022</h5>
				</div>
				<hr id="comments-horizontal-line">
				<div class="user-comment-text">
					<h3 id="user-comment-text">Nice stuff!</h3>
				</div>
			</div>
		</div>

		<div class="item-container">
			
			<div class="picture-container">
				<img src="../media/html_image.png" alt="" class="picture">
			</div>
			
			<div class="action-container">
				<button class="action-button">
					<img src="../media/icons/icons8-heart-outline.png" alt="" class="action-image">
				</button>

				<button class="action-button">
					<img src="../media/icons/icons8-comment-64-outline.png" alt="" class="action-image">
				</button>

				<div class="username-container">
					<h3 class="username">officialomr</h3>
				</div>
			</div>

			<div class="comment-container">
				<input class="comment-field" type="text">
			</div>

			<div class="user-comments-container">
				<div class="user-comment-info">
					<h3 id="comment-username">officialomr</h3>
					<h5 id="comment-date">14.05.2022</h5>
				</div>
				<hr id="comments-horizontal-line">
				<div class="user-comment-text">
					<h3 id="user-comment-text">Nice stuff!</h3>
				</div>
			</div>
		</div>

		<div class="item-container">
			
			<div class="picture-container">
				<img src="../media/html_image.png" alt="" class="picture">
			</div>
			
			<div class="action-container">
				<button class="action-button">
					<img src="../media/icons/icons8-heart-outline.png" alt="" class="action-image">
				</button>

				<button class="action-button">
					<img src="../media/icons/icons8-comment-64-outline.png" alt="" class="action-image">
				</button>

				<div class="username-container">
					<h3 class="username">officialomr</h3>
				</div>
			</div>

			<div class="comment-container">
				<input class="comment-field" type="text">
			</div>

			<div class="user-comments-container">
				<div class="user-comment-info">
					<h3 id="comment-username">officialomr</h3>
					<h5 id="comment-date">14.05.2022</h5>
				</div>
				<hr id="comments-horizontal-line">
				<div class="user-comment-text">
					<h3 id="user-comment-text">Nice stuff!</h3>
				</div>
			</div>
		</div>

		<div class="item-container">
			
			<div class="picture-container">
				<img src="../media/html_image.png" alt="" class="picture">
			</div>
			
			<div class="action-container">
				<button class="action-button">
					<img src="../media/icons/icons8-heart-outline.png" alt="" class="action-image">
				</button>

				<button class="action-button">
					<img src="../media/icons/icons8-comment-64-outline.png" alt="" class="action-image">
				</button>

				<div class="username-container">
					<h3 class="username">officialomr</h3>
				</div>
			</div>

			<div class="comment-container">
				<input class="comment-field" type="text">
			</div>

			<div class="user-comments-container">
				<div class="user-comment-info">
					<h3 id="comment-username">officialomr</h3>
					<h5 id="comment-date">14.05.2022</h5>
				</div>
				<hr id="comments-horizontal-line">
				<div class="user-comment-text">
					<h3 id="user-comment-text">Nice stuff!</h3>
				</div>
			</div>
		</div>	
    </div>

</body>
</html>