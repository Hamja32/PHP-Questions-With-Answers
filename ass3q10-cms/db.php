<!-- ### Step 2: Connection File (`db.php`) -->

<?php
$conn = new mysqli("localhost", "root", "", "simple_cms");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>