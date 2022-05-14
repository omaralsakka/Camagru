<?php

// if global Get variable have the key name set within it, we will respond with the value
// within a welcome sentence
if (isset($_GET['name'])){
    echo "Hello ".$_GET['name']." This is Get Method<br>
    You are ".$_GET['age']." years old";
}

// same as get, but using Post global variable this time.
if (isset($_POST['name'])){
    echo "Hello ".$_POST['name']." This is Post Method<br>
    You are ".$_POST['age']." years old";
}

?>