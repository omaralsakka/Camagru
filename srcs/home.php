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

require_once('config.php');

$username = $_SESSION['username'];
$stat = $dbh->prepare("SELECT * FROM user_images ORDER BY id DESC");
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
				$comments_check = $dbh->prepare("SELECT * FROM user_comments WHERE `image_id` = '$image_id' ORDER BY `date` DESC");
				$comments_check->execute();
				$comments_available = $comments_check->fetch();
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
						<button class="action-button" onclick="ajaxLike('.$image_id.')">
							<img name="dislike" id="'.$image_id.'-heart" src="../media/icons/icons8-heart-inline-red.png" alt="button image" class="action-image">
						</button>
					';
				
				} else {
					echo '
						<button name="like" class="action-button" onclick="ajaxLike('.$image_id.')">
							<img name="like" id="'.$image_id.'-heart" src="../media/icons/icons8-heart-outline.png" alt="button image" class="action-image">
						</button>

					';
				}
				echo '
							
								<button id="'.$image_id.'b'.'" class="action-button display-comment" onclick="displayComment(this.id)">
									<img src="../media/icons/icons8-comment-64-outline.png" alt="button image" class="action-image">
								</button>

								<div class="username-container">
									<a class="username-link" href="clicked-user-page.php?user='.$username.'">
										<h3 class="username">'.$username.'</h3>
									</a>
								</div>

							</div>
							<div class="picture-date">
								<div class="date">'.$date.'</div>
							</div>

							<div id="'.$image_id.'bc'.'" class="comment-container">
								<form action="comments.php" method="post" class="comment-form">
									<input class="comment-field" type="text" name="comment" maxlength="2200">
									<input type="hidden" name="image_id" value="'.$image_id.'">
										<button type="submit" name="submit-comment" class="submit-comment">
											<img src="../media/icons/submit-comment-outline.png" alt="button image" class="submit-comment-img">
										</button>
								</form>
							</div>';
				echo 		'<div class="user-comments-container">';
				
				// if there comments exist for the user, there will be a button to view them.
				if ($comments_available['id']){
					echo '
					<div class="show-comments-container">
						<button class="show-comments-btn" onClick="showComments('.$image_id.')">View all comments</button>
					</div>
					';
				}
				echo '<div class="comments-description" id="cd-'.$image_id.'">';
				while ($comments_table = $comments_query->fetch()){
					$this_id = $comments_table['id'];
					$comment_username = $comments_table['username'];
					$comment_date = date('Y.m.d', strtotime($comments_table['date']));
					$comment_content = $comments_table['comment'];

					echo 	'
								<div class="comments-top-part">
									<div class="user-comment-info">
										<p class="comment-username">'.$comment_username.'</p>
										<p class="comment-date">'.$comment_date.'</p>
									</div>';
					if ($_SESSION['username'] == $comment_username || $_SESSION['username'] == $username){
						echo 	'<form action="comments.php" method="post" class="remove-comment-form">
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
								</div>
							';
				};
					echo '</div>';
				echo '</div>';
			echo '</div>';
			}

		?>
    </div>

</body>
<footer>
	<hr>
	<i>© oabdelfa camagru 2022  </i>
</footer>
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

	function showComments(id){
		let commentsPart = document.getElementById('cd-'+id);

		if (commentsPart.style.display == 'block')
			commentsPart.style.display = 'none';
		else
			commentsPart.style.display = 'block';
	}

	function ajaxLike(imageId){
		
		let xml = new XMLHttpRequest();
		let imageHeart = document.getElementById(imageId+'-heart');
		let status = imageHeart.name;

		xml.open('post', 'likes.php', true);
		xml.setRequestHeader("content-type", "application/x-www-form-urlencoded");

		if (status == 'like'){
			xml.send('like=1&image_heart='+imageId+'&heart_status=like');
			imageHeart.src = '../media/icons/icons8-heart-inline-red.png';
			imageHeart.name = 'dislike';
		}

		if (status == 'dislike'){
			xml.send('like=1&image_heart='+imageId+'&heart_status=dislike');
			imageHeart.src = '../media/icons/icons8-heart-outline.png';
			imageHeart.name = 'like';
		}
	}

</script>
</html>