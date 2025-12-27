<?php
require "db.php";

$id = $_GET["id"];

// Fetch student
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$student = $stmt->fetch();

// Update student
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $course = $_POST["course"];

    $sql = "UPDATE students SET name=?, email=?, course=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $course, $id]);

    header("Location: index.php");
}
?>

<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $student['name']; ?>"><br><br>
    Email: <input type="email" name="email" value="<?php echo $student['email']; ?>"><br><br>
    Course: <input type="text" name="course" value="<?php echo $student['course']; ?>"><br><br>
    <button type="submit">Update</button>
</form>
