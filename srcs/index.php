<!-- This is the entry file for the application. It starts by sending the
user to the sign up page. Incase the user has an account, there is a bottom
option to log in and leads to signin.php file -->

<?php


include("../srcs/database.php");
$DB_DSN_INIT = "mysql:host=localhost";
$sql = file_get_contents("../sql/init.sql");

try {

    // connect to the server
    $conn = new PDO($DB_DSN_INIT, $DB_USER, $DB_PASSWORD);
    
    // on connection status
    // if($conn){
    //     echo "Conncetions success to server<br>";
    // } else {
    //     echo "connection error to server<br>";
    // }

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // execute the sql query
    $conn->exec($sql);

    // an output result just for testing purposes.
    // echo "Database camagru_website created successfully<br>";
    // echo "User Table has been created succesfully<br>";
    // echo "Images Table has been created succesfully<br>";
    
    // incase of error, write this message
} catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
}

$conn = null;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('../frontend/head.html')?>
    <link rel="stylesheet" href="../style/style.css">
</head>
<style>
    *{
		margin:0;
		padding:0;
		box-sizing: border-box;
		font-size: 1em;
		font-family: 'Space Grotesk', sans-serif;
	}
    body{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #main-logo{
        opacity: 0.5;
        width: 50%;
        min-width: 60vw;
        margin-top: 25vh;
        pointer-events: none;
        position: absolute;
        z-index: -1;
    }
	.credentials-container{
		display: flex;
        width: 40vw;
		flex-direction: column;
		margin-top: 30vh;
        margin-left: auto;
	}
	.instagram-container{
		width: 100%;
		max-width: 350px;
		margin: auto;
		/* border: 1px solid #ccc; */
		margin-top: 15px;
		padding: 5px;
		border-radius: 5px;
		box-shadow: 5.6px 11.2px 11.2px hsl(0deg 0% 0% / 0.33);
		background-color: #F6F6F6;
	}
	.instagram-logo{
		width: 100%;
		max-width: 400px;
		margin: auto;
		margin-top: 10px;
		/* align-content: center; */
	}
	.instagram-logo img{
		width: 100%;
		object-fit: cover;
	}
	.instagram-container-inside{
		padding: 25px;
	}
	.instagram-container-inside button{
		width: 100%;
		padding: 8px;
		margin: 8px;
		border: none;
		font-size: 12px;
		color: #111111;
		background-color: #FFCB74;
		border-radius: 5px;
		cursor: pointer;
		box-shadow: 0.8px 1.6px 1.6px hsl(0deg 0% 0% / 0.48);
	}
	.instagram-container-inside h5{
		color: #111111;
		text-align: center;
		margin-bottom: 10px;
		margin-top: 10px;
	}
	.or{
		display: flex;
		justify-content: center;
		align-items: center;
	}
</style>
<body>
    <img id="main-logo" src="../media/logos/Camagru-logos_textAndCat2_black.png" alt="">
    <div class="credentials-container">

        <!-- sign up container box -->
        <div class="instagram-container">
            
            <!--website logo  -->
            <div class="instagram-logo">
                <img src="../media/logos/Camagru-logos_sideBySide_black.png" alt="brand logo">
            </div>
                <!-- container for the user entry elements -->
                <div class="instagram-container-inside">

                    <!-- Sign in button tag -->
                    <button onclick="location.href='signin.php'">Sign In</button>
                    
                    <!-- the word or surrounded by 2 horizontal lines -->
                    <div class="or">
                        <hr style="width:30%; margin: 10px; opacity: 0.3;">
                        <h5 style="opacity: 0.5;">OR</h5>
                        <hr style="width:30%; margin: 10px; opacity: 0.3;">
                    </div>
                    <button onclick="location.href='signup.php'">Sign Up</button>
                </div>
        </div>

    </div>
</body>
</html>