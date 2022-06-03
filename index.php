<!-- This is the entry file for the application. It starts by sending the
user to the sign up page. Incase the user has an account, there is a bottom
option to log in and leads to signin.php file -->

<?php

include("./srcs/setup.php");
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
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="#">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600&display=swap" rel="stylesheet"> 
<link rel="stylesheet" href="./style/style.css">
<link rel="stylesheet" href="./style/index-page.css">
<style>
	body{
		display: block;
	}
	#loader {
		width: 20vw;
		min-width: 200px;
		height: 40vh;
		animation: loading 2s ease 0s infinite normal forwards;
	}
	@keyframes loading {
		0% {
			transform: rotate(0);
		}
		100% {
			transform: rotate(360deg);
		}
	}
	.center {
		position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
	}

	#loading-img{
		width: 100%;
	}

</style>
</head>
<div id="loader" class="center">
	<img id="loading-img" src="./media/logos/Camagru-logos_initialAndCat_black.png" alt="loading image">
</div>
<body>
	<img id="main-logo" src="./media/logos/Camagru-logos_textAndCat2_black.png" alt="">
	<div class="main-container">
		<div class="gallery">
			<?php
				// block to be a page 
				$block = 1;
				while($row = $image_query->fetch()){
					$type = $row['type'];
					$content = base64_encode($row['content']);
					
					if ($idx == 1){
						echo "
							<div class='gallery-block' id='page".$block."'>
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
						// full block done
						$block++;
					}
				}
				if ($idx != 1 && $idx < 7){
					while ($idx < 7){
						if ($idx % 2 == 0)
							echo "<img class='img".$idx."' src='./media/logos/Camagru-logos_initialAndCat_black.png' style='width:80%;'>";
						else
							echo "<img class='img".$idx."' src='./media/logos/Camagru-intialAndCat_white.png' style='width:80%;'>";
						$idx++;
					}
					echo "</div>";
				}
			?>
			    <div class="pages-selector-container">
					<div class="pagination-buttons">
						<?php
							for ($k = 1; $k < ($block + 1); $k++){
								if ($k == 1){
									echo '
										<a class="active" id="button'.$k.'" href="#" onclick="showPages('.$k.', '.$block.')">'.$k.'</a>
									';
								} else{
									echo '
										<a id="button'.$k.'" href="#" onclick="showPages('.$k.', '.$block.')">'.$k.'</a>
									';
								}
							}
						?>
					</div>
				</div>
			</div>
			
			<!-- This slogan only visible when the gallery is empty -->
			<div class="slogan">
				<span class="slogan-text">Here starts <br>Your fun journy <br>With your friends!</span>
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
	<script>
		document.onreadystatechange = function () {
			if (document.readyState != "complete"){
				document.querySelector("#main-logo").style.display = "none";
				document.querySelector(".main-container").style.display = "none";
				document.querySelector("#loader").style.visibility = "visible";
			} else {
				document.querySelector("#loader").remove();
				document.querySelector("#main-logo").style.display = "block";
				document.querySelector(".main-container").style.display = "flex";
				
				let checkImg = document.querySelector(".img");
				let gallery = document.querySelector(".gallery");
				let sloganText = document.querySelector(".slogan");
				
				if (!gallery.contains(checkImg)){
					gallery.style.display = "none";
					sloganText.style.display = "flex";
				} else {
					gallery.style.display = "flex";
					sloganText.style.display = "none";
				}
			}
		};

		function showPages(id, numberOfPages){

			for(let i=1; i<=numberOfPages; i++){

				if (document.getElementById('page'+i)) {
					document.getElementById('page'+i).style.display='none';
					document.getElementById('button'+i).classList.remove("active");
				}
			}
			if (document.getElementById('page'+id)) {
				let block = document.getElementById('page'+id);
				let activeLink = document.getElementById('button'+id);
				block.style.display='grid';
				activeLink.classList.add("active");
			}
        };
	</script>
</body>
<footer>
	<hr>
	<i>© oabdelfa camagru 2022  </i>
</footer>
</html>