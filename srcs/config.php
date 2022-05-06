<?php
require_once('database.php');
// connecting to database with localhost, as user root, no password given for now,
// and connecting to database named camagru_website.
// $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
// if(isset($_POST['submit'])){
// 	$sql = file_get_contents('struct.sql');
// 	$qr = $db->exec($sql);
// 	echo "Done !<br><br>";
// }
$connection = mysqli_connect("localhost","root","123456","camagru_website");

// if connection to database successed will print success, else print error, 
// needed only when debugging
// if($connection){
// 	echo "SUCCESS: database connected\n";
// 	echo $connection->host_info;
// } else {
// 	exit();
// 	echo "ERROR: database not connected";
// }
?>