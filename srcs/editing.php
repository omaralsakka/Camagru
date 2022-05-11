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

        .main-container{
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 40vh auto;
            width: 50%;
        }

        #upload-container{
            display: none;
            width: 50%;
            border: 1px solid #cbcbcb;
			padding: 5px;
			border-radius: 5px;
			box-shadow: 5.6px 11.2px 11.2px hsl(0deg 0% 0% / 0.33);
			background-color: #F6F6F6;
        }

        .upload-container button{
            padding: 5px;
        }
        .upload-form{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin: 20px auto;
        }
        .upload-form div{
            margin-top: 20px;
        }

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
    <!-- nav bar -->
    <div class="navbar">
        <?php include_once("../frontend/navbar.html");?>
    </div>

    <div class="main-container">
        <div id="upload-container">
                <form class="upload-form" method="POST" action="" enctype="multipart/form-data">
                    <input type="file" name="myfile" value="" />
                    <div>
                        <button type="submit" name="btn">Confirm</button>
                    </div>
                </form>
        </div>
    </div>
    <div class="footer-container">
        <div class="footer-elements">

            <div class="buttons">
                <button name="camera">Snap it!</button>
            </div>
            <div class="buttons">
                <button name="upload" onclick="displayUpload()">Upload it!</button>
            </div>
        </div>
    </div>
    <!-- <div class="image-preview"> -->
</body>
<script>
    
    // function to display upload image box
    function displayUpload(){
        var upload = document.getElementById("upload-container");
        
        if (upload.style.display === "flex"){
            upload.style.display = "none";
        } else {
            upload.style.display = "flex";
        }
    }
</script>
</html>
        