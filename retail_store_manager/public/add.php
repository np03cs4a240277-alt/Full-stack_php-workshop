<?php
// Show errors (development only)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include required files
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

// Initialize variables
$product_name = $supplier_name = $price = $stock = "";
$errors = [];
$success = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get and trim input
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

    // If no errors, insert into database
    if (empty($errors)) {
        $sql = "INSERT INTO products 
                (product_name, supplier_name, price, stock)
                VALUES (:product_name, :supplier_name, :price, :stock)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":product_name" => $product_name,
            ":supplier_name" => $supplier_name,
            ":price" => $price,
            ":stock" => $stock
        ]);

        $success = "Product added successfully!";
        // Clear form
        $product_name = $supplier_name = $price = $stock = "";
    }
}
?>

<h2>Add New Product</h2>

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

<form method="post" action="">
    <label>Product Name:</label><br>
    <input type="text" name="product_name" value="<?php echo escape($product_name); ?>" required><br><br>

    <label>Supplier Name:</label><br>
    <input type="text" name="supplier_name" value="<?php echo escape($supplier_name); ?>" required><br><br>

    <label>Price:</label><br>
    <input type="number" step="0.01" name="price" value="<?php echo escape($price); ?>" required><br><br>

    <label>Stock Quantity:</label><br>
    <input type="number" name="stock" value="<?php echo escape($stock); ?>" required><br><br>

    <button type="submit">Add Product</button>
</form>

<?php include "../includes/footer.php"; ?>
