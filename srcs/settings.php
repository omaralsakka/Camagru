<?php

    error_reporting(0);

    session_start();

    if(!isset($_SESSION['user_id'])){
        header('location:signin.php');
    } else {
        $username = $_SESSION['username'];
        require_once('./config.php');
        require_once('security_functions.php');
    }

    if (isset($_POST['notification_update'])){
        if ($_SESSION['notifications']){
            $notification_update = $dbh->prepare("UPDATE `user` SET `notifications` = 0 WHERE `username` = '$username'");
            $_SESSION['notifications'] = 0;
        } else {
            $notification_update = $dbh->prepare("UPDATE `user` SET `notifications` = 1 WHERE `username` = '$username'");
            $_SESSION['notifications'] = 1;
        }
        $notification_update->execute();
    }

    if (isset($_POST['change_username'])){
        
        if (!preg_match("/^[a-zA-Z]*$/", $_POST['change_username']))
		    $message = "Username can contain only letters";
        else {
            $new_username = validate_data ( $_POST['new_username'] );
            $check_username = $dbh->prepare("SELECT * FROM `user` WHERE `username` = '$new_username'");
            $check_username->execute();
            $checked = $check_username->fetch();
            if (!$checked['username']){
                $_POST = array();
                
                $username_query = $dbh->prepare ("UPDATE `user`, `user_images`, `user_comments` 
                SET `user`.`username` = '$new_username', `user_images`.`username` = '$new_username', `user_comments`.`username` = '$new_username'
                WHERE `user`.`username` = '$username' AND `user_images`.`username` = '$username' AND `user_comments`.`username` = '$username'");

                $username_query->execute();
                $_SESSION['username'] = $new_username;
            } else {
                $message = "Error: Username exist!";
            }
        }
    }

    if (isset($_POST['change_name'])){
        
        if (!preg_match("/^[a-zA-Z\s]+$/", $_POST['change_name']))
		    $message = "Fullname can contain only letters and spaces";
        else {
            $new_name = validate_data ( $_POST['new_name'] );
            $_POST = array();
            
            $name_query = $dbh->prepare("UPDATE `user` SET `fullname` = '$new_name' WHERE `username` = '$username'");
            $name_query->execute();
            $_SESSION['fullname'] = $new_name;
        }

    }

    if (isset($_POST['change_email'])){
        if (!filter_var($_POST['change_email'], FILTER_VALIDATE_EMAIL))
            $message = "Incorrect email!";
        else {
            $new_email = validate_data ( $_POST['new_email'] );
            $_POST = array();

            $email_query = $dbh->prepare("UPDATE `user` SET `email` = '$new_email' WHERE `username` = '$username'");
            $email_query->execute();
        }
    }

    if (isset($_POST['change_pass'])){
        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['new_pass'])){
            $message = "Password should contain only letters and numbers";
        }
        else if (!validate_password(($_POST['new_pass'])))
        {
            $message = "Password should contain at least 1 lowercase letter, 1 uppercase letter 1 number and length of 8";
        }
        else {
            $new_pass = validate_data ( $_POST['new_pass'] );
            $_POST = array();

            $pass_query = $dbh->prepare("UPDATE `user` SET `password` = '$new_pass' WHERE `username` = '$username'");
            $pass_query->execute();
        }
    }

    if (isset($_POST['delete_account'])){
        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['password']))
            $message = "Password should contain only letters and numbers";
            else {
            $user_pass = validate_data ( $_POST['password'] );
            $_POST = array();

            $check_pass = $dbh->prepare ("SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$user_pass'");
            $check_pass->execute();
            $user_info = $check_pass->fetch();

            if ($user_info['password'] == $user_pass){
                $delete_user = $dbh->prepare 
                ("DELETE FROM `user` WHERE `username` = '$username';
                DELETE FROM `user_images` WHERE `username` = '$username';
                DELETE FROM `user_comments` WHERE `username` = '$username'");

                $delete_user->execute();
                $_SESSION = array();
                header('location:index.php');
            }
            else {
                $message = "Incorrect Password!";
            }
        }
    }
?>

<!DOCTYPE html>
<head>
    <title>Settings</title>
    <?php include_once('../frontend/head.html')?>
    <link rel="stylesheet" href="../style/settings-page.css">
