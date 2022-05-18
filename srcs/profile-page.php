<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
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

        </div>
    </div>

</body>
</html>