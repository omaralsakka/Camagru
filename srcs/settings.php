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
            <button class="change-name-btn">Change Fullname</button>
            <button class="change-pass-btn">Change password</button>
            <div class="notification-container">
                <label for="myCheck">Email notifications:</label> 
                <input type="checkbox" id="myCheck" onclick="emailNotification()">
            </div>
            <button class="delete-account-btn">Delete account</button>
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