<?php

    error_reporting(0);

    session_start();
    // require_once('settings-action.php');
?>

<!DOCTYPE html>
<head>
    <title>Settings</title>
    <?php include_once('../frontend/head.html')?>
    <link rel="stylesheet" href="../style/settings-page.css">
</head>
<body>
    <?php include_once('../frontend/navbar.php')?>
    
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
            <form class="settings-form" action="settings-action.php" method="post">
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
            </form>
        </div>

        <div class="new-inputs new-username">
            <form class="settings-form" action="settings-action.php" method="post" onsubmit="return checkUserName()">
                <input id="new-user-name" class="text-input" type="text" name="new_username" placeholder=" New username" required>
                <button class="submit-btn" type="submit" name="change_username">Submit</button>
            </form>
        </div>

        <div class="new-inputs new-name">
            <form class="settings-form" action="settings-action.php" method="post" onsubmit="return checkFullName()">
                <input id="new-full-name" class="text-input" type="text" name="new_name" placeholder=" New Full name" required>
                <button class="submit-btn" type="submit" name="change_name">Submit</button>
            </form>
        </div>

        <div class="new-inputs new-email">
            <form class="settings-form" action="settings-action.php" method="post" onsubmit="return checkEmail()">
                <input id="new-user-email" class="text-input" type="email" name="new_email" placeholder=" New Email Address" required>
                <button class="submit-btn" type="submit" name="change_email">Submit</button>
            </form>
        </div>

        <div class="new-inputs new-pass">
            <form class="settings-form" action="settings-action.php" method="post" onsubmit="return checkPassword()">
                <input id="new-user-password" class="text-input" type="password" name="new_pass" placeholder="New Password" required>
                <button class="submit-btn" type="submit" name="change_pass">Submit</button>
            </form>
        </div>

        <div class="new-inputs delete-account">
            <form class="settings-form" action="settings-action.php" method="post">
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
    let msg = document.querySelector(".error_msg");
    let format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
    function displayInput(className){
        let newNameContainer = document.querySelector('.'+className);
        newNameContainer.style.display = 'flex';
        
        // to hide element when clicked outside the box
        document.addEventListener('mouseup', function(e){
            if (!newNameContainer.contains(e.target)){
                newNameContainer.style.display = 'none';
            }
        })
    }

    function hasWhiteSpace(s) {
        return /\s/g.test(s);
    }

    function checkUserName(){
        let newUserName = document.getElementById('new-user-name').value;
        if (format.test(newUserName) || hasWhiteSpace(newUserName)){
            msg.innerHTML = "username can contain letters only";
            return (false);
        } else
            return (true);
    }

    function checkFullName(){
        let newFullName = document.getElementById('new-full-name').value;
        if (hasWhiteSpace(newFullName)){
            msg.innerHTML = "Fullname can contain letters only";
            return (false);
        } else
            return (true);
    }

    function checkEmail(){
        let newEmail = document.getElementById('new-user-email').value;
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(newEmail))
        {
            return (true)
        }
            msg.innerHTML = "Email invalid";
            return (false)
    }

    function checkPassword(){
        let newPass = document.getElementById('new-user-password').value;
        let passRule = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
        if (format.test(newPass) || !newPass.match(passRule)){
            msg.innerHTML = "Password must contain at least 1 lowercase, 1 uppercase letter and one number\
            <br>No special characters";
            return (false);
        } else
            return (true);
    }
</script>
<footer>
	<hr>
	<i>© oabdelfa camagru 2022  </i>
</footer>
</html>