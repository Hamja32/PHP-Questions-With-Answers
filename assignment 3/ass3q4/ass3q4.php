<!-- Assignment 3 -->
<!--Q4 -  Develop a PHP program to delete records from a MySQL table using user input.. -->

<?php
// 1. Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_college";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$message = "";

// 2. Handle Delete Request
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    // 3. SQL Delete Query
    // CRITICAL: Always use the WHERE clause, or you will delete ALL data.
    $sql = "DELETE FROM Students WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // 4. Check if any row was actually deleted
        if ($conn->affected_rows > 0) {
            $message = "Record with ID $id has been deleted successfully.";
        } else {
            $message = "No record found with ID $id. Nothing was deleted.";
        }
    } else {
        $message = "Error deleting record: " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Student</title>
    <style>
    body {
        font-family: sans-serif;
        padding: 20px;
    }

    .container {
        border: 1px solid Black;
        padding: 20px;
        width: 300px;
        background-color: #ffe6e6;
    }

    input[type="number"] {
        padding: 5px;
        width: 70%;
    }

    input[type="submit"] {
        background-color: #f44336;
        color: white;
        border: none;
        padding: 6px 15px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #d32f2f;
    }

    .msg {
        font-weight: bold;
        margin-bottom: 10px;
        display: block;
    }
    </style>
</head>

<body>

    <h2>Delete Student Record</h2>

    <?php if ($message != "") { echo "<span class='msg'>$message</span>"; } ?>

    <div class="container">
        <p><strong>Warning:</strong> This action cannot be undone.</p>

        <form method="post">
            <label>Enter ID to Delete:</label><br><br>
            <input type="number" name="id" placeholder="Student ID" required> <br><br>
            <input type="submit" name="delete" value="DELETE">
        </form>
    </div>

</body>

</html>
