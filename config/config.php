<?php
    $host = "localhost";
    $dbname = "forum_db";
    $username = "root"; // sesuaikan dengan MySQL kamu
    $password = "";     // sesuaikan dengan MySQL kamu

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
?>
