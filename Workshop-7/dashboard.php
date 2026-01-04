<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$theme = $_COOKIE['theme'] ?? 'light';

$bgColor   = ($theme === 'dark') ? "#000" : "#fff";
$textColor = ($theme === 'dark') ? "#fff" : "#000";
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<style>
body {
    background-color: <?= $bgColor ?>;
    color: <?= $textColor ?>;
}
</style>
</head>

<body>

<h1>Welcome <?= $_SESSION['username']; ?> 🎓</h1>

<nav>
    <a href="preference.php">Change Theme</a> |
    <a href="logout.php">Logout</a>
</nav>

<p>Current Theme: <?= ucfirst($theme); ?> mode</p>

</body>
</html>
