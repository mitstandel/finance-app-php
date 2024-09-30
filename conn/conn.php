<?php

$servername = "localhost";
$username = "root";
$password = "MySQL2day@PC";
$db = "user_profile";

define('HASH', 'User2024Profile');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "";
} catch (PDOException $e) {
    echo "Failed" . $e->getMessage();
}
