<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        .main-container{
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            /* margin: 30px auto; */
            padding: 30px;
            
        }
        .camera-container{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .filters-container{
            display: flex;
            flex-direction: column;
            height: 59vh;
            padding: 10px;
            margin-right: 50px;
            margin-left: auto;
            background-color: coral;
            border: none;
            border-radius: 10px;
            overflow: scroll;
        }
        .filters-container button{
            background-color: wheat;
            border-radius: 10px;
            margin: 10px;
        }
        .filters-container img{
            width: 100px;
            padding: 10px;
            border: none;
            border-radius: 10px;
        }
        /* #result{
            display: flex;
            justify-content: center;
            align-items: center;
            /* width: 90%; 
        } */

        #result{
            margin: auto;
            width: 640px;
            height: 480px;
            border: none;
            display: flex;
            /* background-size: 640px 480px; */
        }
        #filterImg{
            /* align-self: flex-end; */
            width: inherit;
            height: 480px;
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

            <!-- <div class="result">
                <img id="result" src="" alt="">
            </div> -->
            <div id="result">
                <img id="filterImg" alt="">
            </div>

            <div class="filters-container">
                <button class="frame" type="button" value="button" id="f1.png"
                onclick="selectF(this)">
                    <img src="../media/filters/f1.png" alt="filterimage">
                </button>
                
                <button class="filterTopRight" type="button" value="button" id="f2.png"
                onclick="selectF(this)">
                    <img src="../media/filters/f2.png" alt="filterimage">
                </button>
                
                <button class="filter" type="button" value="button" id="f3.png"
                onclick="selectF(this)">
                    <img src="../media/filters/f3.png" alt="filterimage">
                </button>
                
                <button class="filterTopRight" type="button" value="button" id="f4.png"
                onclick="selectF(this)">
                    <img src="../media/filters/f4.png" alt="filterimage">
                </button>
                
                <button class="frame" type="button" value="button" id="f5.png"
                onclick="selectF(this)">
                    <img src="../media/filters/f5.png" alt="filterimage">
                </button>

                <button class="filterTopCenter" type="button" value="button" id="f6.png"
                onclick="selectF(this)">
                    <img src="../media/filters/f6.png" alt="filterimage">
                </button>

                <button class="filterBottom" type="button" value="button" id="f7.png"
                onclick="selectF(this)">
                    <img src="../media/filters/f7.png" alt="filterimage">
                </button>
                
                <button class="filterBottom" type="button" value="button" id="f8.png"
                onclick="selectF(this)">
                    <img src="../media/filters/f8.png" alt="filterimage">
                </button>
            
            </div>
        
        </div>
        <!-- <br><br> -->

    </body>

    <script>
        let camera_button = document.querySelector("#start-camera");
        let video = document.querySelector("#video");
        let form = document.getElementById('imgForm');
        let canvas = document.querySelector("#canvas");
        let hidden = document.getElementById("hidden");
        let filter = "";
        let filterLocation;
        let imgClass = "";

        function selectF(element){
            filter = element.id;
            imgClass = element.className;
            filterLocation = '../media/filters/'+filter;
            console.log(filter);
            console.log(imgClass);
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
            
            let xhr = new XMLHttpRequest();
            let response = "image="+image_data_url+"&filterNumber="+filter;
            xhr.responseType = 'blob';
            xhr.onload = function(){
                if (this.status == 200){
                    let imgResult = URL.createObjectURL(this.response);
                    let result = document.getElementById('result');
                    let filterImg = document.getElementById('filterImg');
                    
                    result.style.background = "url('"+image_data_url+"')";
                    result.style.backgroundRepeat = "no-repeat";
                    result.style.backgroundSize = "cover";
                    if (filter == "f1.png" )
                    filterImg.src = filterLocation;
                };
            }
            xhr.open('POST', 'image.php', true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.setRequestHeader("Content-type", "image/png");
            xhr.send(response);
        });
        
    </script>
</html>
