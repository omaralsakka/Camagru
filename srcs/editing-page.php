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

                <video id="video"  autoplay></video>
                
                <div id="uploaded-picture"></div>

                <div class="filter-display-container">
                    <img src="" alt="" id="filter-displayed" class="">
                </div>

            </div>
            <button class="capture-button" onclick="captureCanvas()">
                <img id="capture-icon" src="../media/icons/icons8-lense-64.png" alt="capture icon image">
            </button>
        </div>

        <div id="thumbnails-container" class="thumbnail-container">
            
            <!-- this is to be uncommented for adding thumbnails inside of it -->
            
            <!-- <div class="thumbnail-image-container">
                <img id="thumbnail-result" src="" alt="thumbnail image" class="thumbnail-image">
            </div> -->
        
        </div>
    </div>
    <div class="footer">
        <div class="buttons-container">
            <button id="start-video" class="button-option">
                <img src="../media/icons/icons8-camera-100-outline.png" alt="" class="option-image">
            </button>
            <button id="upload-file" class="button-option">
                <label class="custom-file-upload">
                    <input type="file" id="image_input" accept="image/png, image/jpg"/>
                    <img src="../media/icons/icons8-folder-100-outline.png" alt="" class="option-image"></img>
                </label>
            </button>
        </div>
    </div>
</body>
<script>
    let filterDisplayed = document.getElementById('filter-displayed');
    let uploadedPicture = document.getElementById('uploaded-picture');
    let displayScreen = document.getElementById('displayScreen');
    let startVideo = document.getElementById('start-video');
    let imageInput = document.querySelector("#image_input");
    let viewMedia = document.getElementById('view-media');
    let video = document.getElementById('video');

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

    imageInput.addEventListener('change', function (){
        let readFile = new FileReader();
        let uploadedImage = '';
        readFile.addEventListener("load", function (){
            uploadedImage = readFile.result;
            uploadedPicture.style.backgroundImage = `url(${uploadedImage})`
        });
        readFile.readAsDataURL(this.files[0]);
    })

    function captureCanvas(){
    html2canvas(displayScreen).then(canvas =>{
        appendThumbnail(canvas.toDataURL('image/jpeg', 1));
        postPicture(canvas.toDataURL('image/jpeg', 1));
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

function postPicture(canvasUrl){
    let xhr = new XMLHttpRequest();
    let resultImg = document.getElementById('imagePhp');
    xhr.onload = function (){
        if (this.status == 200){
            resultImg.src = this.response;
        }
    }
    xhr.open('POST', 'storeImage.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send('image='+canvasUrl);
}

</script>
</html>