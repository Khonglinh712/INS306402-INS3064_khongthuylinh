<?php
$username = $_GET['username'] ?? '';
$password = $_GET['password'] ?? '';

$bio = $_POST['bio'] ?? '';
$location = $_POST['location'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h2>Registration Complete</h2>";
    echo "<strong>Username:</strong> " . htmlspecialchars($username) . "<br>";
    echo "<strong>Password:</strong> " . htmlspecialchars($password) . "<br>";
    echo "<strong>Bio:</strong> " . htmlspecialchars($bio) . "<br>";
    echo "<strong>Location:</strong> " . htmlspecialchars($location) . "<br>";
    exit;
}
?>

<h2>Step 2 - Profile Info</h2>

<form method="post">

    <!-- Hidden fields to preserve Step1 data -->
    <input type="hidden" name="username" value="<?= htmlspecialchars($username) ?>">
    <input type="hidden" name="password" value="<?= htmlspecialchars($password) ?>">

    Bio:<br>
    <textarea name="bio"><?= htmlspecialchars($bio) ?></textarea><br><br>

    Location:
    <input name="location" value="<?= htmlspecialchars($location) ?>"><br><br>

    <button>Finish</button>
</form>