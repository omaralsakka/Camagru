<!-- This file is responsible for creating the whole database scheme -->
<?php

$DB_DSN_INIT = "mysql:host=localhost";
$sql = file_get_contents("../sql/init.sql");
try {

    // connect to the server
    $conn = new PDO($DB_DSN_INIT, $DB_USER, $DB_PASSWORD);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // execute the sql query
    $conn->exec($sql);

    // incase of error, write this message
} catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();

}

$conn = null;

?>