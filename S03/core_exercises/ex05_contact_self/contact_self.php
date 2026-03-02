<?php
// Khai báo biến
$submitted = false;
$error = "";

// Kiểm tra form được submit hay chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'] ?? '';
    $email    = $_POST['email'] ?? '';
    $phone    = $_POST['phone'] ?? '';
    $message  = $_POST['message'] ?? '';

    // Validate cơ bản
    if (empty($fullname) || empty($email) || empty($phone) || empty($message)) {
        $error = "Missing Data";
    } else {
        $submitted = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Self Processing Contact Form</title>
</head>
<body>

<h2>Contact Us</h2>

<?php if ($submitted): ?>

    <!-- Hiện khi submit thành công -->
    <h3 style="color:green;">Thank you for contacting us!</h3>
    <p>We have received your message.</p>

    <ul>
        <li><strong>Full Name:</strong> <?= htmlspecialchars($fullname) ?></li>
        <li><strong>Email:</strong> <?= htmlspecialchars($email) ?></li>
        <li><strong>Phone:</strong> <?= htmlspecialchars($phone) ?></li>
        <li><strong>Message:</strong> <?= htmlspecialchars($message) ?></li>
    </ul>

<?php else: ?>

    <!-- Hiện form nếu CHƯA submit hoặc submit lỗi -->
    <?php
    if (!empty($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>

    <form method="post">
        <label>Full Name:</label><br>
        <input type="text" name="fullname"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email"><br><br>

        <label>Phone Number:</label><br>
        <input type="text" name="phone"><br><br>

        <label>Message:</label><br>
        <textarea name="message"></textarea><br><br>

        <button type="submit">Submit</button>
    </form>

<?php endif; ?>

</body>
</html>
