-- Creating the database it self ---------------
CREATE DATABASE IF NOT EXISTS `camagru_website`;

-- Creating the user table ---------------
CREATE TABLE IF NOT EXISTS camagru_website.`user` (
  user_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(150) NOT NULL,
  fullname VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL,
  `password` VARCHAR(150) NOT NULL,
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );

-- Creating the verify user system table ---------------
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

-- Creating the images table ---------------
CREATE TABLE IF NOT EXISTS camagru_website.`user_images` (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(150) NOT NULL,
  `type` VARCHAR(255) NOT NULL,
  `content` LONGBLOB NOT NULL,
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );

-- Creating the comments table ---------------
CREATE TABLE IF NOT EXISTS camagru_website.`user_comments` (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  image_id INT(11) NOT NULL,
  username VARCHAR(150) NOT NULL,
  `comment` VARCHAR(1000) NOT NULL,
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );

-- Creating the likes table ---------------
CREATE TABLE IF NOT EXISTS camagru_website.`likes_table` (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  image_id INT(11) NOT NULL,
  username VARCHAR(150) NOT NULL,
  `like` INT DEFAULT 0 NOT NULL,
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );

-- Creating the forgot-pass table ---------------
CREATE TABLE IF NOT EXISTS camagru_website.`forgot_pass` (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(150) NOT NULL,
  `code` INT NOT NULL,
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );