<?php

session_start();

require_once('../config/database.php');

if (!isset($_SESSION['username']))
    header('location:signin.php');

$username = $_SESSION['username'];

if (isset($_POST['image'])){

    // prepared the image dataURL to be used as an image
$image = $_POST['image'];
$image = preg_replace("/data:image\/jpeg;base64,/", '', $image);
$image = str_replace(' ', '+', $image);
$image = base64_decode($image);

// created a temporary local file with the image data
$file = '../media/local_img_storage/' . uniqid() . '.jpeg';
$success = file_put_contents($file, $image);
$user_img = imagecreatefromjpeg($file);

if ($_POST['filter']){

    // created filter from the local path, then resized it to fit the user image.
    $filter_path = $_POST['filter'];
    $filter = imagecreatefrompng($filter_path);
    if (!$filter || !$image){
        echo "Error with filter selection or captured image";
        header('Refresh: 5; editing-page.php');
    }
    // $type = 'data:image/jpeg;base64,';
    $f_name = basename($filter_path);

    // If the filter from the frame group
    if ($f_name == 'f1.png' || $f_name == 'f5.png'){
        $filter_resized = imagecreate(imagesx($user_img), imagesy($user_img));
        imagecopyresized($filter_resized, $filter, 0, 0, 0, 0, imagesx($filter_resized), imagesy($filter_resized), imagesx($filter), imagesy($filter));
        imagecopy($user_img, $filter_resized, 0, 0, 0, 0, imagesx($filter_resized), imagesy($filter_resized));
    }

    // other type of filters
    else {
        $filter_resized = imagecreate(imagesx($user_img) - 250, imagesy($user_img) - 250);
        imagecopyresized($filter_resized, $filter, 0, 0, 0, 0, imagesx($filter_resized), imagesy($filter_resized), imagesx($filter), imagesy($filter));

        if ($f_name == 'f2.png' || $f_name == 'f4.png'){
            imagecopy($user_img, $filter_resized, 250, 0, 0, 0, imagesx($filter_resized), imagesy($filter_resized));
        }

        else if ($f_name == 'f3.png'){
            imagecopy($user_img, $filter_resized, 250, 250, 0, 0, imagesx($filter_resized), imagesy($filter_resized));
        }
        else if ($f_name == 'f8.png')
        imagecopy($user_img, $filter_resized, 120, 240, 0, 0, imagesx($filter_resized), imagesy($filter_resized));
    }
    imagedestroy($filter);
    imagedestroy($filter_resized);

}
// save the new merge into the local file
imagejpeg($user_img, $file, 100);

// destroyed all the image objects after the merging is done
imagedestroy($user_img);

$image_name = basename($file);
$save_img_q = $dbh->prepare("INSERT INTO user_images(`username`, `image_name`, `image`) 
VALUES (:username, :image_name, :file_name)");
$save_img_q->bindParam('username',$username);
$save_img_q->bindParam('image_name',$image_name);
$save_img_q->bindParam('file_name',$file);
$save_img_q->execute();

$fetch_img_q = $dbh->prepare("SELECT * FROM user_images WHERE `image_name` = '$image_name'");
$fetch_img_q->execute();
$get_img = $fetch_img_q->fetch();
echo $get_img['image'];
} else {
    echo 'Failed to receive the images';
    header('Refresh: 5; editing-page.php');
}

?>