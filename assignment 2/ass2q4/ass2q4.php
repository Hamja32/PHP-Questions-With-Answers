<?php
// #Assignment 2
# Q4 - Develop a PHP program using a multidimensional array to store marks of  5 students in 3 subjects and calculate total and average marks

$students = array(
    "Ali"   => array(85, 78, 90),
    "Sara"  => array(88, 92, 84),
    "Hamza" => array(75, 80, 70),
    "Ayesha"=> array(90, 95, 93),
    "Zain"  => array(82, 76, 88)
);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Marks</title>
    <style>
    table {
        border-collapse: collapse;
        width: 70%;
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

    <h2>Marks of Students</h2>

    <table>
        <tr>
            <th>Student Name</th>
            <th>English</th>
            <th>Hindi</th>
            <th>Maths</th>
            <th>Total</th>
            <th>Average</th>
        </tr>

        <?php
    foreach ($students as $name => $marks) {

        $total = array_sum($marks);
        $average = $total / count($marks);
        echo "<tr>";
        echo "<td>$name</td>";
        echo "<td>$marks[0]</td>";
        echo "<td>$marks[1]</td>";
        echo "<td>$marks[2]</td>";
        echo "<td>$total</td>";
        echo "<td>".number_format($average, 2)."</td>";
        echo "</tr>";
    }
    ?>
    </table>
</body>

</html>
