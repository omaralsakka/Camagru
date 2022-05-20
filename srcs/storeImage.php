<?php
// $img = $_POST['image'];

// print_r($_POST);
// header('Content-Type: image/png');
// echo $img;
// $img = file_get_contents(($_POST['image']));
if (isset($_POST['image'])){

$baseFromJavascript = $_POST['image'];
$data = base64_decode(preg_replace('#^data:image/w+;base64,#i', '', $baseFromJavascript));
$filepath = "./upload/image.png";
file_put_contents($filepath,$data);

echo $baseFromJavascript;
} else {
    echo 'failed to post';
}


// echo "<img src ='".$img."' />";
?>