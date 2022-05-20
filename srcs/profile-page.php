<?php

session_start();

error_reporting(0);


//if the session does not have a user_id value, return to signin.php file
if(!isset($_SESSION['user_id'])){

    header('location:signin.php');

} else {

    // save the user_id into a variable
    $userId = $_SESSION['user_id'];
}

$dbh = new PDO("mysql:host=localhost;dbname=camagru_website", "root", "123456");

$username = $_SESSION['username'];
$stat = $dbh->prepare("SELECT * FROM user_images WHERE `username`='$username'");
$stat->execute();


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
                <?php

                    while($row = $stat->fetch()){
                        $type = $row['type'];
                        $content = base64_encode($row['content']);
                        echo "<img class='picture' src='".$type.$content."'/>";
                    }
                ?>
                <!-- <img src="../media/html_image.png" alt="" class="picture"> -->
            </div>
        </div>
    </div>

</body>
</html>