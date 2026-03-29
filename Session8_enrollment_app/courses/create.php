<?php
require_once __DIR__ . '/../classes/Database.php';

$errors = [];
$title = '';
$description = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($title === '' || strlen($title) < 3) {
        $errors['title'] = 'Title must be at least 3 characters';
    }

    if (empty($errors)) {
        try {
            $db = Database::getInstance();

            $db->insert('courses', [
                'title' => $title,
                'description' => $description
            ]);

            header('Location: index.php?success=1');
            exit;

        } catch (Exception $e) {
            $errors['general'] = 'Something went wrong';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Course</title>
</head>
<body>

<h1>Add Course</h1>

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

    <button type="submit">Save</button>
    <a href="index.php">Back</a>
</form>

</body>
</html>