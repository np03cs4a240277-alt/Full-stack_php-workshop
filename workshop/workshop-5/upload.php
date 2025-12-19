<?php
// Include header
include 'header.php';

// Custom function for upload
function uploadPortfolioFile($file) {
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png']; // MIME types
    $maxSize = 2 * 1024 * 1024; // 2MB in bytes
    $uploadDir = 'uploads/'; // Directory to save files

    // Check if file was uploaded
    if (!isset($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("File upload failed.");
    }

    // Check file type
    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception("Only PDF, JPG, or PNG files are allowed.");
    }

    // Check file size
    if ($file['size'] > $maxSize) {
        throw new Exception("File size must be less than 2MB.");
    }

    // Rename file (e.g., use timestamp + original name, but clean it)
    $originalName = basename($file['name']);
    $newName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $originalName); // Remove special chars
    $targetPath = $uploadDir . $newName;

    // Move file to uploads directory
    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        throw new Exception("Failed to save file.");
    }

    return $newName; // Return new filename
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $uploadedFile = uploadPortfolioFile($_FILES['portfolio']);
        echo "<p style='color: green;'>File uploaded successfully as: $uploadedFile</p>";
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
    }
}
?>

<h2>Upload Portfolio File</h2>
<p>Allowed: PDF, JPG, PNG. Max size: 2MB.</p>
<form method="POST" enctype="multipart/form-data">
    <label>Select File: <input type="file" name="portfolio" required></label><br><br>
    <button type="submit">Upload</button>
</form>

<?php
// Include footer
include 'footer.php';
?>