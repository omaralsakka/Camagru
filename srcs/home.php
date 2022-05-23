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

if(isset($_POST['submit'])){

	$comment = $_POST['comment'];
	$image_id = $_POST['image_id'];
	$_POST = array();
	if (strlen($comment) > 0 && !empty(trim($comment))){
		$query = $dbh->prepare("INSERT INTO user_comments(`image_id`, `username`, `comment`) 
		VALUES (:image_id, :username, :comment)");

		$query->bindParam('image_id',$image_id);
		$query->bindParam('username',$username);
		$query->bindParam('comment',$comment);
		$query->execute();
	}

}

if (isset($_POST['remove_comment'])){
	$comment_id = $_POST['comment_id'];
	$d_comment_query = $dbh->prepare("DELETE FROM user_comments WHERE id = '$comment_id'");
	$d_comment_query->execute();
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
		<?php
	        while($row = $stat->fetch()){
				$image_id = $row['id'];
				$username = $row['username'];
				$date = date('Y.m.d', strtotime($row['date']));
				$type = $row['type'];
				$content = base64_encode($row['content']);
				$comments_query = $dbh->prepare("SELECT * from user_comments WHERE `image_id` = '$image_id'");
				$comments_query->execute();
				echo 	'<div class="item-container">
							<div class="picture-container">
								<img id="'.$image_id.'" src="'.$type.$content.'" alt="" class="picture">
							</div>
							<div class="action-container">
								<button class="action-button">
									<img src="../media/icons/icons8-heart-outline.png" alt="button image" class="action-image">
								</button>
								<button id="'.$image_id.'b'.'" class="action-button display-comment" onclick="displayComment(this.id)">
									<img src="../media/icons/icons8-comment-64-outline.png" alt="button image" class="action-image">
								</button>

								<div class="username-container">
									<h3 class="username">'.$username.'</h3>
								</div>

							</div>
							<div class="picture-date">
								<div id="date">'.$date.'</div>
							</div>
							<div id="'.$image_id.'bc'.'" class="comment-container">
								<form action="" method="post" class="comment-form">
									<input class="comment-field" type="text" name="comment">
									<input type="hidden" name="image_id" value="'.$image_id.'">
										<button type="submit" name="submit" class="submit-comment">
											<img src="../media/icons/submit-comment-outline.png" alt="button image" class="submit-comment-img">
										</button>
								</form>
							</div>';
				echo 		'<div class="user-comments-container">';

				while ($comments_table = $comments_query->fetch()){
					$this_id = $comments_table['id'];
					$comment_username = $comments_table['username'];
					$comment_date = date('Y.m.d', strtotime($comments_table['date']));
					$comment_content = $comments_table['comment'];
					echo 	'
							<div class="comments-top-part">
								<div class="user-comment-info">
									<p class="comment-username">'.$comment_username.'</p>
									<p id="comment-date">'.$comment_date.'</p>
								</div>';
					if ($_SESSION['username'] == $comment_username || $_SESSION['username'] == $username){
						echo 	'<form action="" method="post" class="remove-comment-form">
									<button class="remove-comment-btn" type="submit" name="remove_comment" onClick="return confirmSubmit()">
										<img src="../media/icons/remove-icon-red.png" class="remove-comment-img" alt="remove comment icon">
										<input type="hidden" name="comment_id" value="'.$this_id.'">
									</button>
								</form>';
					}
					echo	'
							</div>
							<hr class="comments-horizontal-line">
							<div class="user-comment-text">
								<h3 class="user-comment-text">'.$comment_content.'</h3>
							</div>';
				};

					echo '</div>';
				echo '</div>';
			}

		?>
    </div>

</body>
<script>
	let commentDisplayButton = document.querySelector('.display-comment');
	
	function displayComment(id){
		let commentField = document.getElementById(id+'c');
		if (commentField.style.display == "flex"){
			commentField.style.display = "none";
		} else {
			commentField.style.display = "flex";
		}
		console.log(id);
	}

	function confirmSubmit(){
		let agree = confirm("Are you sure you wish to continue?");
		
		if (agree)
			return true ;
		else
			return false ;
	}

</script>
</html>