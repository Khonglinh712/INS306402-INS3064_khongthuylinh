<?php
session_start();

if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_SESSION['attempts'] >= 3) {
        die("Access denied. Too many attempts.");
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $users = json_decode(file_get_contents('data/users.json'), true);

    foreach ($users as $user) {
        if ($user['username'] === $username &&
            password_verify($password, $user['password'])) {

            $_SESSION['user'] = $username;
            $_SESSION['attempts'] = 0;
            header("Location: profile.php");
            exit;
        }
    }

    $_SESSION['attempts']++;
    $error = "Invalid credentials.";
}
?>

<h2>Login</h2>
<p style="color:red"><?= $error ?></p>

<form method="post">
    Username: <input name="username"><br>
    Password: <input type="password" name="password"><br>
    <button>Login</button>
</form>