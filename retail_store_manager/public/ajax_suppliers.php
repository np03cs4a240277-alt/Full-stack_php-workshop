<?php
require_once "../config/db.php";

$term = trim($_GET['term'] ?? "");

if ($term === "") {
    echo json_encode([]);
    exit;
}

$sql = "SELECT DISTINCT supplier_name 
        FROM products 
        WHERE supplier_name LIKE :term 
        LIMIT 10";

$stmt = $pdo->prepare($sql);
$stmt->execute([':term' => '%' . $term . '%']);

$suppliers = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($suppliers);
