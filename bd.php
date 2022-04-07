<?php

$servername = "localhost";
$username = "root";
$password = "";
$port = 8889;
$message = "";
$grettings = "Hello ";
try {
    $conn = new PDO("mysql:host=$servername;dbname=tp_php", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $message = "Connected successfully";
    //echo $message;
} catch (PDOException $e) {
    $message = "Connection failed: " . $e->getMessage();
    //echo $message;
}

?>