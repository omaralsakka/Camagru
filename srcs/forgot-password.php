<?php

if(isset($_GET['email']) && isset($_GET['code'])){
    if (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL))
        header('location:../index.php');
    else if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_GET['code']))
        header('location:../index.php');
    
    
}


else {

    header('location:../index.php');

}

?>