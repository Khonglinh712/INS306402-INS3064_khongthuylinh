<?php
session_start();

// 1️⃣ Tạo CSRF token nếu chưa có
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$message = "";

// 2️⃣ Xử lý khi submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $postedToken = $_POST['csrf_token'] ?? '';

    // So sánh an toàn
    if (!hash_equals($_SESSION['csrf_token'], $postedToken)) {
        http_response_code(403);
        die("403 Forbidden - Invalid CSRF Token");
    }

    $message = "Form submitted successfully (CSRF verified).";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CSRF Protection Form</title>
</head>
<body>

<h2>Secure Form (CSRF Protected)</h2>

<form method="post">
    <input type="text" name="example" placeholder="Type something">

    <!-- 3️⃣ Hidden CSRF Token -->
    <input type="hidden" name="csrf_token" 
        value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

    <button type="submit">Submit</button>
</form>

<br>

<?php
if (!empty($message)) {
    echo "<p style='color:green;'>$message</p>";
}
?>

</body>
</html>