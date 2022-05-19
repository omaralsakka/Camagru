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
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Camera</title>
    <?php include_once('../frontend/head.html')?>
    <link rel="stylesheet" href="../style/editing-page.css">
    <script src="../scripts/applyFilter.js"></script> 
</head>
<style>

</style>
<body>
    <?php include_once('../frontend/navbar.html')?>
    
    <div class="main-container">

        <?php include('../frontend/filtersContainer.html')?>
        <div class="view-image-container">
            <div class="display">

                <div class="filter-display-container">
                    <img src="" alt="" id="filter-displayed" class="">
                </div>
            </div>

            <button class="capture-button">
                <img id="capture-icon" src="../media/icons/icons8-lense-64.png" alt="capture icon image">
            </button>
        </div>

        <div class="thumbnail-container">
            <!-- this is to be uncommented for adding thumbnails inside of it -->
            <!-- <div class="thumbnail-image-container">
                <img src="../media/html_image.png" alt="thumbnail image" class="thumbnail-image">
            </div> -->
            <!-- <div class="thumbnail-image-container">
                <img src="../media/html_image.png" alt="thumbnail image" class="thumbnail-image">
            </div> -->
            <!-- <div class="thumbnail-image-container">
                <img src="../media/html_image.png" alt="thumbnail image" class="thumbnail-image">
            </div> -->
        </div>
    </div>
    <div class="footer">
        <div class="buttons-container">
            <button class="button-option">
                <img src="../media/icons/icons8-camera-100-outline.png" alt="" class="option-image">
            </button>
            <button class="button-option">
                <img src="../media/icons/icons8-folder-100-outline.png" alt="" class="option-image">
            </button>
            <button class="button-option">
                <img src="../media/icons/icons8-done-100.png" alt="" class="option-image">
            </button>
        </div>
    </div>

</body>
<script>
    let filterDisplayed = document.getElementById('filter-displayed');

    function selectFilter(clickedFilter){
        
        // getting the path of the filter and save it in display screen
        filterDisplayed.src = "../media/filters/"+clickedFilter.id;
        
        // applying filter location
        applyFilter(clickedFilter.classList[1]);
    }

    
</script>
</html>