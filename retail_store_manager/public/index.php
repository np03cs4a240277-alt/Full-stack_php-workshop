<?php
// Show errors (ONLY for development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include required files
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

// Fetch products using prepared statement
$sql = "SELECT * FROM products ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Product List</h2>

<?php if (count($products) === 0): ?>
    <p>No products found.</p>
<?php else: ?>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Supplier</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo escape($product['id']); ?></td>
            <td><?php echo escape($product['product_name']); ?></td>
            <td><?php echo escape($product['supplier_name']); ?></td>
            <td>Rs. <?php echo escape($product['price']); ?></td>
            <td><?php echo escape($product['stock']); ?></td>
            <td>
                <?php if (isLowStock($product['stock'])): ?>
                    <span style="color:red; font-weight:bold;">LOW STOCK</span>
                <?php else: ?>
                    <span style="color:green;">OK</span>
                <?php endif; ?>
            </td>
            <td>
                <a href="edit.php?id=<?php echo $product['id']; ?>">Edit</a> |
                <a href="delete.php?id=<?php echo $product['id']; ?>"
                   onclick="return confirm('Are you sure you want to delete this product?');">
                   Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?php endif; ?>

<?php include "../includes/footer.php"; ?>
