<?php
    session_start();
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    
    // connection to the db
    $dbh = new PDO("mysql:host=localhost;dbname=camagru_website", "root", "123456");

    // if (isset($_POST['uploadBtn'])){
    //     $tmpName = $_FILES['myfile']['name'];
    //     $tmpType = $_FILES['myfile']['type'];
        // echo "
        // <img class='image' src='data:".$tmpType.";base64,".base64_encode($tmpData)."'width='200'/></li>";

    // }
    // on upload button
    if(isset($_POST['btn'])){
        
        // get the file name, type, file content, and username from session
        $name = $_FILES['myfile']['name'];
        $type = $_FILES['myfile']['type'];
        $usrName = $_SESSION['username'];
        $data = file_get_contents($_FILES['myfile']['tmp_name']);

        //prepare sql query and execute it on the Parameters, then execute the query.
        $stmt = $dbh->prepare("INSERT INTO user_images(`username`,`name`, `type`, `data`) 
        VALUES (:username, :name, :type, :data)");
        $stmt->bindParam('username',$usrName);
        $stmt->bindParam('name',$name);
        $stmt->bindParam('type',$type);
        $stmt->bindParam('data',$data);
        $stmt->execute();
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
    
    <?php include_once("../frontend/head.html")?>
    <style>

        /* .main-container{
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 40vh auto;
            width: 50%;
        } */


        /* #img_div{
            width: 80%;
            padding: 5px;
            margin: 15px auto;
            border: 1px solid #cbcbcb;
        }
        #img_div:after{
            content: "";
            display: block;
            clear: both;
        } */
        /* img{
            float: left;
            margin: 5px;
            width: 300px;
            height: 140px;
        } */

    </style>
    <script src="../scripts/applyFilter.js"></script>
</head>

<body>

    <?php include_once("../frontend/navbar.html");?>

    <div class="middleWrapper">
        <div class="main-container">
            <div id="picResult">
                <img id="filterImg" alt="">
            </div>
            <div id="upload-container">
                    <!-- <form class="upload-form" method="POST" action="" enctype="multipart/form-data">
                        <input type="file" name="myfile" value="" />
                        <div>
                            <button type="submit" name="btn">Confirm</button>
                        </div>
                    </form> -->
                    
                    <div>
                        <p><input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;"></p>
                        <button><label for="file" style="cursor: pointer;">Browse</label></button>

                    </div>
            </div>
            <div id="camera-container">
                    <video id="video" width="640" height="480" autoplay>
                        <canvas id="canvas" width="640" height="480" type="hidden"></canvas>
                    </video>
                    <!-- <div id="picResult">
                        <img id="filterImg" alt="">
                    </div> -->
                    <form id="imgForm" method="post" action="">
                        <button id="click-photo" type="submit" value="submit">
                            <img id="lensIcon" src="../media/icons/icons8-lense-64.png" alt="lense image">
                        </button>
                        <input id="hidden" type="hidden" name="base64image">
                    </form>
            </div>
        </div>
        <div class="filtersBar">
            <?php include_once("../frontend/filtersBar.html")?>
        </div>
    </div>
    <div class="footer-container">
        <div class="footer-elements">

            <div class="buttons">
                <button id="start-camera" name="camera" onclick="displayCamera()">Snap it!</button>
            </div>
            <div class="buttons">
                <button name="upload" onclick="displayUpload()">Upload it!</button>
            </div>
            <button id="submitButton" onclick="submitImage()" type="button">Save Image</button>
        </div>
    </div>
</body>
<script>

    let cameraContainer = document.getElementById('camera-container');
    let camera_button = document.querySelector("#start-camera");
    let video = document.querySelector("#video");
    let form = document.getElementById('imgForm');
    let canvas = document.querySelector("#canvas");
    let hidden = document.getElementById("hidden");
    let resultCanvas = document.getElementById('resultCanvas');
    let filterImg = document.getElementById('filterImg');
    let filter = "";
    let filterLocation;
    let filterClass = "";
    let userImageResult = '';

    // function to select the filter
    function selectF(element){
        filter = element.id;
        filterClass = element.className;
        filterLocation = '../media/filters/'+filter;
    }

    var loadFile = function(event) {
        let picResult = document.getElementById('picResult');
        picResult.style.display = 'flex';
        picResult.style.background = "url('"+URL.createObjectURL(event.target.files[0])+"')";
        picResult.style.backgroundRepeat = "no-repeat";
        picResult.style.backgroundSize = "auto";
        filterImg.src = filterLocation;
        applyFilter(filterClass);
        document.getElementById('submitButton').style.display = "block";
        if (filterImg.src == ""){
            filterImg.style.display = 'none';
        } else {
            filterImg.style.display = 'block';
        }
    };
    // function to display upload image box
    function displayUpload(){
        let upload = document.getElementById("upload-container");        
        if (upload.style.display === "flex"){
            upload.style.display = "none";
        } else {
            upload.style.display = "flex";
            document.getElementById('submitButton').style.display = 'none';
            cameraContainer.style.display = "none";
        }
    }

    // function to display the camera
    function displayCamera(){
        let upload = document.getElementById("upload-container");
        if (cameraContainer.style.display == "flex"){
            cameraContainer.style.display = "none";
        } else {
            cameraContainer.style.display = "flex";
            upload.style.display = "none";
        }
    }

    // function to capture the result image
    function submitImage(){
        var container = document.getElementById("picResult"); 
        html2canvas(container, { allowTaint: true }).then(function (canvas) {
            userImageResult = canvas.toDataURL();
            setTimeout(postUserImage(userImageResult), 1000);
        });
    }

    // send the captured image to post file
    function postUserImage(usrImg){
        let xhr = new XMLHttpRequest();
        xhr.onload = function(){
            if (this.status == 200){
            }
        }
        xhr.open('POST', 'image.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('userImageResult='+userImageResult);
    }
    

    
    // to activate the video
    camera_button.addEventListener('click', async function() {
        video.style.display = 'block';
        let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
        video.srcObject = stream;
    });
    
    // to capture the image from the video
    form.addEventListener('submit', function(e) {
        
        let result = document.getElementById('picResult');
        // let filterImg = document.getElementById('filterImg');
        e.preventDefault();
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        image_data_url = canvas.toDataURL();
        hidden.value = image_data_url;
        

        result.style.display = 'flex';
        result.style.background = "url('"+image_data_url+"')";
        result.style.backgroundRepeat = "no-repeat";
        result.style.backgroundSize = "cover";
        filterImg.src = filterLocation;

        applyFilter(filterClass);
        // under here was the switch filter

        video.style.display = 'none';
        document.getElementById('submitButton').style.display = "block";
        if (filterImg.src == ""){
            filterImg.style.display = 'none';
        } else {
            filterImg.style.display = 'block';
        }
    });

</script>
</html>