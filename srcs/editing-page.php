<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('../frontend/head.html')?>
    <!-- <link rel="stylesheet" href="../style/style.css"> -->
    <link rel="stylesheet" href="../style/editing-page.css">
</head>
<style>

</style>
<body>
    <?php include_once('../frontend/navbar.html')?>
    
    <div class="main-container">
        
        <?php include_once('../frontend/filtersContainer.html')?>

        <div class="view-image-container">
            <div class="display">

            </div>
            <button class="capture-button">
                <img id="capture-icon" src="../media/icons/icons8-lense-64.png" alt="capture icon image">
            </button>
        </div>

        <div class="thumbnail-container">
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
</html>