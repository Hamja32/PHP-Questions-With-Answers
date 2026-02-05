<?php
// Configuration
$servername = "localhost";
$username = "root";
$password = "";           // Keep this empty for XAMPP
$dbname = "my_college";   // A database that exists

// ---------------------------------------------------------
// SCENARIO 1: Connection Error Handling
// ---------------------------------------------------------

// We use the '@' symbol to suppress default PHP warnings so our custom message shows up cleanly.
$conn = @mysqli_connect($serverame, $username, $password, $dbname);

// Check if connection failed
if (!$conn) {
    // die() stops the script execution immediately.
    // mysqli_connect_error() returns the exact reason why the connection failed.
    die("CRITICAL ERROR: Could not connect to the database. <br>" . mysqli_connect_error());
}

echo "<h3>1. Database connected successfully!</h3>";

// ---------------------------------------------------------
// SCENARIO 2: Query Error Handling (Using mysqli_error)
// ---------------------------------------------------------

// Let's intentionally write a WRONG query (selecting from a table that doesn't exist)
$sql = "SELECT * FROM NonExistentTable";

// Execute query
$result = mysqli_query($conn, $sql);

// Check if the query failed
if (!$result) {
    // mysqli_error($conn) looks at the connection and tells us what went wrong with the LAST command.
    die("QUERY FAILED: The system stopped here. <br> Reason: " . mysqli_error($conn));
}

// This part will never be reached because of the die() function above.
echo "This message will never show if there is an error.";

mysqli_close($conn);
?>