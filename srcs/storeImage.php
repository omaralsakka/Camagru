<?php

session_start();

require_once('../config/database.php');

$username = $_SESSION['username'];

if (isset($_POST['image'])){

$image = $_POST['image'];
$image = preg_replace("/data:image\/jpeg;base64,/", '', $image);
$image = str_replace(' ', '+', $image);

$image = base64_decode($image);

$type = 'data:image/jpeg;base64,';
$stmt = $dbh->prepare("INSERT INTO user_images(`username`, `type`, `content`) 
VALUES (:username, :type, :content)");

$stmt->bindParam('username',$username);
$stmt->bindParam('type',$type);
$stmt->bindParam('content',$image);
$stmt->execute();

echo $type.base64_encode($image);

} else {
    echo 'failed to post';
}


?>