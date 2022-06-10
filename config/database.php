<?php

$DB_BASE = 'camagru_website';
$DB_DSN = 'mysql:host=localhost;dbname='.$DB_BASE;
$DB_USER = 'root';
$DB_PASSWORD = '123456';
$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

?>