<?php
session_start();

// Khởi tạo số lần sai nếu chưa có
if (!isset($_SESSION['failed_attempts'])) {
    $_SESSION['failed_attempts'] = 0;
}

// Tài khoản hardcode
$correct_user = "admin";
$correct_pass = "123456";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";

    if ($username === $correct_user && $password === $correct_pass) {
        $message = "<p style='color:green;'>Login Successful</p>";
        $_SESSION['failed_attempts'] = 0; // reset khi đúng
    } else {
        $_SESSION['failed_attempts']++;
        $message = "<p style='color:red;'>Invalid Credentials</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Login</title>
</head>
<body>

<h2>Login</h2>

<form method="post">
    <label>Username:</label><br>
    <input type="text" name="username"><br><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Login</button>
</form>

<?php
// Hiển thị kết quả
echo $message;

// Hiển thị số lần sai
if ($_SESSION['failed_attempts'] > 0) {
    echo "<p>Failed Attempts: " . $_SESSION['failed_attempts'] . "</p>";
}
?>

</body>
</html>
