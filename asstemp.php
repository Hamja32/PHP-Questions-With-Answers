<?php
// Associative array of students
$students = array(
    101 => array("name" => "Ali", "marks" => 85),
    102 => array("name" => "Sara", "marks" => 92),
    103 => array("name" => "Hamza", "marks" => 88),
    104 => array("name" => "Ayesha", "marks" => 90)
);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Details</title>
    <style>
    table {
        border-collapse: collapse;
        width: 50%;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>

    <h2>Student Details</h2>

    <table>
        <tr>
            <th>Roll Number</th>
            <th>Name</th>
            <th>Marks</th>
        </tr>

        <?php
    foreach ($students as $roll => $details) {
        echo "<tr>";
        echo "<td>$roll</td>";
        echo "<td>".$details['name']."</td>";
        echo "<td>".$details['marks']."</td>";
        echo "</tr>";
    }
    ?>
    </table>

</body>

</html>