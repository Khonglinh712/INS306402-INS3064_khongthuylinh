<?php
$errors = [];
$fieldErrors = [
    'username' => '',
    'email' => '',
    'password' => ''
];

$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate Username
    if (empty($username)) {
        $errors[] = "Username is required.";
        $fieldErrors['username'] = "error";
    }

    // Validate Email
    if (empty($email)) {
        $errors[] = "Email is required.";
        $fieldErrors['email'] = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
        $fieldErrors['email'] = "error";
    }

    // Validate Password
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
        $fieldErrors['password'] = "error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Error Summary Block</title>
    <style>
        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        .error {
            border: 2px solid red;
        }

        input {
            padding: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h2>Register Form</h2>

<?php if (!empty($errors)) : ?>
    <div class="alert">
        <strong>Please fix the following errors:</strong>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post">

    <label>Username:</label><br>
    <input type="text" name="username"
           value="<?php echo htmlspecialchars($username); ?>"
           class="<?php echo $fieldErrors['username']; ?>">
    <br>

    <label>Email:</label><br>
    <input type="text" name="email"
           value="<?php echo htmlspecialchars($email); ?>"
           class="<?php echo $fieldErrors['email']; ?>">
    <br>

    <label>Password:</label><br>
    <input type="password" name="password"
           class="<?php echo $fieldErrors['password']; ?>">
    <br>

    <button type="submit">Register</button>

</form>

</body>
</html>