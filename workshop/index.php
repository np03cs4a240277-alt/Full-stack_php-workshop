<?php
// Initialize variables to avoid undefined variable errors
$name = $email = $password = $confirm_password = "";
$nameErr = $emailErr = $passwordErr = $confirmPasswordErr = "";
$successMsg = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Directly assign form values to variables
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validation
    if (empty($name)) {
        $nameErr = "Name is required";
    }

    if (empty($email)) {
        $emailErr = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }

    if (empty($password)) {
        $passwordErr = "Password is required";
    } elseif (strlen($password) < 6) {
        $passwordErr = "Password must be at least 6 characters";
    }

    if (empty($confirm_password)) {
        $confirmPasswordErr = "Confirm password is required";
    } elseif ($confirm_password !== $password) {
        $confirmPasswordErr = "Passwords do not match";
    }

    // Save if no errors
    if ($nameErr == "" && $emailErr == "" && $passwordErr == "" && $confirmPasswordErr == "") {

        $file = "users.json";
        if (!file_exists($file)) {
            file_put_contents($file, json_encode([]));
        }

        $users = json_decode(file_get_contents($file), true);
        $users[] = [
            "name" => $name,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT)
        ];

        if (file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT))) {
            $successMsg = "Registration Successful!";
            $name = $email = $password = $confirm_password = "";
        } else {
            $successMsg = "Error saving data!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>

<h2>User Registration Form</h2>

<?php if ($successMsg != "") echo "<p>$successMsg</p>"; ?>

<form action="" method="POST">

    Name:<br>
    <input type="text" name="name" value="<?php echo $name; ?>"><br>
    <span style="color:red;"><?php echo $nameErr; ?></span><br>

    Email:<br>
    <input type="text" name="email" value="<?php echo $email; ?>"><br>
    <span style="color:red;"><?php echo $emailErr; ?></span><br>

    Password:<br>
    <input type="password" name="password"><br>
    <span style="color:red;"><?php echo $passwordErr; ?></span><br>

    Confirm Password:<br>
    <input type="password" name="confirm_password"><br>
    <span style="color:red;"><?php echo $confirmPasswordErr; ?></span><br><br>

    <input type="submit" value="Register">

</form>

</body>
</html>
