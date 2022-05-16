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
        .camera-container video{
            /* position: relative; */
            margin: 20px;
        }
        .camera-container img{
            position: absolute;
            width: 320px;
            height: 240px;
            margin-left: 8px;
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

        #result{
            margin: auto;
            width: 640px;
            height: 480px;
            border: none;
            display: flex;
            overflow: hidden;
        }

        #submitButton{
            display: none;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" 
    integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

    <body>
        <div class="main-container">
            <div class="camera-container">
                <button id="start-camera">Start Camera</button>
                <video id="video" width="620" height="480" autoplay>
                    <canvas id="canvas" width="620" height="480" type="hidden"></canvas>
                </video>
                
                <form id="imgForm" method="post" action="">
                    <button id="click-photo" type="submit" value="submit">Click Photo</button>
                    <input id="hidden" type="hidden" name="base64image">
                </form>
            </div>

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
                
                <button class="filterBottomRight" type="button" value="button" id="f3.png"
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

                <button class="filterBottomCenter" type="button" value="button" id="f7.png"
                onclick="selectF(this)">
                    <img src="../media/filters/f7.png" alt="filterimage">
                </button>
                
                <button class="filterBottomCenter" type="button" value="button" id="f8.png"
                onclick="selectF(this)">
                    <img src="../media/filters/f8.png" alt="filterimage">
                </button>

            </div>

        </div>

        <!-- submit button to post image to image.php -->
        <button id="submitButton" onclick="submitImage()" type="button">Save Image</button>
    
    </body>

    <script>

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
                
                // this is if I want to save image locally
                // var link = document.createElement("a");
                // document.body.appendChild(link);
                // link.download = "html_image.jpg";
                // link.href = canvas.toDataURL();
                // link.target = '_blank';
                // link.click();
                userImageResult = canvas.toDataURL();

                setTimeout(postUserImage(userImageResult), 1000);
            });
            // console.log("this is userImageResult content: "+userImageResult);
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
