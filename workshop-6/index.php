<?php
require "db.php";

// Insert data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $course = $_POST["course"];

    $sql = "INSERT INTO students (name, email, course) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $course]);

    echo "<p>Student added successfully!</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>


<h2>Add Student</h2>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Course: <input type="text" name="course" required><br><br>
    <button type="submit">Add New Student</button>
</form>

<h2>Student List</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Course</th>
    <th>Actions</th>
</tr>

<?php
$sql = "SELECT * FROM students";
$stmt = $pdo->query($sql);

while ($row = $stmt->fetch()) {
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['course']}</td>";
    echo "<td>
        <a href='edit.php?id={$row['id']}'>Edit</a> | 
        <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
    </td>";
    echo "</tr>";
}
?>
</table>


</body>
</html>
