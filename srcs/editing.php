<?php
    session_start();
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    
    // connection to the db
    $dbh = new PDO("mysql:host=localhost;dbname=camagru_website", "root", "123456");

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

        .footer-container{
            position: fixed;
            width: 100%;
            min-width: 350px;
            max-width: 50vw;
            left: 25%;
            bottom: 10px;
        }
        .footer-elements{
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
			/* max-width: 900px; */
			margin: auto;
			/* border: 1px solid #ccc; */
			margin-top: 15px;
			border-radius: 5px;
			box-shadow: 7.2px 14.4px 14.4px hsl(0deg 0% 0% / 0.28);
			background-color: #F6F6F6;
        }
        .buttons{
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50%;
            
        }
        .footer-elements button{
            width: 90%;
            min-width: 50px;
            max-width: 10vw;
            padding: 15px;
            /* margin: 8px; */
            margin: 50px;
            border: none; 
            font-size: 18px;
            color: #111111;
            background-color: #FFCB74;
            /* color: white; */
            /* background-color: #3897f0; */
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0.8px 1.6px 1.6px hsl(0deg 0% 0% / 0.48);
            font-family: 'Space Grotesk', sans-serif;
        }
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
</head>

<body>
    <!-- nav bar -->
    <!-- <div class="navbar"> -->
        <?php include_once("../frontend/navbar.html");?>
    <!-- </div> -->

    <div class="middleWrapper">
        <div class="main-container">
            <div id="upload-container">
                    <form class="upload-form" method="POST" action="" enctype="multipart/form-data">
                        <input type="file" name="myfile" value="" />
                        <div>
                            <button type="submit" name="btn">Confirm</button>
                        </div>
                    </form>
            </div>
            <div id="camera-container">
                    <!-- <button id="start-camera">Start Camera</button> -->
                    <video id="video" width="620" height="480" autoplay>
                        <canvas id="canvas" width="620" height="480" type="hidden"></canvas>
                    </video>
                    <div id="result">
                        <img id="filterImg" alt="">
                    </div>
                    <form id="imgForm" method="post" action="">
                        <button id="click-photo" type="submit" value="submit">Click Photo</button>
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
    <!-- <div class="image-preview"> -->
</body>
<script>

    // function to display upload image box
    function displayUpload(){
        let upload = document.getElementById("upload-container");
        let camContainer = document.getElementById('camera-container');
        if (upload.style.display === "flex"){
            upload.style.display = "none";
        } else {
            upload.style.display = "flex";
            camContainer.style.display = "none";
        }
    }

    function displayCamera(){
        let cameraContainer = document.getElementById('camera-container');
        let upload = document.getElementById("upload-container");

        if (cameraContainer.style.display == "flex"){
            cameraContainer.style.display = "none";
        } else {
            cameraContainer.style.display = "flex";
            upload.style.display = "none";
        }
    }

    let camera_button = document.querySelector("#start-camera");
        let video = document.querySelector("#video");
        let form = document.getElementById('imgForm');
        let canvas = document.querySelector("#canvas");
        let hidden = document.getElementById("hidden");
        let filter = "";
        let filterLocation;
        let filterClass = "";
        let resultCanvas = document.getElementById('resultCanvas');
        let userImageResult = '';

        function submitImage(){
            var container = document.getElementById("result"); 
            html2canvas(container, { allowTaint: true }).then(function (canvas) {
                
                userImageResult = canvas.toDataURL();
                setTimeout(postUserImage(userImageResult), 1000);
            });
        }

        function postUserImage(usrImg){
            let xhr = new XMLHttpRequest();
            xhr.onload = function(){
                if (this.status == 200){
                    // console.log("This is POST results:"+this.response)
                }
            }
            xhr.open('POST', 'image.php', true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send('userImageResult='+userImageResult);
        }

        function selectF(element){
            filter = element.id;
            filterClass = element.className;
            filterLocation = '../media/filters/'+filter;
        }

        camera_button.addEventListener('click', async function() {
            let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
            video.srcObject = stream;
        });

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            image_data_url = canvas.toDataURL();
            hidden.value = image_data_url;
            
            let result = document.getElementById('result');
            let filterImg = document.getElementById('filterImg');
            filterImg.style.display = 'block';
            result.style.background = "url('"+image_data_url+"')";
            result.style.backgroundRepeat = "no-repeat";
            result.style.backgroundSize = "cover";
            filterImg.src = filterLocation;
            
            switch (filterClass){
                case "frame":
                    filterImg.style.width = "640px";
                    filterImg.style.height = "480px";
                    break;
                case "filterTopRight":
                    filterImg.style.alignSelf = "flex-start";
                    filterImg.style.width = "320px";
                    filterImg.style.height = "240px";
                    filterImg.style.margin = "0 0 0 auto";
                    break;
                case "filterTopCenter":
                    filterImg.style.alignSelf = "flex-start";
                    filterImg.style.width = "320px";
                    filterImg.style.height = "240px";
                    filterImg.style.margin = "-5% auto 100% auto";
                    break;
                case "filterBottomCenter":
                    filterImg.style.alignSelf = "flex-end";
                    filterImg.style.width = "320px";
                    filterImg.style.height = "240px";
                    filterImg.style.margin = "100% auto -5% auto";
                    break;
                case "filterBottomRight":
                    filterImg.style.alignSelf = "flex-end";
                    filterImg.style.width = "320px";
                    filterImg.style.height = "240px";
                    filterImg.style.margin = "0 0 0 auto";
                    break;
            }

            document.getElementById('submitButton').style.display = "block";
        });

</script>
</html>