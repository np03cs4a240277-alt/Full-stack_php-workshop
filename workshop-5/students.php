<?php
// Include header
include 'header.php';
?>

<h2>View Students</h2>

<?php
// Read students.txt and display
if (file_exists('students.txt')) {
    $lines = file('students.txt'); // Read file into array of lines
    if (!empty($lines)) {
        echo "<ul>";
        foreach ($lines as $line) {
            $parts = explode(',', trim($line)); // Split by comma
            if (count($parts) >= 3) {
                $name = $parts[0];
                $email = $parts[1];
                $skills = array_slice($parts, 2); // Rest are skills
                echo "<li><strong>Name:</strong> $name<br>";
                echo "<strong>Email:</strong> $email<br>";
                echo "<strong>Skills:</strong> " . implode(', ', $skills) . "</li><br>"; // Display as comma-separated
            }
        }
        echo "</ul>";
    } else {
        echo "<p>No students added yet.</p>";
    }
} else {
    echo "<p>No students file found.</p>";
}
?>

<?php
// Include footer
include 'footer.php';
?>