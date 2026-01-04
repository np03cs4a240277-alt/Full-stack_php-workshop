<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $student_id = $_POST['student_id'];
    $full_name  = $_POST['full_name'];
    $password   = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO students (student_id, full_name, password_hash)
            VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$student_id, $full_name, $hashedPassword]);

    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>

<h2>Student Register</h2>

<form method="POST">
    Student ID: <input type="text" name="student_id" required><br><br>
    Full Name: <input type="text" name="full_name" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Register</button>
</form>

</body>
</html>
