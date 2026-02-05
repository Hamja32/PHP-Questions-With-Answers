<?php
// Check if form is submitted using POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    echo "<h2>Entered Details</h2>";
    echo "Username: " . $username . "<br>";
    echo "Password: " . $password;
}
?>