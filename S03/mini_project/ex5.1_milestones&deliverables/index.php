<?php session_start(); ?>

<h1>Home</h1>

<?php if (isset($_SESSION['user'])) : ?>
    <a href="profile.php">Profile</a>
    <a href="logout.php">Logout</a>
<?php else : ?>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
<?php endif; ?>