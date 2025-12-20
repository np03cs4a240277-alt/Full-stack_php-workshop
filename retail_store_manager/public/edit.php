<?php
// Show errors (development only)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include required files
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

// Check if ID is present
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Invalid product ID.");
}

$id = $_GET['id'];
$errors = [];
$success = "";

// Fetch existing product
$sql = "SELECT * FROM products WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Product not found.");
}

// Set default values
$product_name = $product['product_name'];
$supplier_name = $product['supplier_name'];
$price = $product['price'];
$stock = $product['stock'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $product_name = trim($_POST["product_name"] ?? "");
    $supplier_name = trim($_POST["supplier_name"] ?? "");
    $price = trim($_POST["price"] ?? "");
    $stock = trim($_POST["stock"] ?? "");

    // Validation
    if ($product_name === "") {
        $errors[] = "Product name is required.";
    }

    if ($supplier_name === "") {
        $errors[] = "Supplier name is required.";
    }

    if ($price === "" || !is_numeric($price) || $price <= 0) {
        $errors[] = "Price must be a positive number.";
    }

    if ($stock === "" || !ctype_digit($stock) || $stock < 0) {
        $errors[] = "Stock must be a valid number.";
    }

    // Update database
    if (empty($errors)) {
        $updateSql = "UPDATE products SET
                        product_name = :product_name,
                        supplier_name = :supplier_name,
                        price = :price,
                        stock = :stock
                      WHERE id = :id";

        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([
            ':product_name' => $product_name,
            ':supplier_name' => $supplier_name,
            ':price' => $price,
            ':stock' => $stock,
            ':id' => $id
        ]);

        $success = "Product updated successfully!";
    }
}
?>

<h2>Edit Product</h2>

<?php if (!empty($errors)): ?>
    <div style="color:red;">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo escape($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if ($success): ?>
    <p style="color:green;"><?php echo escape($success); ?></p>
<?php endif; ?>

<form method="post">
    <label>Product Name:</label><br>
    <input type="text" name="product_name"
           value="<?php echo escape($product_name); ?>" required><br><br>

    <label>Supplier Name:</label><br>
    <input type="text" name="supplier_name"
           value="<?php echo escape($supplier_name); ?>" required><br><br>

    <label>Price:</label><br>
    <input type="number" step="0.01" name="price"
           value="<?php echo escape($price); ?>" required><br><br>

    <label>Stock Quantity:</label><br>
    <input type="number" name="stock"
           value="<?php echo escape($stock); ?>" required><br><br>

    <button type="submit">Update Product</button>
</form>

<p>
    <a href="index.php">← Back to Product List</a>
</p>

<?php include "../includes/footer.php"; ?>
