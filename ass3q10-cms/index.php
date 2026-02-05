<!-- 
### Step 3: The Front-End (`index.php`)

This is what the public sees. It displays the navigation (titles) and the content.
 -->

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