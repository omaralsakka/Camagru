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
$stat = $dbh->prepare("SELECT * FROM user_images WHERE `username`='$username' ORDER BY `date` DESC");
$stat->execute();

if (isset($_POST['delete_image'])){
    $image_to_delete = trim($_POST['delete_image_id'], "img");
    $_POST = array();
    $delete_img_query = $dbh->prepare("DELETE FROM user_images WHERE id = '$image_to_delete';
    DELETE FROM user_comments WHERE image_id = '$image_to_delete'");
    $delete_img_query->execute();
    header("Location: profile-page.php");
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
                    
                    <h4 class="fullname-text"><?php echo $_SESSION['fullname']?></h4>
                </div>
            </div>

            <div class="username-container">
                    <h3 class="username-text"><?php echo $_SESSION['username']?></h3>
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
                <form action="" method="post" class="remove-picture-form">
                    <button class="remove-img-btn" type="submit" name="delete_image" onClick="return confirmDelete()">
                        <img class="remove-img-icon" src="../media/icons/icons8-remove-96.png" alt="remove icon">
                        <input class="delete_image_input" type="hidden" name="delete_image_id" value="">
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
<script>
    let maxImgContainer = document.querySelector('.maximize-image-container');
    
    function maxImage(imageId){
        let imageToMax = document.getElementById(imageId);
        let deleteImageInput = document.querySelector(".delete_image_input");
        let maximizedImage = document.querySelector(".max-picture");
        
        maximizedImage.src = imageToMax.src;
        deleteImageInput.value = imageId;
        maxImgContainer.style.display = 'flex';
    }

    function minimizeImage(){
        maxImgContainer.style.display = 'none';
    }

    function confirmDelete(){
        let agree = confirm("Are you sure you wish to delete this picture?");
		
		if (agree)
			return true ;
		else
			return false ;
    };
</script>
</html>