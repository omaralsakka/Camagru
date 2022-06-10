<!-- This file is responsible for creating the whole database scheme -->
<?php

$DB_DSN_INIT = "mysql:host=localhost";
$DB_USER = 'root';
$DB_PASSWORD = '123456';
$sql2 = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/sql/init.sql');
$sql = "
CREATE DATABASE IF NOT EXISTS `camagru_website`;
CREATE TABLE IF NOT EXISTS camagru_website.`user` (
  user_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(150) NOT NULL,
  fullname VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL,
  `password` VARCHAR(150) NOT NULL,
  `notifications` INT DEFAULT 1,
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );
CREATE TABLE IF NOT EXISTS camagru_website.`user_verify` (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(150) NOT NULL,
  fullname VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL,
  `password` VARCHAR(150) NOT NULL,
  `code` INT NOT NULL,
  `notifications` INT DEFAULT 1,
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );
CREATE TABLE IF NOT EXISTS camagru_website.`user_images` (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(150) NOT NULL,
  `image_name` VARCHAR(255) NOT NULL,
  `image` LONGBLOB NOT NULL,
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );
CREATE TABLE IF NOT EXISTS camagru_website.`user_comments` (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  image_id INT(11) NOT NULL,
  username VARCHAR(150) NOT NULL,
  `comment` VARCHAR(1000) NOT NULL,
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );
CREATE TABLE IF NOT EXISTS camagru_website.`likes_table` (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  image_id INT(11) NOT NULL,
  username VARCHAR(150) NOT NULL,
  `like` INT DEFAULT 0 NOT NULL,
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );
CREATE TABLE IF NOT EXISTS camagru_website.`forgot_pass` (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(150) NOT NULL,
  `code` INT NOT NULL,
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );
";
try {
    // connect to the server
    $conn = new PDO($DB_DSN_INIT, $DB_USER, $DB_PASSWORD);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // execute the sql query
    $conn->exec($sql2);

    // incase of error, write this message
} catch(PDOException $error){
    echo "PDO Opening error" . $sql . "<br>" . $error->getMessage();
}

$conn = null;

?>