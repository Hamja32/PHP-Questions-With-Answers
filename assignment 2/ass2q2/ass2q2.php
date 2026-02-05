<?php
#Assignment 2
# Q2 - Create a PHP program using an indexed array to store the names of 10 students and display them using a loop ?

#source code
$students = array("Hamza","Shaan","Ovesh","Tayyab","Zeeshan","Aman","Sher Mohammed","Altaf","Arman","Hitesh");
for ($i=0; $i < sizeof($students); $i++) { 
    echo "<br>";
    echo "$i : $students[$i]";
}

?>
