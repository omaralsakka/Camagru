<?php

session_start();
error_reporting(0);
require_once('../config/database.php');

//if the session does not have a user_id value, return to signin.php file
if(!isset($_SESSION['user_id'])){

    header('location:signin.php');

} else if ($_GET['user'] == $_SESSION['username']){
    
    header('location:profile-page.php');

} else {

    // save the user_id into a variable
    $username = $_GET['user'];
    $stat = $dbh->prepare("SELECT * FROM user_images WHERE `username`='$username' ORDER BY `date` DESC");
    $avatar_q = $dbh->prepare("SELECT * FROM user_images WHERE `username`='$username' ORDER BY `date` DESC");
    $userinfo_q = $dbh->prepare("SELECT * FROM user WHERE `username`='$username'");
    $stat->execute();
    $avatar_q->execute();
    $userinfo_q->execute();
    $userinfo_f = $userinfo_q->fetch();
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
    <?php include_once('../frontend/navbar.php')?>
    
    <div class="main-container">
        <div class="top-container">
            
            <div class="portfolio-container">
                <div class="profile-avatar">
                    
                    <!-- if user taken any pics, it will be set as their profile page,
                    else the logo will be the profile pic -->
                    <?php
                        $avatar_f = $avatar_q->fetch();
                        if ($avatar_f['id']){
                            $avatar_img = base64_encode($avatar_f['content']);
                            $avatar_type = $avatar_f['type'];

                            echo '
                                <img src="'.$avatar_type.$avatar_img.'" alt="user avatar image" id="profile-image">
                            ';
                        } else {
                            echo '
                                <img src="../media/logos/Camagru-logos_initialAndCat_black.png" alt="user avatar image" id="profile-image">
                            ';
                        }
                    ?>
                </div>
                <div class="fullname-section">
                    <h4 class="fullname-text"><?php echo $userinfo_f['fullname']?></h4>
                </div>
            </div>

            <div class="username-container">
                    <h3 class="username-text"><?php echo $userinfo_f['username']?></h3>
            </div>
        </div>

        <div class="gallery-container">
            <div class="image-container">
                <?php

                    while($row = $stat->fetch()){
                        $image_id = $row['id'];
                        $type = $row['type'];
                        $content = base64_encode($row['content']);
                        echo "<img id='".$image_id."img' class='picture' src='".$type.$content."' onClick='maxImage(this.id)'/>";
                    }
                ?>
            </div>
        </div>

        <div class="maximize-image-container">
            <div class="maximized-picture">
                <img class="max-picture" src="" alt="user displayed picture">
            </div>
            <div class="action-btns">
                <button class="minimize-btn" onClick="minimizeImage()">
                    <img src="../media/icons/icons8-minimize-64.png" alt="minimize image" class="minimize-image">
                </button>
            </div>
        </div>
    </div>

</body>
<footer>
	<hr>
	<i>© oabdelfa camagru 2022  </i>
</footer>
<script>
    let maxImgContainer = document.querySelector('.maximize-image-container');
    
    function maxImage(imageId){
        let imageToMax = document.getElementById(imageId);
        let maximizedImage = document.querySelector(".max-picture");

        maximizedImage.src = imageToMax.src;
        maxImgContainer.style.display = 'flex';
    }

    function minimizeImage(){
        maxImgContainer.style.display = 'none';
    }
</script>
</html>