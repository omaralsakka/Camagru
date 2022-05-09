<?php

include("../srcs/database.php");
$DB_DSN_INIT = "mysql:host=localhost";
$USER_TABLE_QUERY = file_get_contents("./usertable.sql");
$IMAGE_TABLE_QUERY = file_get_contents("./images.sql");
$state = 1;

if(isset($_POST['submit'])){
    try {
        $conn = new PDO($DB_DSN_INIT, $DB_USER, $DB_PASSWORD);

        // if failed to connect to the server
        if($conn){
            echo "Conncetions success to server<br>";
        } else {
            echo "connection error to server<br>";
        }

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // create the query.
        $sql = "CREATE DATABASE IF NOT EXISTS $DB_BASE";

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Database camagru_website created successfully<br>";

        // incase of error, write this message
    } catch(PDOException $error){
        echo $sql . "<br>" . $error->getMessage();
        $state = 0;
    }

    // creating tables
    if ($state){
        try {
            
            // make a new connection with the created database
            $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            
            // set the PDO error mode to exxception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // execute the user table creation query
            $conn->exec($USER_TABLE_QUERY);
            echo "User Table has been created succesfully<br>";

            // execute the images table creation query
            $conn->exec($IMAGE_TABLE_QUERY);
            echo "Images Table has been created succesfully<br>";
        
        // incase of error
        } catch(PDOException $error){
            // echo $USER_TABLE_QUERY . "<br>" . $error->getMessage();
            echo $IMAGE_TABLE_QUERY . "<br>" . $error->getMessage();
        }
    }
    $conn = null;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- font awesome cdn to include their styling kit -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
	<!-- google fonts cdn -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600&display=swap" rel="stylesheet"> 
	
	<title>Camagru Deployment</title>
</head>
<body>
    <form action="" name="deploydb" method="post">
        <div class="deployment-container">
            <input class="deploy-button" name="submit" type="submit">Let's Build Camagru</button>
        </div>
    </form>
</body>
</html>