<?php
$errors = [];

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (strlen($password) < 6) {
        $errors[] = "Password too short (min 6 characters).";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sticky Form</title>
    <style>
        .error { color: red; }
    </style>
</head>
<body>

<h2>Sticky Form Demo</h2>

<?php if (!empty($errors)) : ?>
    <div class="error">
        <ul>
            <?php foreach ($errors as $e) : ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post">

    Name:
    <input type="text" name="name"
           value="<?= htmlspecialchars($name) ?>">
    <br><br>

    Email:
    <input type="text" name="email"
           value="<?= htmlspecialchars($email) ?>">
    <br><br>

    Password:
    <input type="password" name="password">
    <br><br>

    <button type="submit">Submit</button>
</form>

</body>
</html>