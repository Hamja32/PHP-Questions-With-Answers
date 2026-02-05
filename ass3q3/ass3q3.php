<!-- Assignment 3 -->
<!-- Q3 - Create a PHP application to update records in a MySQL database based on a given student
ID. -->

<?php
// 1. Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_college";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$message = "";
$id = "";
$fullname = "";
$email = "";
$course = "";

// 2. HANDLE SEARCH (When user clicks 'Search')
if (isset($_POST['search'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM Students WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fullname = $row['fullname'];
        $email = $row['email'];
        $course = $row['course'];
    } else {
        $message = "No student found with ID: $id";
    }
}

// 3. HANDLE UPDATE (When user clicks 'Update')
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $sql = "UPDATE Students SET fullname='$fullname', email='$email', course='$course' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $message = "Record updated successfully!";
    } else {
        $message = "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Student</title>
    <style>
    body {
        font-family: sans-serif;
        padding: 20px;
    }

    form {
        background: #f9f9f9;
        padding: 20px;
        width: 300px;
        border: 1px solid #ddd;
    }

    input[type="text"],
    input[type="email"],
    input[type="number"] {
        width: 95%;
        margin-bottom: 10px;
        padding: 5px;
    }

    input[type="submit"] {
        padding: 8px 15px;
        cursor: pointer;
    }

    .msg {
        color: blue;
        font-weight: bold;
    }
    </style>
</head>

<body>

    <h2>Update Student Record</h2>

    <?php if ($message != "") { echo "<p class='msg'>$message</p>"; } ?>

    <form method="post">
        <label>Enter Student ID to Edit:</label><br>
        <input type="number" name="id" value="<?php echo $id; ?>" required>
        <input type="submit" name="search" value="Search">
    </form>

    <br>

    <?php if ($fullname != ""): ?>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label>Full Name:</label><br>
        <input type="text" name="fullname" value="<?php echo $fullname; ?>" required><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo $email; ?>" required><br>

        <label>Course:</label><br>
        <input type="text" name="course" value="<?php echo $course; ?>" required><br>

        <input type="submit" name="update" value="Update Record">
    </form>
    <?php endif; ?>

</body>

</html>