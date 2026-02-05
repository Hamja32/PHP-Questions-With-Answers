<?php 
# Q6 - Create a pHP form-handling that accepts name,email and age and validates that none of the fields are empty ?

// Define variables and set to empty values
$name = $email = $age = "";
$nameErr = $emailErr = $ageErr = "";
$successMsg = "";

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Validate Name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    // 2. Validate Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
    }

    // 3. Validate Age
    if (empty($_POST["age"])) {
        $ageErr = "Age is required";
    } else {
        $age = test_input($_POST["age"]);
    }

    // If there are no errors, process the data
    if ($nameErr == "" && $emailErr == "" && $ageErr == "") {
        $successMsg = "Form submitted successfully! <br> Name: $name <br> Email: $email <br> Age: $age";
        // You can clear the fields here if desired
        $name = $email = $age = "";
    }
}

// Helper function to sanitize data (Security best practice)
function test_input($data) {
    $data = trim($data);            // Remove whitespace
    $data = stripslashes($data);    // Remove backslashes
    $data = htmlspecialchars($data);// Convert special chars to HTML entities
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP Form Validation</title>
    <style>
    .error {
        color: red;
    }

    .success {
        color: green;
        font-weight: bold;
    }

    form {
        margin-top: 20px;
    }

    div {
        margin-bottom: 10px;
    }
    </style>
</head>

<body>

    <h2>PHP Form Validation</h2>
    <?php if ($successMsg): ?>
    <p class="success"><?php echo $successMsg; ?></p>
    <?php endif; ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div>
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $name;?>">
            <span class="error">* <?php echo $nameErr;?></span>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $email;?>">
            <span class="error">* <?php echo $emailErr;?></span>
        </div>
        <div>
            <label>Age:</label>
            <input type="number" name="age" value="<?php echo $age;?>">
            <span class="error">* <?php echo $ageErr;?></span>
        </div>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>