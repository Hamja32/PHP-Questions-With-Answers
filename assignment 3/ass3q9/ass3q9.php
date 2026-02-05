 <!-- Create a login authentication system using PHP sessions that restricts access to authorized users only. -->

 1. **`login.php`**: The public door (accepts credentials).
 2. **`dashboard.php`**: The restricted room (checks for session).
 3. **`logout.php`**: The exit (destroys session).

 ### 1. The Public Page (`login.php`)

 This file accepts the username and password. If they match the hardcoded values, it creates the session and sends the
 user to the dashboard.

 ```php
 <?php
session_start();

// Redirect user if they are already logged in
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

// Check if form is submitted
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // HARDCODED CREDENTIALS (In real life, check database here)
    $valid_user = "admin";
    $valid_pass = "password123";

    if ($user === $valid_user && $pass === $valid_pass) {
        // SUCCESS: Set session variables
        $_SESSION['username'] = $user;
        $_SESSION['loggedin'] = true;
        
        // Redirect to protected page
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

 <!DOCTYPE html>
 <html>

 <head>
     <title>Login</title>
 </head>

 <body>
     <h2>Login Page</h2>
     <p style="color:red;"><?php echo $error; ?></p>

     <form method="post">
         Username: <input type="text" name="username" required><br><br>
         Password: <input type="password" name="password" required><br><br>
         <input type="submit" name="login" value="Login">
     </form>
 </body>

 </html>

 ```

 ---

 ### 2. The Restricted Page (`dashboard.php`)

 **This is the most important part.** This file contains the "Gatekeeper" logic. It checks if the session variable
 exists. If not, it kicks the user back to the login page immediately.

 ```php
 <?php
session_start();

// --- THE GATEKEEPER ---
// Check if the user is NOT logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If check fails, redirect to login immediately
    header("Location: login.php");
    exit(); // Stop script execution here
}
?>

 <!DOCTYPE html>
 <html>

 <head>
     <title>Dashboard</title>
 </head>

 <body>
     <h1>Welcome to the Secured Dashboard</h1>
     <p>Hello, <b><?php echo $_SESSION['username']; ?></b>!</p>
     <p>You can only see this page because you are logged in.</p>

     <br>
     <a href="logout.php">Logout</a>
 </body>

 </html>

 ```

 ---

 ### 3. The Exit (`logout.php`)

 This file simply destroys the session and sends the user back to the start.

 ```php
 <?php
session_start();

// Remove all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?>

 ```

 ### How to Test It:

 1. Save the three files in the same folder.
 2. Open **`dashboard.php`** directly in your browser without logging in.
 * *Result:* You should be instantly redirected to `login.php`. (Restriction works).


 3. Log in with User: **admin** and Password: **password123**.
 * *Result:* You will be redirected to `dashboard.php` and see the welcome message.


 4. Click **Logout**.
 * *Result:* You are sent back to the login screen.