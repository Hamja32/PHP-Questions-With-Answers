<!-- Assignment 3 -->
<!--  2. Write a PHP script to retrieve and display records from a MySQL database in a tabular format. -->


<?php
// 1. Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_college";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. SQL Select Query
$sql = "SELECT id, fullname, email, age, course FROM Students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Records</title>
    <style>
    table {
        width: 80%;
        border-collapse: collapse;
        margin: 20px auto;
        font-family: Arial, sans-serif;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>

    <h2 style="text-align:center;">Student Details</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Course</th>
            </tr>
        </thead>
        <tbody>
            <?php
        // 3. Check if there are results
        if ($result->num_rows > 0) {
            // 4. Loop through data
            // fetch_assoc() puts the current row data into an array named $row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["fullname"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["age"] . "</td>";
                echo "<td>" . $row["course"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='text-align:center'>No records found</td></tr>";
        }
        $conn->close();
        ?>
        </tbody>
    </table>

</body>

</html>