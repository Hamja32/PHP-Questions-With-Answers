<!-- Q8 - Develop a registration form in html and php that displays a welcome message after successful submission   -->
<!DOCTYPE html>
<html>

<body>

    <?php
// Check if the submit button is clicked
if (isset($_POST['submit'])) {
    // Get values from the form
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Display the Welcome Message
    echo "<h2>Registration Successful!</h2>";
    echo "<h3>Welcome, $name!</h3>";
    echo "<p>We have sent a confirmation to <b>$email</b>.</p>";

} else {
    // IF NOT SUBMITTED, SHOW THE FORM
?>

    <h2>Registration Form</h2>
    <form method="post">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="pass" required><br><br>

        <input type="submit" name="submit" value="Register">
    </form>

    <?php
} // End of else
?>

</body>

</html>