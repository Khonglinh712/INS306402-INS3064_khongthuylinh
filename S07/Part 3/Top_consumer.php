<?php

require_once 'Database.php';

$db = Database::getInstance()->getConnection();


// 1. Prepare and execute the SQL query
$sql = "
SELECT c.name, c.email, SUM(o.total_amount) AS total_spent
FROM customers c
JOIN orders o ON c.id = o.customer_id
GROUP BY c.id
ORDER BY total_spent DESC
LIMIT 3
";

$stmt = $db->prepare($sql);
$stmt->execute();


// 2. Fetch the results
$customers = $stmt->fetchAll();

?>

<!-- HTML Table Structure -->
<table border="1">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Total Spent</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($customers as $row): ?>

            <tr>
                <td><?= $row["name"] ?></td>
                <td><?= $row["email"] ?></td>
                <td><?= $row["total_spent"] ?></td>
            </tr>

        <?php endforeach; ?>

    </tbody>
</table>