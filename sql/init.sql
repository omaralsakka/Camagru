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

-- Creating the images table ---------------
CREATE TABLE IF NOT EXISTS camagru_website.`user_images` (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(150) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `type` VARCHAR(255) NOT NULL,
  `data` LONGBLOB NOT NULL
  );