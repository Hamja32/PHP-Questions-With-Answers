<!-- Here is a complete, single-file PHP script that handles all three operations: **Create**, **Read**, and **Delete**. -->

<?php
// 1. CREATE COOKIE (When user submits name)
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    // Syntax: setcookie(name, value, expiry, path)
    // 86400 = 1 day (60s * 60m * 24h)
    setcookie("user_name", $name, time() + 86400, "/");
    
    // Refresh page to make cookie available immediately
    header("Refresh:0");
}

// 2. DELETE COOKIE (When user clicks 'Delete')
if (isset($_POST['delete'])) {
    // To delete, set the expiration date to the past
    setcookie("user_name", "", time() - 3600, "/");
    
    // Refresh page to update the view
    header("Refresh:0");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cookie Management</title>
</head>

<body>

    <h2>PHP Cookie Manager</h2>

    <?php
    // 3. READ COOKIE (Check if cookie exists)
    if (isset($_COOKIE['user_name'])) {
        // If Cookie Exists: Display Name and Delete Button
        echo "<h3>Welcome back, " . $_COOKIE['user_name'] . "!</h3>";
        echo "<p>Your name is stored in a cookie.</p>";
        ?>

    <form method="post">
        <input type="submit" name="delete" value="Delete Cookie">
    </form>

    <?php 
    } else { 
        // If Cookie Does NOT Exist: Display Input Form
        echo "<h3>No cookie found. Please enter your name.</h3>";
    ?>

    <form method="post">
        <input type="text" name="name" placeholder="Enter your name" required>
        <input type="submit" name="save" value="Save Name">
    </form>

    <?php } ?>

</body>

</html>

<!-- 

### Explanation of the Functions:

1. **Create (`setcookie`)**:
* `time() + 86400`: Sets the cookie to expire in 24 hours (86400 seconds).
* `"/"`: Makes the cookie available across the entire website.


2. **Read (`$_COOKIE`)**:
* We use the superglobal array `$_COOKIE['cookie_name']` to retrieve the value.
* We wrap this in `isset()` to prevent errors if the cookie doesn't exist yet.


3. **Delete**:
* To delete a cookie, you **cannot** just unset the variable. You must use `setcookie()` again with the **same name** but set the time to the **past** (`time() - 3600`). This tells the browser the cookie is expired and should be removed. -->