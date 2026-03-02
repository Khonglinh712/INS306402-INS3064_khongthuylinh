<?php
$result = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $num1 = $_POST['num1'] ?? '';
    $num2 = $_POST['num2'] ?? '';
    $operator = $_POST['operator'] ?? '';

    // Kiểm tra numeric
    if (!is_numeric($num1) || !is_numeric($num2)) {
        $error = "Please enter valid numbers.";
    } else {

        // Ép kiểu về số
        $num1 = (float)$num1;
        $num2 = (float)$num2;

        switch ($operator) {
            case '+':
                $answer = $num1 + $num2;
                break;

            case '-':
                $answer = $num1 - $num2;
                break;

            case '*':
                $answer = $num1 * $num2;
                break;

            case '/':
                if ($num2 == 0) {
                    $error = "Cannot divide by zero.";
                } else {
                    $answer = $num1 / $num2;
                }
                break;

            default:
                $error = "Invalid operation.";
        }

        if (empty($error)) {
            $result = "$num1 $operator $num2 = $answer";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Arithmetic Calculator</title>
</head>
<body>

<h2>Simple Calculator</h2>

<form method="post">
    <input type="text" name="num1" placeholder="First number">
    
    <select name="operator">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="*">*</option>
        <option value="/">/</option>
    </select>
    
    <input type="text" name="num2" placeholder="Second number">
    
    <button type="submit">Calculate</button>
</form>

<br>

<?php
if (!empty($error)) {
    echo "<p style='color:red;'>$error</p>";
}

if (!empty($result)) {
    echo "<p style='color:green;'>$result</p>";
}
?>

</body>
</html>