<?php

error_reporting(0);

session_start();
if(!isset($_SESSION['user_id'])){
    header('location:signin.php');
} else {
    $username = $_SESSION['username'];
    require_once('./config.php');
    require_once('security_functions.php');
}
if (isset($_POST['notification_update'])){
    if ($_SESSION['notifications']){
        $notification_update = $dbh->prepare("UPDATE `user` SET `notifications` = 0 WHERE `username` = '$username'");
        $_SESSION['notifications'] = 0;
    } else {
        $notification_update = $dbh->prepare("UPDATE `user` SET `notifications` = 1 WHERE `username` = '$username'");
        $_SESSION['notifications'] = 1;
    }
    $notification_update->execute();
}
if (isset($_POST['change_username'])){
    
    if (!preg_match("/^[a-zA-Z]*$/", $_POST['new_username']))
	    $message = "Username can contain only letters";
    else {
        $new_username = validate_data ( $_POST['new_username'] );
        $check_username = $dbh->prepare("SELECT * FROM `user` WHERE `username` = '$new_username'");
        $check_username->execute();
        $checked = $check_username->fetch();
        if (!$checked['username']){
            $_POST = array();
            
            $username_query = $dbh->prepare ("UPDATE `user`, `user_images`, `user_comments` 
            SET `user`.`username` = '$new_username', `user_images`.`username` = '$new_username', `user_comments`.`username` = '$new_username'
            WHERE `user`.`username` = '$username' AND `user_images`.`username` = '$username' AND `user_comments`.`username` = '$username'");
            $username_query->execute();
            $_SESSION['username'] = $new_username;
        } else {
            $message = "Error: Username exist!";
        }
    }
}
if (isset($_POST['change_name'])){
    
    if (!preg_match("/^[a-zA-Z\s]+$/", $_POST['new_name']))
	    $message = "Fullname can contain only letters and spaces";
    else {
        $new_name = validate_data ( $_POST['new_name'] );
        $_POST = array();
        
        $name_query = $dbh->prepare("UPDATE `user` SET `fullname` = '$new_name' WHERE `username` = '$username'");
        $name_query->execute();
        $_SESSION['fullname'] = $new_name;
    }
}
if (isset($_POST['change_email'])){
    if (!filter_var($_POST['new_email'], FILTER_VALIDATE_EMAIL))
        $message = "Incorrect email!";
    else {
        $new_email = validate_data ( $_POST['new_email'] );
        $_POST = array();
        $email_query = $dbh->prepare("UPDATE `user` SET `email` = '$new_email' WHERE `username` = '$username'");
        $email_query->execute();
    }
}
if (isset($_POST['change_pass'])){
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['new_pass'])){
        $message = "Password should contain only letters and numbers";
    }
    else if (!validate_password(($_POST['new_pass'])))
    {
        $message = "Password should contain at least 1 lowercase letter, 1 uppercase letter 1 number and length of 8";
    }
    else {
        $new_pass = validate_data ( $_POST['new_pass'] );
        $_POST = array();
        $new_pass = hash('whirlpool', $new_pass);
        $pass_query = $dbh->prepare("UPDATE `user` SET `password` = '$new_pass' WHERE `username` = '$username'");
        $pass_query->execute();
    }
}
if (isset($_POST['delete_account'])){
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['password']))
        $message = "Password should contain only letters and numbers";
        else {
        $user_pass = validate_data ( $_POST['password'] );
        $_POST = array();
        $user_pass = hash('whirlpool', $user_pass);
        $check_pass = $dbh->prepare ("SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$user_pass'");
        $check_pass->execute();
        $user_info = $check_pass->fetch();
        if ($user_info['password'] == $user_pass){
            $delete_user = $dbh->prepare 
            ("DELETE FROM `user` WHERE `username` = '$username';
            DELETE FROM `user_images` WHERE `username` = '$username';
            DELETE FROM `user_comments` WHERE `username` = '$username'");
            $delete_user->execute();
            $_SESSION = array();
            header('location:../index.php');
        }
        else {
            $message = "Incorrect Password!";
        }
    }
}
header('location:settings.php');
?>