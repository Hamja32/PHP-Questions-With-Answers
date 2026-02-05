<!-- Here is a complete, single-file PHP script that demonstrates the full lifecycle of a session: **Start**, **Use**, and
**Destroy**. -->


<?php
// 1. SESSION CREATION
// This must be the very first line of code in the file.
session_start();

// 2. SESSION DESTRUCTION (Logout Logic)
// If the user clicks the "Logout" button
if (isset($_POST['logout'])) {
    session_unset();    // Remove all session variables
    session_destroy();  // Destroy the session completely
    
    // Refresh the page to show the login screen again
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// 3. SESSION VARIABLE USAGE (Login Logic)
// If the user submits the login form
if (isset($_POST['login'])) {
    // Store data in Session Variables
    $_SESSION['username'] = $_POST['user'];
    $_SESSION['role'] = 'Student'; // Example of storing extra data
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Session Demo</title>
</head>

<body>

    <h2>PHP Session Management</h2>

    <?php
    // CHECK STATE: Are we logged in?
    if (isset($_SESSION['username'])) {
        // --- DISPLAY MODE (Session Active) ---
        ?>

    <div style="border: 1px solid green; padding: 20px;">
        <h3>Welcome, <?php echo $_SESSION['username']; ?>!</h3>
        <p>Your Role: <b><?php echo $_SESSION['role']; ?></b></p>
        <p><i>This data persists even if you refresh the page.</i></p>

        <form method="post">
            <input type="submit" name="logout" value="Logout (Destroy Session)">
        </form>
    </div>

    <?php 
    } else { 
        // --- LOGIN MODE (No Session) ---
        ?>

    <div style="border: 1px solid #ccc; padding: 20px;">
        <p>You are not logged in.</p>
        <form method="post">
            <label>Enter Name:</label>
            <input type="text" name="user" required>
            <input type="submit" name="login" value="Login (Start Session)">
        </form>
    </div>

    <?php } ?>

</body>

</html>


<!-- ### Key Functions Explained

1. **`session_start()`**:
* **What it does:** It creates a new session or resumes the current one based on a session identifier passed via a GET or POST request, or a cookie.
* **Rule:** It **must** be the first thing in your document, before any HTML tags.


2. **`$_SESSION['key'] = value`**:
* **What it does:** It stores data on the server that can be accessed across multiple pages. Unlike cookies, this data is not stored on the user's computer (only the Session ID is).


3. **`session_destroy()`**:
* **What it does:** It destroys all of the data associated with the current session. It is used to log the user out.
* **Note:** We often use `session_unset()` before it to ensure the variables are cleared immediately from the script's memory. -->