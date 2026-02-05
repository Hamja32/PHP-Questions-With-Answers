<!-- Assignment 3 -->
<!-- 1. Develop a PHP program to insert records into a MySQL database table using form input. -->

<?php
$message = ""; // Variable to store success/error message

// 1. Check if the form is submitted
if (isset($_POST['submit'])) {
    
    // 2. Database Configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "my_college";

    // 3. Create Connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 4. Get data from the form
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $course = $_POST['course'];

    // 5. SQL Insert Query
    // We do not insert 'id' because it is AUTO_INCREMENT
    $sql = "INSERT INTO Students (fullname, email, age, course)
            VALUES ('$name', '$email', '$age', '$course')";

    // 6. Execute Query
    if ($conn->query($sql) === TRUE) {
        $message = "New record created successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Insert Student Data</title>
    <style>
    body {
        font-family: sans-serif;
        padding: 20px;
    }

    form {
        background: #f2f2f2;
        padding: 20px;
        width: 300px;
    }

    input {
        width: 90%;
        margin-bottom: 10px;
        padding: 5px;
    }

    .msg {
        color: green;
        font-weight: bold;
    }
    </style>
</head>

<body>

    <h2>Add New Student</h2>

    <?php if ($message != "") { echo "<p class='msg'>$message</p>"; } ?>

    <form method="post">
        <label>Full Name:</label><br>
        <input type="text" name="fullname" required><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br>

        <label>Age:</label><br>
        <input type="number" name="age" required><br>

        <label>Course:</label><br>
        <input type="text" name="course" required><br>

        <input type="submit" name="submit" value="Insert Record">
    </form>

</body>

</html>