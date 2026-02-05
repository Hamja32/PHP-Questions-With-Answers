<?php
session_start();

// Redirect user if they are already logged in
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

// Check if form is submitted
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // HARDCODED CREDENTIALS (In real life, check database here)
    $valid_user = "admin";
    $valid_pass = "password123";

    if ($user === $valid_user && $pass === $valid_pass) {
        // SUCCESS: Set session variables
        $_SESSION['username'] = $user;
        $_SESSION['loggedin'] = true;
        
        // Redirect to protected page
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h2>Login Page</h2>
    <p style="color:red;"><?php echo $error; ?></p>

    <form method="post">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <input type="submit" name="login" value="Login">
    </form>
</body>

</html>