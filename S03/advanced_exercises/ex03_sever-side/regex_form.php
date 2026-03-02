<?php
$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // 1️⃣ Validate Username (chỉ chữ và số)
    if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        $errors[] = "Username must contain only alphanumeric characters.";
    }

    // 2️⃣ Validate Password từng điều kiện

    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password missing uppercase letter.";
    }

    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = "Password missing lowercase letter.";
    }

    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Password missing number.";
    }

    if (!preg_match('/[\W_]/', $password)) {
        $errors[] = "Password missing special symbol.";
    }

    if (empty($errors)) {
        $success = "Registration successful!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Regex Validation Form</title>
</head>
<body>

<h2>Register</h2>

<form method="post">
    <label>Username:</label><br>
    <input type="text" name="username"><br><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Register</button>
</form>

<br>

<?php
if (!empty($errors)) {
    echo "<ul style='color:red;'>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
}

if (!empty($success)) {
    echo "<p style='color:green;'>$success</p>";
}
?>

</body>
</html>