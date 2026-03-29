<?php
require_once __DIR__ . '/../classes/Database.php';

$db = Database::getInstance();

$courses = $db->fetchAll("SELECT * FROM courses ORDER BY created_at DESC");

$message = '';
if (isset($_GET['success'])) $message = 'Thêm khóa học thành công!';
if (isset($_GET['updated'])) $message = 'Cập nhật thành công!';
if (isset($_GET['deleted'])) $message = 'Xóa thành công!';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Courses</title>
</head>
<body>

<h1>Courses</h1>

<?php if ($message): ?>
    <p style="color: green;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<a href="create.php">+ Add Course</a>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Created</th>
        <th>Action</th>
    </tr>

    <?php foreach ($courses as $c): ?>
    <tr>
        <td><?= $c['id'] ?></td>
        <td><?= htmlspecialchars($c['title']) ?></td>
        <td><?= htmlspecialchars($c['description']) ?></td>
        <td><?= $c['created_at'] ?></td>
        <td>
            <a href="edit.php?id=<?= $c['id'] ?>">Edit</a>
            <a href="delete.php?id=<?= $c['id'] ?>" onclick="return confirm('Delete?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>