</head>
<body>
    <?php include_once('../frontend/navbar.html')?>
    
    <div class="main-container">
        
        <div class="error_msg">
            <?php echo $message?>
        </div>

        <!-- buttons and icons -->
        <div class="settings-container">
            <div class="setting-container">
                <img class="setting-img" src="../media/icons/icons8-notification-96.png" alt="">
                <button id="email-notifications" onclick="displayInput(this.id)">Email notifications</button>
            </div>
            
            <hr>

            <div class="setting-container">
                <img class="setting-img" src="../media/icons/icons8-username-100.png" alt="">
                <button id="new-username" onclick="displayInput(this.id)">Change username</button>
            </div>
            
            <hr>

            <div class="setting-container">
                <img class="setting-img" src="../media/icons/icons8-change-name.png" alt="">
                <button id="new-name" class="change-name-btn" onclick="displayInput(this.id)">Change full name</button>
            </div>

            <hr>
            
            <div class="setting-container">
                <img class="setting-img" src="../media/icons/icons8-change-email.png" alt="">
                <button id="new-email" class="change-email-btn" onclick="displayInput(this.id)">Change email</button>
            </div>
            
            <hr>

            <div class="setting-container">
                <img class="setting-img" src="../media/icons/icons8-change-pass.png" alt="">
                <button id="new-pass" class="change-pass-btn" onclick="displayInput(this.id)">Change password</button>
            </div>

            <hr>

            <div class="setting-container">
                <img class="setting-img" src="../media/icons/icons8-remove-user-64.png" alt="">
                <button id="delete-account" class="delete-account-btn" onclick="displayInput(this.id)">Delete account</button>
            </div>

        </div>

        <!-- pop-up input forms -->
        <div class="new-inputs email-notifications">
            <form class="settings-form" action="" method="post">
                <?php
                    if ($_SESSION['notifications']){
                        echo "<p class='notification-text'>Deactivate email notifications</p>";
                        echo "<button class='submit-btn' type='submit' name='notification_update'>Deactivate</button>";
                    }
                    else {
                        echo "<p class='notification-text'>Activate email notifications</p>";
                        echo "<button class='submit-btn' type='submit' name='notification_update'>Activate</button>";
                    }
                ?>
                <!-- <button class="submit-btn" type="submit" name="change_name">Submit</button> -->
            </form>
        </div>

        <div class="new-inputs new-username">
            <form class="settings-form" action="" method="post">
                <input class="text-input" type="text" name="new_username" placeholder=" New username" required>
                <button class="submit-btn" type="submit" name="change_username">Submit</button>
            </form>
        </div>

        <div class="new-inputs new-name">
            <form class="settings-form" action="" method="post">
                <input class="text-input" type="text" name="new_name" placeholder=" New Full name" required>
                <button class="submit-btn" type="submit" name="change_name">Submit</button>
            </form>
        </div>

        <div class="new-inputs new-email">
            <form class="settings-form" action="" method="post">
                <input class="text-input" type="email" name="new_email" placeholder=" New Email Address" required>
                <button class="submit-btn" type="submit" name="change_email">Submit</button>
            </form>
        </div>

        <div class="new-inputs new-pass">
            <form class="settings-form" action="" method="post">
                <input class="text-input" type="password" name="new_pass" placeholder="New Password" required>
                <button class="submit-btn" type="submit" name="change_pass">Submit</button>
            </form>
        </div>

        <div class="new-inputs delete-account">
            <form class="settings-form" action="" method="post">
                <div class="first-phrase">
                    <p>We hate to see you leave!</p>
                    <img src="../media/icons/icons8-sad-64.png" alt="">
                </div>
                <br></br>
                This action is irreversible, are you sure you want to delete your account?</p>
                <br></br>
                <input class="text-input" type="password" name="password" placeholder="Enter your password" required>
                <button class="submit-btn" type="submit" name="delete_account" style="color: red;">Confirm</button>
            </form>
        </div>

    </div>

</body>
<script>

    function displayInput(className){
        console.log(className);
        let newNameContainer = document.querySelector('.'+className);
        newNameContainer.style.display = 'flex';
        
        // to hide element when clicked outside the box
        document.addEventListener('mouseup', function(e){
            if (!newNameContainer.contains(e.target)){
                newNameContainer.style.display = 'none';
            }
        })
    }
</script>
</html>