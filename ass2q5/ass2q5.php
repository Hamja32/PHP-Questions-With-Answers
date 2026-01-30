<!-- Assignment 2
 
  Question 5 -  Design an HTML form and write  a php script to accept username,password using the post method and display the entered values. -->

<!DOCTYPE html>
<html>

<head>
    <title>Login Form</title>
</head>

<body>

    <h2>User Login</h2>

    <form action="login.php" method="post">
        <label>Username:</label>
        <input type="text" name="username" required>
        <br><br>

        <label>Password:</label>
        <input type="password" name="password" required>
        <br><br>

        <input type="submit" value="Login">
    </form>

</body>

</html>