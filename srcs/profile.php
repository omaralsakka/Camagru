<?php
    session_start();

?>
<!DOCTYPE html>
<html>
  
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="../style/style.css" />
    <style>
        #upload-container{
            width: 50%;
            margin: 20px auto;
            border: 1px solid #cbcbcb;
        }
        .upload-form{
            width: 50%;
            margin: 20px auto;
        }
        .upload-form div{
            margin-top: 5px;
        }
        #img_div{
            width: 80%;
            padding: 5px;
            margin: 15px auto;
            border: 1px solid #cbcbcb;
        }
        #img_div:after{
            content: "";
            display: block;
            clear: both;
        }
        img{
            float: left;
            margin: 5px;
            width: 300px;
            height: 140px;
        }
    </style>
</head>

<body>
    <div id="upload-container">
  
    <form class="upload-form" method="POST" action="" enctype="multipart/form-data">
            <input type="file" name="myimage" value="" />
            <div>
                <button type="submit" name="submit_image">UPLOAD</button>
            </div>
        </form>
    </div>
</body>
</html>

