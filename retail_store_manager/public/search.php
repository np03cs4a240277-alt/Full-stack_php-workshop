<?php
// Show errors (development only)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include required files
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

// Initialize variables
$supplier = "";
$min_price = "";
$max_price = "";
$products = [];

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] === "GET" && !empty($_GET)) {

    $supplier = trim($_GET['supplier'] ?? "");
    $min_price = trim($_GET['min_price'] ?? "");
    $max_price = trim($_GET['max_price'] ?? "");

    // Base SQL
    $sql = "SELECT * FROM products WHERE 1=1";
    $params = [];

    // Supplier filter
    if ($supplier !== "") {
        $sql .= " AND supplier_name LIKE :supplier";
        $params[':supplier'] = "%" . $supplier . "%";
    }

    // Minimum price filter
    if ($min_price !== "" && is_numeric($min_price)) {
        $sql .= " AND price >= :min_price";
        $params[':min_price'] = $min_price;
    }

    // Maximum price filter
    if ($max_price !== "" && is_numeric($max_price)) {
        $sql .= " AND price <= :max_price";
        $params[':max_price'] = $max_price;
    }

    // Execute prepared statement
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<h2>Search Products</h2>
<form method="get">
    <label>Supplier Name:</label><br>
    <input type="text" name="supplier" id="supplier" autocomplete="off"
           value="<?php echo escape($supplier); ?>"><br>
    <div id="autocomplete-list" style="border:1px solid #ccc; max-width:400px;"></div><br>

    <label>Min Price:</label><br>
    <input type="number" step="0.01" name="min_price" value="<?php echo escape($min_price); ?>"><br><br>

    <label>Max Price:</label><br>
    <input type="number" step="0.01" name="max_price" value="<?php echo escape($max_price); ?>"><br><br>

    <button type="submit">Search</button>
</form>


<?php if (!empty($products)): ?>
    <h3>Search Results</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>Product</th>
            <th>Supplier</th>
            <th>Price</th>
            <th>Stock</th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo escape($product['product_name']); ?></td>
                <td><?php echo escape($product['supplier_name']); ?></td>
                <td>Rs. <?php echo escape($product['price']); ?></td>
                <td><?php echo escape($product['stock']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php elseif ($_SERVER["REQUEST_METHOD"] === "GET" && !empty($_GET)): ?>
    <p>No products found.</p>
<?php endif; ?>

<script src="assets/js/autocomplete.js"></script>
<?php include "../includes/footer.php"; ?>
