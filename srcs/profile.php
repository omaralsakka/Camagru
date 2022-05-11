<?php
    session_start();
    // ini_set('display_errors', '1');
    // ini_set('display_startup_errors', '1');
    // error_reporting(E_ALL);
    
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
    <div class="profile-container">
        <div class="navbar">
            <?php include_once("../frontend/navbar.html");?>
        </div>

        <!-- this will provide the preview of the user images -->
        <div class="image-preview">
            <!-- fetching from the db all the images where the logged in user matchs the image username -->
            <?php
                    $usrName = $_SESSION['username'];
                    $stat = $dbh->prepare("SELECT * FROM user_images WHERE `username`='$usrName'");
                    $stat->execute();
                    while($row = $stat->fetch()){
                        echo "<br/>
                        <embed class='image' src='data:".$row['type']. ";base64,".base64_encode($row['data'])."'width='200'/></li>";
                    }
            ?>
        </div>
    </div>
</body>
</html>

