<!-- This file that makes the user signout -->

<?php

error_reporting(0);

// including the connection to mysql database file.
require_once('config.php');

// starting session to pass through server the user data.
session_start();

// unsetting the session to signout the user
session_unset();

// lead the user to the sign in page
header('location:signin.php');

?>