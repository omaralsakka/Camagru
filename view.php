<?php

$dbh = new PDO("mysql:host=localhost;dbname=mydata", "root", "123456");
$id = isset($_GET['id'])? $_GET['id'] : "";
$stat = $dbh->prepare("SELECT * FROM myblob WHERE id=?");
$stat->bindParam(1, $id);
$stat->execute();
$row = $stat->fetch();
header('Content-type:' .$row['mime']);
echo $row['data'];
?>