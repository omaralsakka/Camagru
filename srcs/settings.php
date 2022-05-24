<?php
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
        <div class="settings-container">
            <div class="setting-container checkbox">
                <img class="setting-img" src="../media/icons/icons8-notification-96.png" alt="">
                <label for="myCheck">Email notifications:</label> 
                <input type="checkbox" id="myCheck" onclick="emailNotification()">
            </div>
            <hr>
            <div class="setting-container">
                <img class="setting-img" src="../media/icons/icons8-change-name.png" alt="">
                <button class="change-name-btn">Change full name</button>
            </div>
            <hr>
            <div class="setting-container">
                <img class="setting-img" src="../media/icons/icons8-change-email.png" alt="">
                <button class="change-email-btn">Change email</button>
            </div>
            <hr>
            <div class="setting-container">
                <img class="setting-img" src="../media/icons/icons8-change-pass.png" alt="">
                <button class="change-pass-btn">Change password</button>
            </div>
            <hr>
            <div class="setting-container">
                <img class="setting-img" src="../media/icons/icons8-remove-user-64.png" alt="">
                <button class="delete-account-btn">Delete account</button>
            </div>
        </div>
    </div>

</body>
<script>

    function emailNotification() {
        var checkBox = document.getElementById("myCheck");
        var text = document.getElementById("text");
        if (checkBox.checked == true){
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
}
</script>
</html>