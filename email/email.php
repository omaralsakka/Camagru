<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

$to = "djomrofficial@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = 'From: djomrofficial@gmail.com' . "\r\n" .
    'Reply-To: djomrofficial@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$res = mail($to,$subject,$txt,$headers);
if ($res){
    echo "Email Sent Succesfully<br>";
} else {
    echo "Error!<br>";
}
?>