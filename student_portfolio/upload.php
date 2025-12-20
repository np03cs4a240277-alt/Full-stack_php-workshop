<?php
include 'includes/header.php';
include 'functions/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (!isset($_FILES['portfolio'])) throw new Exception("No file selected.");
        $path = uploadPortfolioFile($_FILES['portfolio']);
        $successMsg = "File uploaded successfully: $path";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<h2>Upload Portfolio File</h2>

<?php if (!empty($successMsg)) echo "<p class='success'>$successMsg</p>"; ?>
<?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

<form method="post" enctype="multipart/form-data">
    <label>Select File (PDF, JPG, PNG, max 2MB):</label><br>
    <input type="file" name="portfolio"><br><br>
    <input type="submit" value="Upload">
</form>

<?php include 'includes/footer.php'; ?>
