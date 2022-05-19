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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" 
        integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
</head>
<style>

</style>
<body>
    <?php include_once('../frontend/navbar.html')?>
    
    <div class="main-container">

        <?php include('../frontend/filtersContainer.html')?>
        <div id="view-media" class="view-image-container">
            <div id="displayScreen" class="display">
                <div class="result-image-container">
                    <img src="" alt="" id="result-picture">
                </div>
                
                <video id="video" width="640" height="480" autoplay></video>
                
                <div class="filter-display-container">
                    <img src="" alt="" id="filter-displayed" class="">
                </div>

            </div>
            <form method="post" id="postImageForm" action="storeImage.php">
                <input type="hidden" name="image" id="image-tag">
                <button class="capture-button" type="submit" value="submit">
                <!-- <button class="capture-button" onclick="captureCanvas()"> -->
                    <img id="capture-icon" src="../media/icons/icons8-lense-64.png" alt="capture icon image">
                </button>
            </form>
        </div>

        <div id="thumbnails-container" class="thumbnail-container">
            <!-- this is to be uncommented for adding thumbnails inside of it -->
            <!-- <div class="thumbnail-image-container">
                <img id="thumbnail-result" src="" alt="thumbnail image" class="thumbnail-image">
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
            <button id="start-video" class="button-option">
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
    let startVideo = document.getElementById('start-video');
    let video = document.getElementById('video');
    let captureImgForm = document.getElementById('capute-image-form');
    let viewMedia = document.getElementById('view-media');
    let displayScreen = document.getElementById('displayScreen');
    let PostForm = document.getElementById('postImageForm');
    // let resultPicture = document.getElementById('result-picture');
    // let canvas = document.getElementById('mycanvas');
    // let ctx = canvas.getContext('2d');

    function selectFilter(clickedFilter){
        
        // getting the path of the filter and save it in display screen
        filterDisplayed.src = "../media/filters/"+clickedFilter.id;
        
        // applying filter location
        applyFilter(clickedFilter.classList[1]);
    }

    startVideo.addEventListener('click', async function(){
        video.style.display = 'block';
        let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
        video.srcObject = stream;
    })

PostForm.addEventListener('submit', function(e){
    e.preventDefault();
    let imageTag = document.getElementById('image-tag');
    html2canvas(displayScreen).then(canvas=>{
        imageTag.value = canvas.toDataURL();
        appendThumbnail(canvas.toDataURL());
        console.log("inside the promise: "+imageTag.value) //valid results.
    });
    console.log("outside the promise: "+imageTag.value); //empty results.
})

    function captureCanvas(){
        // ctx.drawImage(displayScreen, 0, 0, 640, 480);
        html2canvas(displayScreen).then(canvas =>{
            // viewMedia.appendChild(canvas);
            // resultPicture.src = canvas.toDataURL();
            appendThumbnail(canvas.toDataURL());
            // console.log(canvas.toDataURL());
            // console.log(resultPicture.src);

        })
    }

    function appendThumbnail(resultImage){
        let thumbnailImgContainer = document.createElement('div');
        thumbnailImgContainer.className = 'thumbnail-image-container';

        let thumbnailImg = document.createElement('img');
        thumbnailImg.className = 'thumbnail-image';
        thumbnailImg.src = resultImage;

        let thumbnailsContainer = document.getElementById('thumbnails-container');
        thumbnailImgContainer.appendChild(thumbnailImg);
        thumbnailsContainer.appendChild(thumbnailImgContainer);
    }
    // captureImgForm.addEventListener('submit', function(event) {
        // event.preventDefault();
    // });
</script>
</html>