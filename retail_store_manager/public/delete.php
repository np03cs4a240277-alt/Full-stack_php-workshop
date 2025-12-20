<?php
// Show errors (development only)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database
require_once "../config/db.php";

// Check if ID exists and is valid
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Invalid product ID.");
}

$id = $_GET['id'];

// Delete using prepared statement
$sql = "DELETE FROM products WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

// Redirect to homepage
header("Location: index.php");
exit;
