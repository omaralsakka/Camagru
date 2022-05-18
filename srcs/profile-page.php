<?php

session_start();

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
    <?php include_once('../frontend/head.html')?>
    <link rel="stylesheet" href="../style/profile-page.css">
</head>
<body>
    <?php include_once('../frontend/navbar.html')?>
    
    <div class="main-container">
        <div class="top-container">
            
            <div class="portfolio-container">
                <div class="profile-avatar">
                    <img src="../media/html_image.png" alt="" id="profile-image">
                </div>
                <div class="fullname-section">
                    <h4 class="fullname-text">Omar Abdelfattah</h4>
                </div>
            </div>

            <div class="username-container">
                    <h3 class="username-text">officialomr</h3>
            </div>
        </div>

        <div class="gallery-container">
            <div class="image-container">
                <img src="../media/html_image.png" alt="" class="picture">
            </div>
        </div>
    </div>

</body>
</html>