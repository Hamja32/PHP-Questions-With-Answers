<!-- 
### Step 4: The Admin Panel (`admin.php`)

This is the robust part. It handles **Login**, **Listing**, **Adding**, **Updating**, and **Deleting**. -->

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