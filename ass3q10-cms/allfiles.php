This is a slightly more complex project. To keep it manageable but functional, we will split this into **four** parts.

1. **`setup.sql`**: To create your database table.
2. **`db.php`**: The shared database connection.
3. **`index.php`**: The **Front-end** (What users see).
4. **`admin.php`**: The **Back-end** (Login, Add, Edit, Delete).

### Step 1: Database Setup (SQL)

Run this SQL in your phpMyAdmin to create the table.

```sql
CREATE DATABASE simple_cms;
USE simple_cms;

CREATE TABLE pages (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
content TEXT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert a dummy page
INSERT INTO pages (title, content) VALUES ('Hello World', 'Welcome to my first CMS site.');

```

---

### Step 2: Connection File (`db.php`)

Save this file. It will be used by both the Admin and Index pages.

```php
<?php
$conn = new mysqli("localhost", "root", "", "simple_cms");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

```

---

### Step 3: The Front-End (`index.php`)

This is what the public sees. It displays the navigation (titles) and the content.

```php
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>My Simple CMS</title>
    <style>
    body {
        font-family: sans-serif;
        margin: 0;
        padding: 20px;
    }

    nav {
        background: #f4f4f4;
        padding: 10px;
        margin-bottom: 20px;
    }

    nav a {
        margin-right: 15px;
        text-decoration: none;
        color: #333;
        font-weight: bold;
    }

    .content {
        border-top: 2px solid #333;
        padding-top: 20px;
    }
    </style>
</head>

<body>

    <h1>My Website</h1>

    <nav>
        <a href="index.php">Home</a>
        <?php
    $sql = "SELECT id, title FROM pages";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<a href='index.php?id=" . $row['id'] . "'>" . $row['title'] . "</a>";
    }
    ?>
    </nav>

    <div class="content">
        <?php
    // If an ID is clicked, show that page. Otherwise, show the latest page.
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM pages WHERE id=$id";
    } else {
        $sql = "SELECT * FROM pages ORDER BY id DESC LIMIT 1";
    }

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h2>" . $row['title'] . "</h2>";
        echo "<p>" . nl2br($row['content']) . "</p>"; // nl2br converts newlines to <br>
    } else {
        echo "<p>Page not found.</p>";
    }
    ?>
    </div>

</body>

</html>

```

---

### Step 4: The Admin Panel (`admin.php`)

This is the robust part. It handles **Login**, **Listing**, **Adding**, **Updating**, and **Deleting**.

```php
<?php
session_start();
include 'db.php';

// --- 1. LOGIN LOGIC ---
// If not logged in, show login form and stop execution
if (!isset($_SESSION['admin'])) {
    if (isset($_POST['login'])) {
        // Simple hardcoded credential check
        if ($_POST['username'] == "admin" && $_POST['password'] == "pass123") {
            $_SESSION['admin'] = true;
            header("Location: admin.php"); // Refresh to load admin panel
        } else {
            echo "<p style='color:red'>Invalid Login</p>";
        }
    }
    ?>
<form method="post" style="margin: 50px auto; width: 300px; text-align: center;">
    <h2>Admin Login</h2>
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="submit" name="login" value="Login">
</form>
<?php
    exit(); // Stop script here if not logged in
}

// --- 2. LOGOUT LOGIC ---
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: admin.php");
    exit();
}

// --- 3. CRUD OPERATIONS ---

// DELETE Page
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM pages WHERE id=$id");
    header("Location: admin.php");
}

// ADD or UPDATE Page
if (isset($_POST['save'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    
    if ($_POST['id'] != "") {
        // Update existing
        $id = $_POST['id'];
        $sql = "UPDATE pages SET title='$title', content='$content' WHERE id=$id";
    } else {
        // Insert new
        $sql = "INSERT INTO pages (title, content) VALUES ('$title', '$content')";
    }
    $conn->query($sql);
    header("Location: admin.php");
}

// FETCH DATA FOR EDITING (If user clicked 'Edit')
$edit_id = ""; $edit_title = ""; $edit_content = "";
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $res = $conn->query("SELECT * FROM pages WHERE id=$edit_id");
    $row = $res->fetch_assoc();
    $edit_title = $row['title'];
    $edit_content = $row['content'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <style>
    body {
        font-family: sans-serif;
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background: #333;
        color: white;
    }

    .form-box {
        background: #f9f9f9;
        padding: 20px;
        border: 1px solid #ddd;
    }

    .btn {
        padding: 5px 10px;
        text-decoration: none;
        color: white;
        background: #007BFF;
        border-radius: 3px;
    }

    .btn-del {
        background: #DC3545;
    }
    </style>
</head>

<body>

    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1>CMS Admin Panel</h1>
        <a href="admin.php?action=logout" style="color:red;">Logout</a>
    </div>

    <div class="form-box">
        <h3><?php echo ($edit_id ? "Edit Page" : "Add New Page"); ?></h3>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $edit_id; ?>">
            <label>Title:</label><br>
            <input type="text" name="title" value="<?php echo $edit_title; ?>" style="width: 100%;" required><br><br>
            <label>Content:</label><br>
            <textarea name="content" rows="5" style="width: 100%;"
                required><?php echo $edit_content; ?></textarea><br><br>
            <input type="submit" name="save" value="Save Page">
            <?php if($edit_id) echo "<a href='admin.php'>Cancel</a>"; ?>
        </form>
    </div>

    <h3>Existing Pages</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Actions</th>
        </tr>
        <?php
    $result = $conn->query("SELECT * FROM pages");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>
                <a href='admin.php?edit=" . $row['id'] . "' class='btn'>Edit</a> 
                <a href='admin.php?delete=" . $row['id'] . "' class='btn btn-del' onclick='return confirm(\"Are you sure?\")'>Delete</a>
              </td>";
        echo "</tr>";
    }
    ?>
    </table>

</body>

</html>

```

### How to use this CMS:

1. **Create Database:** Run the SQL code in Step 1.
2. **View Site:** Go to `localhost/index.php`. You will see the default "Hello World" page.
3. **Login:** Go to `localhost/admin.php`.
* **Username:** `admin`
* **Password:** `pass123`


4. **Manage:**
* Use the top form to **Add** a page.
* Click **Edit** in the table to load data into the form for updating.
* Click **Delete** to remove a page.


5. **Check Frontend:** Refresh `index.php` to see your changes dynamically!