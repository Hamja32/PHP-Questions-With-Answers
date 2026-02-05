<?php
session_start();

// --- THE GATEKEEPER ---
// Check if the user is NOT logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If check fails, redirect to login immediately
    header("Location: login.php");
    exit(); // Stop script execution here
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>
<style>
a {
    background-color: red;
    color: white;
    text-decoration: none;
    padding: 7px;
}
</style>

<body>
    <h1>Welcome to the Secured Dashboard</h1>
    <p>Hello, <b><?php echo $_SESSION['username']; ?></b>!</p>
    <p>You can only see this page because you are logged in.</p>

    <br>
    <a href="logout.php">Logout</a>
</body>

</html>