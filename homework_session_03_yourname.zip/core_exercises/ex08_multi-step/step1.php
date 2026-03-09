<?php
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (strlen($password) < 6) {
        $errors[] = "Password too short.";
    }

    if (empty($errors)) {
        // Pass data to step2
        header("Location: step2.php?username=" . urlencode($username) .
               "&password=" . urlencode($password));
        exit;
    }
}
?>

<h2>Step 1 - Account Info</h2>

<?php foreach ($errors as $e) echo "<p style='color:red'>$e</p>"; ?>

<form method="post">
    Username:
    <input name="username" value="<?= htmlspecialchars($username) ?>"><br><br>

    Password:
    <input type="password" name="password"><br><br>

    <button>Next</button>
</form>