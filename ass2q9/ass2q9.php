<!-- Q9 - Write a PHP program to connect PHP with MYSQL db and display a success or error message  -->
<?php
// 1. Database Credentials
$servername = "localhost";
$username = "root";       // XAMPP default user
$password = "";           // XAMPP default password (empty)
$dbname = "my_school1";  // Apne database ka naam yahan likhein

// 2. Create Connection
// @ symbol warning hide karne ke liye hai taaki hum khud error handle karein
$conn = @new mysqli($servername, $username, $password, $dbname);

// 3. Check Connection
if ($conn->connect_error) {
    // Agar connection fail hua to Error message dikhaye
    die("Connection failed: " . $conn->connect_error);
} else {
    // Agar pass hua to Success message dikhaye
    echo "<h1>Connected successfully!</h1>";
}
?>