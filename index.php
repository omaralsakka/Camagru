<!-- This is the entry file for the application. It starts by sending the
user to the sign up page. Incase the user has an account, there is a bottom
option to log in and leads to signin.php file -->

<?php

include("./srcs/database.php");
$DB_DSN_INIT = "mysql:host=localhost";
$sql = file_get_contents("./sql/init.sql");

try {

    // connect to the server
    $conn = new PDO($DB_DSN_INIT, $DB_USER, $DB_PASSWORD);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // execute the sql query
    $conn->exec($sql);
    
    // incase of error, write this message
} catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();

}

$conn = null;

include("./srcs/config.php");
$image_query = $dbh->prepare("SELECT * FROM user_images ORDER BY id DESC");
$image_query->execute();
$idx = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('./frontend/head.html')?>
    <link rel="stylesheet" href="./style/style.css">
	<link rel="stylesheet" href="./style/index-page.css">
</head>
<body>
	<img id="main-logo" src="./media/logos/Camagru-logos_textAndCat2_black.png" alt="">
	<div class="main-container">
		<div class="gallery">
			<?php
				while($row = $image_query->fetch()){
					$type = $row['type'];
					$content = base64_encode($row['content']);
					if ($idx == 1){
						echo "
							<div class='gallery-block'>
						";
					}
					echo "	
						<img class='img".$idx."' src='".$type.$content."'>
					";
					$idx++;
					if ($idx > 6){
						echo "
							</div>
						";
						$idx = 1;
					}
				}
			?>
		</div>

			<!-- sign up container box -->
			<div class="instagram-container">
				
				<!--website logo  -->
				<div class="instagram-logo">
					<img src="./media/logos/Camagru-logos_sideBySide_black.png" alt="brand logo">
				</div>
					<!-- container for the user entry elements -->
					<div class="instagram-container-inside">

						<!-- Sign in button tag -->
						<button onclick="location.href='./srcs/signin.php'">Sign In</button>
						
						<!-- the word or surrounded by 2 horizontal lines -->
						<div class="or">
							<hr style="width:30%; margin: 10px; opacity: 0.3;">
							<h5 style="opacity: 0.5;">OR</h5>
							<hr style="width:30%; margin: 10px; opacity: 0.3;">
						</div>
						<button onclick="location.href='./srcs/signup.php'">Sign Up</button>
					</div>
			</div>

		</div>
	</div>
</body>
</html>