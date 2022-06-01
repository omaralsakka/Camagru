<?php

    session_start();
    require_once('config.php');
    if (!$_SESSION['verify'] && !$_SESSION['nwpass']){
        header('location:../index.php');
    };

    if (isset($_POST['submit-verify'])){
        $code = $_POST['code'];
        
        if ($_SESSION['verify']){
            $code_q = $dbh->prepare("SELECT * FROM `user_verify` WHERE `code` = '$code'");
            $code_q->execute();
            $code_result = $code_q->fetch();
            if (!$code_result['username'])
                $message = "<h6>Incorrect code!</h6>";
            else{
                $_SESSION['verify'] = 0;
                header("location: signin.php?code=".$code);
            }  
        }
        else if ($_SESSION['nwpass']){
            $forgot_q = $dbh->prepare("SELECT * FROM `forgot_pass` WHERE `code` = '$code'");
            $forgot_q->execute();
            $forgot_result = $forgot_q->fetch();
            
            if (!$forgot_result['username'])
                $message = "<h6>Incorrect code!</h6>";
            else{
                $_SESSION['nwpass'] = 2;
                header("location: forgot-password.php?username=".$forgot_result['username']);
            }
        }
    }
    // header("refresh:10;url=../index.php");
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
            <?php echo $message?>
            <h1 class="message">Please enter your verification code and click submit</h1><br>
            <form action="" method="post">
                <input type="number" name="code">
                <button value="submit" name="submit-verify">Submit your code</button>
            </form>
        </div>
    </div>
</body>
<footer>
	<hr>
	<i>© oabdelfa camagru 2022  </i>
</footer>
</html>

