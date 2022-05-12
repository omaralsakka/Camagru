<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        .result{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50%;
            margin: 0 auto;
        }
        .camera-container{
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
    <body>
        <div class="camera-container">
            <button id="start-camera">Start Camera</button>
            <video id="video" width="320" height="240" autoplay>
                <canvas id="canvas" width="320" height="240" type="hidden"></canvas>
            </video>
            
            <form id="imgForm" method="post" action="">
                <button id="click-photo" type="submit" value="submit">Click Photo</button>
                <input id="hidden" type="hidden" name="base64image">
                
            </form>
        </div>
        <br><br>
        <div class="result">
            <?php include('image.php')?>
        </div>
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

        form.addEventListener('submit', function() {
            // e.preventDefault();
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'image.php', true);
            xhr.onload = function(){
                if (this.status == 200){
                    console.log(this.responseText);
                };
            }
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            image_data_url = canvas.toDataURL();
            hidden.value = image_data_url;
            // console.log(hidden.value);
            var response = "base64image="+hidden.value;
            xhr.send(response);
        });

    </script>
</html>
