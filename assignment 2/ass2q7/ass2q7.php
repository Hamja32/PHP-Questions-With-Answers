<!-- #Q7 - Write a PHP script that accepts two number from a form and perform arithmetic questions based on user selection -->


<form method="post">
    <input type="number" name="n1" placeholder="First Number" required>
    <input type="number" name="n2" placeholder="Second Number" required>
    <select name="op">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="*">*</option>
        <option value="/">/</option>
    </select>
    <input type="submit" name="submit" value="Calculate">
</form>

<?php
if (isset($_POST['submit'])) {
    $n1 = $_POST['n1'];
    $n2 = $_POST['n2'];
    $op = $_POST['op'];
    $res = 0;

    switch ($op) {
        case '+': $res = $n1 + $n2; break;
        case '-': $res = $n1 - $n2; break;
        case '*': $res = $n1 * $n2; break;
        case '/': $res = ($n2 != 0) ? $n1 / $n2 : "Error : Number is not divided by zero"; break;
    }
    echo "<h3>Result: $res</h3>";
}
?>