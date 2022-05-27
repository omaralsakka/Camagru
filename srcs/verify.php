<?php

    session_start();
    
    if (!$_SESSION['verify']){
        header('location:../index.php');
    };
    header("refresh:10;url=../index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('../frontend/head.html')?>
    <title>Camagru</title>
</head>
<style>
        body{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #main-logo{
        opacity: 0.5;
        width: 50%;
        min-width: 60vw;
        margin-top: 25vh;
        pointer-events: none;
        position: absolute;
        z-index: -1;
    }
    .main-container{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        margin-top: 30vh;
        padding: 2vh;
        z-index: 1;
    }
    .text-part{
        display: flex;
        flex-direction: column;
        padding: 4vh;
        align-items: center;
        border: none;
        border-radius: 10px;
        box-shadow: 5.6px 11.2px 11.2px hsl(0deg 0% 0% / 0.33);
        background-image: url('../media/122 Cheerful Caramel.png');
    }
    .message{
        font-size: 1vw;
    }
</style>

<body>
    <img id="main-logo" src="../media/logos/Camagru-logos_textAndCat2_black.png" alt="">
    <div class="main-container">
        <div class="text-part">
            <h1 class="message">An activation code has been sent to your email</h1><br>
            <h1 class="message">Please check your email</h1>
        </div>
    </div>
</body>
</html>