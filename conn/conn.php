<?php

$servername = "localhost";
$username = "root";
$password = "allin1server";
$db = "finance";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "";
} catch (PDOException $e) {
    echo "Failed" . $e->getMessage();
}
