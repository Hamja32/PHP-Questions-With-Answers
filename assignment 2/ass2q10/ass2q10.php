<!-- Q10 Create a PHP script to establish a db connection and create a MYSql table for storing student records -->

<?php
// 1. Database Configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_college";

// 2. Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// 3. Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 4. SQL Query to Create Table
// We are creating columns: ID, Name, Email, Age, and Course
$sql = "CREATE TABLE Students (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(50) NOT NULL,
    email VARCHAR(50),
    age INT(3),
    course VARCHAR(30),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// 5. Execute Query and Check
if ($conn->query($sql) === TRUE) {
    echo "Table 'Students' created successfully!";
} else {
    echo "Error creating table: " . $conn->error;
}

// 6. Close Connection
$conn->close();
?>
