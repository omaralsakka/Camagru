<?php
require_once('database.php');
$connection = mysqli_connect("localhost","root","123456","camagru_website");
$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
?>