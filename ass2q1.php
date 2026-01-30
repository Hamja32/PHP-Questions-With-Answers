<?php
#Assignment 2
# Q1 - Write a PHP program to define a user define function that accept two numbers and returns their sum,subtraction,multiplication and division.

#code
function  printCalculation($a, $b){
$sum = $a + $b;
$subtract = $a - $b;
$multiplication = $a * $b;
$division = $a / $b;

$result = ["sum"=>$sum,"subtract"=>$subtract,"multiplication"=>$multiplication,"division"=>$division];
return $result;
}

$values = printCalculation(10,5);
foreach($values as $key => $val){
    echo "<br>";
    echo "$key = $val";
}

?>