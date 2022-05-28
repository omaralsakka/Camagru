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
	$logged_user = $_SESSION['username'];
}

$dbh = new PDO("mysql:host=localhost;dbname=camagru_website", "root", "123456");
$username = $_SESSION['username'];
$stat = $dbh->prepare("SELECT * FROM user_images ORDER BY id DESC");
$stat->execute();


if (isset($_POST['like'])){
	$clicked_img = $_POST['image_heart'];
    
	$heart = $_POST['heart_status'];
    $_POST = array();
	if ($heart == 'like'){
		$like_query = $dbh->prepare("INSERT INTO `likes_table` (`image_id`, `username`, `like`) VALUES ('$clicked_img', '$logged_user', '1')");
		$like_query->execute();
	} 
    if ($heart == 'dislike'){
		$dislike_query = $dbh->prepare("DELETE FROM `likes_table` WHERE `image_id` = '$clicked_img' AND `username` = '$logged_user'");
		$dislike_query->execute();
	}
}


if(isset($_POST['submit-comment'])){

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

	$find_img_usr = $dbh->prepare("SELECT `username` FROM `user_images` WHERE `id`='$image_id'");
	$find_img_usr->execute();
	$img_usr = $find_img_usr->fetch();
	
	if ($img_usr['username'] != $username && $_SESSION['notifications']){
		$img_owner = $img_usr['username'];
		$get_usr_email = $dbh->prepare("SELECT `email` FROM `user` WHERE `username` = '$img_owner'");
		$get_usr_email->execute();
		$usr_table = $get_usr_email->fetch();
		$to = $usr_table['email'];
		$subject="Comment Notification - Camagru";
		$from = 'info@camagru.hive';
		$body = "You have received a new comment from ".$_SESSION['username']." on one of your images!";
		$headers = "From:".$from;
		mail($to,$subject,$body,$headers);
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

	<?php include_once("../frontend/navbar.php");?>

    <div class="main-container">
		<?php
	        while($row = $stat->fetch()){
				$image_id = $row['id'];
				$username = $row['username'];
				$date = date('Y.m.d', strtotime($row['date']));
				$type = $row['type'];
				$content = base64_encode($row['content']);
				$comments_query = $dbh->prepare("SELECT * FROM user_comments WHERE `image_id` = '$image_id' ORDER BY `date` DESC");
				$comments_query->execute();
				echo 	'<div class="item-container">
							<div class="picture-container">
								<img id="'.$image_id.'" src="'.$type.$content.'" alt="" class="picture">
							</div>
							<div class="action-container">';
				
				$likes_query = $dbh->prepare("SELECT * FROM `likes_table` WHERE `image_id` = '$image_id' AND `username` = '$logged_user'");
				$likes_query->execute();
				$likes_result = $likes_query->fetch();
				
				if ($likes_result['like'] == 1){
					echo '
					<form class="like-form" action="" method="post">
						<button type="submit" name="like" class="action-button" >
							<img src="../media/icons/icons8-heart-inline-red.png" alt="button image" class="action-image">
							<input type="hidden" name="image_heart" value="'.$image_id.'">
							<input type="hidden" name="heart_status" value="dislike">
						</button>
					</form>
					';
				
				} else {
					echo '
					<form class="like-form" action="" method="post">
						<button type="submit" name="like" class="action-button" >
							<img src="../media/icons/icons8-heart-outline.png" alt="button image" class="action-image">
							<input type="hidden" name="image_heart" value="'.$image_id.'">
							<input type="hidden" name="heart_status" value="like">
						</button>
					</form>
					';
				}
				echo '
							
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
										<button type="submit" name="submit-comment" class="submit-comment">
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
	}

	function confirmSubmit(){
		let agree = confirm("Are you sure you wish to delete this comment?");
		
		if (agree)
			return true ;
		else
			return false ;
	}

	// function likeImg(imageId, click){
	// 	let xml = new XMLHttpRequest();
	// 	if (click == 1){
	// 		xml.open('get', 'likes.php?heart=like&image_id='+imageId, true);
	// 		// console.log(click);
	// 	}
	// 	else{
	// 		xml.open('get', 'likes.php?heart=dislike&image_id='+imageId, true);
	// 		// console.log(click);
	// 	}
	// 	// xml.setRequestHeader("Content-type", "text/plain");
	// 	xml.onload = function(){
	// 		console.log(this.response);
	// 	}
	// 	xml.send();
	// 	// location.reload();
	// }
</script>
</html>