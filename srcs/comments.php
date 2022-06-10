<?php

require_once('security_functions.php');
require_once('../config/database.php');
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
	echo "here now";
	// we fetch the username from the comments table
	$check_c_del_q = $dbh->prepare("SELECT * FROM user_comments WHERE id = '$comment_id'");
	$check_c_del_q->execute();
	$fetch_c_q = $check_c_del_q->fetch();
	$img_id_c = $fetch_c_q['image_id'];
	
	echo "$img_id_c";
	// we fetch the username from the image table
	$check_c_del_q2 = $dbh->prepare("SELECT * FROM user_images WHERE id = '$img_id_c'");
	$check_c_del_q2->execute();
	$username_on_img = $check_c_del_q2->fetch();
	
	// if the current username equals the comments username or the image username, delete the comment
	if ($username  == $fetch_c_q['username'] || $username  == $username_on_img['username'])
	{
		$d_comment_query = $dbh->prepare("DELETE FROM user_comments WHERE id = '$comment_id'");
		$d_comment_query->execute();
	}
}
header('location:home.php');
?>