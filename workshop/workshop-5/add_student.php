<?php
// Include header
include 'header.php';

// Custom functions (we define them here for simplicity)
function formatName($name) {
    // Capitalize the first letter of each word (e.g., "john doe" -> "John Doe")
    return ucwords(strtolower(trim($name)));
}

function validateEmail($email) {
    // Check if email is valid using PHP's built-in filter
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function cleanSkills($string) {
    // Remove extra spaces and split by comma, then trim each skill
    $skills = explode(',', $string); // Convert string to array
    $cleaned = [];
    foreach ($skills as $skill) {
        $cleaned[] = trim($skill); // Remove spaces around each skill
    }
    return $cleaned; // Return array
}

function saveStudent($name, $email, $skillsArray) {
    // Save to students.txt as a line: Name,Email,Skill1,Skill2,...
    $line = $name . ',' . $email . ',' . implode(',', $skillsArray) . "\n";
    file_put_contents('students.txt', $line, FILE_APPEND); // Append to file
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $skillsString = $_POST['skills'] ?? '';

        // Validate and process
        if (empty($name) || empty($email) || empty($skillsString)) {
            throw new Exception("All fields are required.");
        }
        $formattedName = formatName($name);
        if (!validateEmail($email)) {
            throw new Exception("Invalid email address.");
        }
        $skillsArray = cleanSkills($skillsString);
        if (empty($skillsArray)) {
            throw new Exception("At least one skill is required.");
        }

        // Save
        saveStudent($formattedName, $email, $skillsArray);
        echo "<p style='color: green;'>Student added successfully!</p>";
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
    }
}
?>

<h2>Add Student Info</h2>
<form method="POST">
    <label>Name: <input type="text" name="name" required></label><br><br>
    <label>Email: <input type="email" name="email" required></label><br><br>
    <label>Skills (comma-separated): <input type="text" name="skills" placeholder="e.g., PHP, HTML, CSS" required></label><br><br>
    <button type="submit">Add Student</button>
</form>

<?php
// Include footer
include 'footer.php';
?>