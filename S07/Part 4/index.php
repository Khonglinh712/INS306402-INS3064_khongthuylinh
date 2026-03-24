<?php
require_once "Database.php";

$db = Database::getInstance()->getConnection();


// =========================
// GET FILTER VALUES
// =========================

$search = $_GET["search"] ?? "";
$category = $_GET["category"] ?? "";


// =========================
// LOAD CATEGORIES
// =========================

$catStmt = $db->query("SELECT id, name FROM categories");
$categories = $catStmt->fetchAll();


// =========================
// MAIN QUERY
// =========================

$sql = "
SELECT p.id, p.name, p.price, p.stock,
       c.name AS category_name
FROM products p
JOIN categories c ON p.category_id = c.id
WHERE 1
";

$params = [];

if ($search != "") {
    $sql .= " AND p.name LIKE :search ";
    $params["search"] = "%$search%";
}

if ($category != "") {
    $sql .= " AND c.id = :category ";
    $params["category"] = $category;
}

$stmt = $db->prepare($sql);
$stmt->execute($params);

$products = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Admin</title>

    <style>
        .low-stock {
            background-color: red;
            color: white;
        }
    </style>

</head>
<body>

<h2>Product Admin Dashboard</h2>


<!-- ========================= -->
<!-- SEARCH + FILTER -->
<!-- ========================= -->

<form method="GET">

    Search:
    <input type="text" name="search" value="<?= $search ?>">

    Category:
    <select name="category">
        <option value="">All</option>

        <?php foreach ($categories as $cat): ?>

            <option
                value="<?= $cat["id"] ?>"
                <?= ($category == $cat["id"]) ? "selected" : "" ?>
            >
                <?= $cat["name"] ?>
            </option>

        <?php endforeach; ?>

    </select>

    <button type="submit">Filter</button>

</form>


<br>


<!-- ========================= -->
<!-- TABLE -->
<!-- ========================= -->

<table border="1">

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Stock</th>
    </tr>

    <?php foreach ($products as $p): ?>

        <tr class="<?= ($p["stock"] < 10) ? "low-stock" : "" ?>">

            <td><?= $p["id"] ?></td>
            <td><?= $p["name"] ?></td>
            <td><?= $p["price"] ?></td>
            <td><?= $p["category_name"] ?></td>
            <td><?= $p["stock"] ?></td>

        </tr>

    <?php endforeach; ?>

</table>

</body>
</html>