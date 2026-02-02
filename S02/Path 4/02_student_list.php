<?php
$students = [
    ['name' => 'Alice', 'grade' => 90],
    ['name' => 'Bob', 'grade' => 75],
    ['name' => 'Charlie', 'grade' => 85],
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <style>
        table { border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 6px 10px; }
    </style>
</head>
<body>

<table>
    <tr>
        <th>Name</th>
        <th>Grade</th>
    </tr>

    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student['name']; ?></td>
            <td><?= $student['grade']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
