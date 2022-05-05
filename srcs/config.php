<?php

// connecting to database with localhost, as user root, no password given for now,
// and connecting to database named camagru_website.
$connection = mysqli_connect("localhost","root","","camagru_website")or die(mysqli_error("Error"));

// if connection to database successed will print success, else print error, 
// needed only when debugging
// if($connection){
// 	echo "SUCCESS: database connected";
// } else {
// 	echo "ERROR: database not connected";
// }
?>