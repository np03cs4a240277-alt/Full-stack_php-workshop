<?php
// Database details
$host = "localhost";
$dbname = "school_db";
$username = "root";
$password = "";

// Try to connect to database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Database connected successfully";
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
