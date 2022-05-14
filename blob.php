<?php
if (isset($_POST['base64image'])){
        echo "<img src=".$_POST['base64image'].">";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
    <body>
        <button id="start-camera">Start Camera</button>
        <video id="video" width="320" height="240" autoplay></video>
        <form id="imgForm" method="post" action="">
            <canvas id="canvas" width="320" height="240"></canvas>
            <input id="hidden" type="hidden" name="base64image">
            <button id="click-photo" type="submit" value="submit">Click Photo</button>
        </form>
        <br><br>
        <div id="result"></div>
    </body>

    <script>

        let camera_button = document.querySelector("#start-camera");
        let video = document.querySelector("#video");
        let form = document.getElementById('imgForm');
        let canvas = document.querySelector("#canvas");
        let hidden = document.getElementById("hidden");

        camera_button.addEventListener('click', async function() {
            let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
            video.srcObject = stream;
        });

        form.addEventListener('submit', async function() {
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            image_data_url = canvas.toDataURL();
            hidden.value = image_data_url;
        });
        

    </script>
</html>
