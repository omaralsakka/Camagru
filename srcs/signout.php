<!-- This file that makes the user signout -->

<?php

error_reporting(0);

// including the connection to mysql database file.
require_once('config.php');

// starting session to pass through server the user data.
session_start();

session_unset();

header('location:signin.php');

?>