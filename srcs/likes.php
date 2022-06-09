<?php

require_once('config.php');
session_start();
if(!isset($_SESSION['username']))
    header('location:signin.php');
$logged_user = $_SESSION['username'];



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

?>