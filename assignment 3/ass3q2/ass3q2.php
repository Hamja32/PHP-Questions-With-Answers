<!-- Assignment 3 -->
<!--  2. Write a PHP script to retrieve and display records from a MySQL database in a tabular format. -->


<?php
$conn = new mysqli("localhost", "root", "", "my_college");
if ($conn->connect_error) die("Connection failed");

$result = $conn->query("SELECT id, fullname, email, age, course FROM Students");
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Details</title>
<style>
table{width:80%;margin:20px auto;border-collapse:collapse}
th,td{border:1px solid #ddd;padding:8px}
th{background:#4CAF50;color:#fff}
tr:nth-child(even){background:#f2f2f2}
</style>
</head>

<body>
<h2 style="text-align:center;">Student Details</h2>

<table>
<tr>
<th>ID</th><th>Name</th><th>Email</th><th>Age</th><th>Course</th>
</tr>

<?php
if ($result && $result->num_rows) {
    while($r = $result->fetch_assoc()){
        echo "<tr>
                <td>{$r['id']}</td>
                <td>{$r['fullname']}</td>
                <td>{$r['email']}</td>
                <td>{$r['age']}</td>
                <td>{$r['course']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No records found</td></tr>";
}
$conn->close();
?>

</table>
</body>
</html>
