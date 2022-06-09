<?php

require_once('security_functions.php');
require_once('config.php');
session_start();
if(!isset($_SESSION['user_id']))
    header('location:signin.php');

$username = $_SESSION['username'];
if(isset($_POST['submit-comment'])){

	$comment = validate_data ( $_POST['comment'] );
	$image_id = $_POST['image_id'];
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
	
	if ($img_usr['username'] != $username){
		$img_owner = $img_usr['username'];
		$get_usr_email = $dbh->prepare("SELECT * FROM `user` WHERE `username` = '$img_owner'");
		$get_usr_email->execute();
		$usr_table = $get_usr_email->fetch();
		if ($usr_table['notifications'] == '1'){
			$to = $usr_table['email'];
			$subject="Comment Notification - Camagru";
			$from = 'info@camagru.hive';
			$body = "You have received a new comment from ".$_SESSION['username']." on one of your images!";
			$headers = "From:".$from;
			mail($to,$subject,$body,$headers);
		}
	}

}

if (isset($_POST['remove_comment'])){
	$comment_id = $_POST['comment_id'];
	$d_comment_query = $dbh->prepare("DELETE FROM user_comments WHERE id = '$comment_id'");
	$d_comment_query->execute();
}
header('location:home.php');
?>