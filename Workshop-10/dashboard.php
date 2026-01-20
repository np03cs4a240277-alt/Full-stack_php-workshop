<?php

session_start();
require 'db.php';

$user_email = '';

if (isset($_SESSION['user_id'])) {
    $sql = "SELECT email FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    if ($user) {
        $user_email = $user['email'];
    }
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>Welcome to my site</h1>

<?php if ($user_email): ?>
    <p>Logged In User : <?php echo htmlspecialchars($user_email); ?></p>

    <form method="POST">
        <button name="logout">Logout</button>
    </form>
<?php else: ?>
    <a href="login.php">
        <button>Login</button>
    </a>
<?php endif; ?>

</body>
</html>
