<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        .main-container{
            display: flex;

        }
        .result{
            /* display: flex;
            justify-content: center;
            align-items: center; */
            /* width: 50%; */
            /* margin: 0 auto; */
        }
        .camera-container{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .filters{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 10%;
            background-color: yellow;
            border: none;
            border-radius: 10px;
            margin-left: auto;
        }
        .filters img{
            width: 100px;
            margin: 5px;
            background-color: red;
            border: none;
            border-radius: 10px;

        }
    </style>
</head>
    <body>
        <div class="main-container">
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
            <!-- <div class="filters">
                <button type="submit" class="filter" id="f1" value="submit" ><img src="../media/filters/pngegg.png" alt=""></button>
                <button class="filter" id="f2" value="submit" ><img src="../media/filters/pngegg(4).png" alt="" ></button>
                <button class="filter" id="f3" value="submit" ><img src="../media/filters/pngegg(2).png" alt="" ></button>
            </div> -->
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
        var filterNum;
        function filterChoice(filterId){
            
            filterNum = filterId;
            
        }

        camera_button.addEventListener('click', async function() {
            let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
            video.srcObject = stream;
        });

        form.addEventListener('submit', function() {
            // e.preventDefault();
            // console.log(filterNum);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'image.php', true);
            xhr.onload = function(){
                if (this.status == 200){
                    // console.log(this.responseText);
                };
            }
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            image_data_url = canvas.toDataURL();
            hidden.value = image_data_url;
            // console.log(hidden.value);
            var filter = "filter="+filterNum;
            var response = "base64image="+hidden.value;
            xhr.send(response+"&"+filter);
        });
        
    </script>
</html>
