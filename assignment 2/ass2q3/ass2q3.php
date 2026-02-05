<!-- #Assignment 2

 Q3 - Write a PHP script using an associative array to store students details (roll number,name,marks) and display them
in a table format -->

<?php
        $students = array(
            101 => array("name"=>"Hamza","marks"=>99),
            102 => array("name"=>"Shaan","marks"=>89),
            103 => array("name"=>"Owesh","marks"=>80),
            104 => array("name"=>"Hitesh","marks"=>97)
        );
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student list</title>
    <style>
    table {
        border-collapse: collapse;
    }

    td,
    th {
        padding: 10px;
        border: 1px solid black;
    }
    </style>
</head>

<body>
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