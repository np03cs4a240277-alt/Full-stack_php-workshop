<?php
include 'includes/header.php';
include 'functions/functions.php';

$name = $email = $skills = "";
$nameErr = $emailErr = $skillsErr = "";
$successMsg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $name = formatName($_POST['name']);
        $email = $_POST['email'];
        $skills = $_POST['skills'];

        if (empty($name)) throw new Exception("Name is required.");
        if (!validateEmail($email)) throw new Exception("Invalid email.");
        if (empty($skills)) throw new Exception("Skills are required.");

        $skillsArray = cleanSkills($skills);
        saveStudent($name, $email, $skillsArray);

        $successMsg = "Student info saved successfully!";
        $name = $email = $skills = ""; // clear form
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<h2>Add Student Info</h2>

<?php if (!empty($successMsg)) echo "<p class='success'>$successMsg</p>"; ?>
<?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

<form method="post" action="">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br><br>

    <label>Skills (comma-separated):</label><br>
    <input type="text" name="skills" value="<?php echo htmlspecialchars($skills); ?>"><br><br>

    <input type="submit" value="Add Student">
</form>

<?php include 'includes/footer.php'; ?>
