<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $student_id = $_POST['student_id'];
    $password   = $_POST['password'];

    $sql = "SELECT * FROM students WHERE student_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$student_id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($student && password_verify($password, $student['password_hash'])) {

        session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['username']  = $student['full_name'];

        header("Location: dashboard.php");
        exit();

    } else {
        echo "❌ Invalid login credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>

<h2>Login</h2>

<form method="POST">
    Student ID: <input type="text" name="student_id" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>

</body>
</html>
