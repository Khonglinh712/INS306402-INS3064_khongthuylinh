<?php
require_once __DIR__ . '/../classes/Database.php';

$db = Database::getInstance();

$id = (int) ($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$course = $db->fetch("SELECT * FROM courses WHERE id = ?", [$id]);
if (!$course) {
    header('Location: index.php');
    exit;
}

$title = $course['title'];
$description = $course['description'];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($title === '' || strlen($title) < 3) {
        $errors['title'] = 'Title must be at least 3 characters';
    }

    if (empty($errors)) {
        try {
            $db->update('courses', [
                'title' => $title,
                'description' => $description
            ], 'id = ?', [$id]);

            header('Location: index.php?updated=1');
            exit;

        } catch (Exception $e) {
            $errors['general'] = 'Update failed';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Course</title>
</head>
<body>

<h1>Edit Course</h1>

<?php if (!empty($errors['general'])): ?>
    <p style="color:red"><?= $errors['general'] ?></p>
<?php endif; ?>

<form method="post">
    <div>
        <label>Title:</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($title) ?>">
        <br>
        <span style="color:red"><?= $errors['title'] ?? '' ?></span>
    </div>

    <div>
        <label>Description:</label><br>
        <textarea name="description"><?= htmlspecialchars($description) ?></textarea>
    </div>

    <button type="submit">Update</button>
    <a href="index.php">Back</a>
</form>

</body>
</html>