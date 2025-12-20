<?php
require_once "config/db.php";
require_once "includes/functions.php";
include "includes/header.php";
?>

<p><?php echo escape("<b>Welcome</b> to Retail Store Manager"); ?></p>

<p>
Stock Test:
<?php
echo isLowStock(2) ? "Low Stock ⚠️" : "Stock OK";
?>
</p>

<?php
include "includes/footer.php";
?>
