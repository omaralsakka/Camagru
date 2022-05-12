<?php
	// //get current directory
	// $working_dir = getcwd();
	
	// //get image directory
	// $img_dir = "../media/filters";
	
	// //change current directory to image directory
	// chdir($img_dir);
	
	// //using glob() function get images 
	// $files = glob("*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}", GLOB_BRACE );
	
	// //again change the directory to working directory
	// chdir($working_dir);

	//iterate over image files

    if (isset($_GET['filter'])){
        echo "<h1>Success</h1>";
    }
    
    if (isset($_POST['filter']))
    {
        echo $_POST['filter'];
        echo "<h1>Success</h1>";
    }
    
    // if (isset($_POST['base64image'])){
    //     echo "<img src=".$_POST['base64image']."> <h1>".$_POST['filter']."</h1>";
    // }
    // if (isset($_POST['filter'])){
    //     echo "<h1>".$_POST['filter']."</h1>";
    // }
        
?>