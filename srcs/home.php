<!-- This is the home page file for the user -->

<?php

error_reporting(0);


// starting session to pass through server the user data.
session_start();

//if the session does not have a user_id value, return to signin.php file
if(!isset($_SESSION['user_id'])){

    header('location:signin.php');

} else {

    // save the user_id into a variable
    $userId = $_SESSION['user_id'];
}

$dbh = new PDO("mysql:host=localhost;dbname=camagru_website", "root", "123456");
$username = $_SESSION['username'];
$stat = $dbh->prepare("SELECT * FROM user_images");
$stat->execute();

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
		<?php
	        while($row = $stat->fetch()){
				$username = $row['username'];
				$date = date('Y.m.d', strtotime($row['date']));
				$type = $row['type'];
				$content = base64_encode($row['content']);
				echo 	'<div class="item-container">
							<div class="picture-container">
								<img src="'.$type.$content.'" alt="" class="picture">
							</div>
							<div class="action-container">
								<button class="action-button">
									<img src="../media/icons/icons8-heart-outline.png" alt="" class="action-image">
								</button>
								<button id="display-comment" class="action-button" onclick="displayCommentInput()">
									<img src="../media/icons/icons8-comment-64-outline.png" alt="" class="action-image">
								</button>

								<div class="username-container">
									<h3 class="username">'.$username.'</h3>
								</div>

							</div>
							<div class="picture-date">
								<div id="date">'.$date.'</div>
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
						</div>';
			}
		?>
    </div>

</body>
<script>
	let commentDisplayButton = document.getElementById('display-comment');
	let commentField = document.querySelector('.comment-container');
	
	commentDisplayButton.addEventListener('click', function (){
		if (commentField.style.display == "flex"){
			commentField.style.display = "none";
		} else {
			commentField.style.display = "flex";
		}
	});


</script>
</html>