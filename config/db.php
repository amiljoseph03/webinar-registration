<?php
$host = "localhost";
$dbname = "crypto-register";
$user = "root";
$pass = "";   

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // If we reached here without an exception, the connection is successful
    // We echo "success" here
    // echo "Database connection: success";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

} catch (PDOException $e) {
    // If connection fails, this catch block runs
    die("Database connection failed: " . $e->getMessage());
}
?>