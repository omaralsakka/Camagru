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
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- font awesome cdn to include their styling kit -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
	<!-- google fonts cdn -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/style.css" />
    <style>
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
        #upload-container{
            display: none;
            width: 20%;
            margin: 20px auto;
            border: 1px solid #cbcbcb;
			padding: 5px;
			border-radius: 5px;
			box-shadow: 5.6px 11.2px 11.2px hsl(0deg 0% 0% / 0.33);
			background-color: #F6F6F6;
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
    <!-- nav bar -->
    <div class="navbar">
        <?php include_once("../frontend/navbar.html");?>
    </div>

    <div class="footer-container">
        <div class="footer-elements">
            <div id="upload-container">
                <!-- to upload an image -->
                <form class="upload-form" method="POST" action="" enctype="multipart/form-data">
                    <input type="file" name="myfile" value="" />
                    <div>
                        <button type="submit" name="btn">UPLOAD</button>
                    </div>
                </form>
            </div>
            <div class="buttons">
                <button name="camera">Snap it!</button>
            </div>
            <div class="buttons">
                <button name="upload">Upload it!</button>
            </div>
        </div>
    </div>
    <!-- <div class="image-preview"> -->
</body>
</html>
        