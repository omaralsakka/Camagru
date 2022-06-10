<?php

error_reporting(0);

session_start();

require_once('../config/database.php');
require_once('security_functions.php');
if ($_SESSION['nwpass'] == 2){
    if (isset($_POST['submit-forgot'])){
        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['new-password'])){
            $message = "<h6 class='error-msg'>"."Password should contain only letters and numbers"."<h6>";
        }
    
        else if (!validate_password($_POST['new-password'])){
            $message = "<h6 class='error-msg'>"."Password should contain at least 1 lowercase letter, 1 uppercase letter 1 number and length of 8"."<h6>";
        }

        else {
            $new_pass = hash('whirlpool', $_POST['new-password']);
            $username = $_GET['username'];
            $password_query = $dbh->prepare
            ("UPDATE `user` SET `password` = '$new_pass' WHERE `username` = '$username';
            DELETE FROM `forgot_pass` WHERE `username` = '$username'");
            $password_query->execute();
            $_SESSION['nwpass'] = 0;
            header('location: signin.php?msg=nwpass');
        }
    }

} else {
    header('location:../index.php');
}

?>

<!DOCTYPE html>
<head>
    <?php include_once('../frontend/head.html')?>
    <title>Reset Password</title>
<style>

    .middle-container{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-top: 5vh;
        width: 100%;
        height: 80vh;
        padding: 5vh;
    }

    #main-logo{
        opacity: 0.5;
        width: 40vw;
        min-width: 20vw;
        margin-left: -30vw;
        pointer-events: none;
        position: absolute;
        z-index: -1;
    }
    .forgot-popup{
        display: flex;
        justify-content: center;
        flex-direction: column;
        position: fixed;
        align-items: center;
        width: 25vw;
        padding: 5vh;
        background-image: url('../media/122\ Cheerful\ Caramel.png');
        border: none;
        border-radius: 20px;
        box-shadow: 0 0 0 100vmax rgba(0, 0, 0, 0.164);
    }
    .forgot-form{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .forgot-popup input{
        margin-top: 2vh;
        border: none;
        border-radius: 10px;
        width: 10vw;
        padding: 1vh;
    }
    .forgot-form button{
        margin: 2vh auto;
        padding: 1vh;
        font-size: 0.7vw;
        border: none;
        border-radius: 20px;
        background-image: url('../media/007\ Sunny\ Morning.png');
        box-shadow: hsl(0deg 0% 0% / 0.33) 4px 4px 0px;
        transition: transform 200ms, box-shadow 200ms;
    }
    .forgot-form button:hover{
        transform: scale(1.09);
    }
    .forgot-form button:active{
        transform: translateY(4px) translateX(4px);
        box-shadow: hsl(0deg 0% 0% / 0.33) 0px 0px 0px;
    }
    .message-txt{
        background-color: yellow;
        width: 20vw;
        height: 25vh;
    }
    .error-msg{
        text-align: center;
        color: red;
        font-size: 18px;
        margin-bottom: 2vh;
    }
</style>
</head>
<body>
    <div class="middle-container">
        <img id="main-logo" src="../media/logos/Camagru-logos_textAndCat2_black.png" alt="">
        <div class="forgot-popup">
            <?php echo $message;?>
        	<p class="popup-text">Please enter your new password</p>
        	<form class="forgot-form" action="" method="post">
                <input type="password" name="new-password">
                <input type="hidden" name="email" value="<?php echo $_GET['username']?>">
        		<button type="submit" name="submit-forgot">Submit</button>
        	</form>
        </div>
    </div>
</body>
<footer>
	<hr>
	<i>© oabdelfa camagru 2022  </i>
</footer>
</html>