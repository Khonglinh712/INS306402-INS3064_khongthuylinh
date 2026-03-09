<?php
// Lấy query từ URL (GET)
$query = $_GET['q'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Search</title>
</head>
<body>

<h2>Search Page</h2>

<form method="get">
    <input 
        type="text" 
        name="q" 
        placeholder="Enter search term"
        value="<?= htmlspecialchars($query) ?>"
    >
    <button type="submit">Search</button>
</form>

<br>

<?php if (!empty($query)): ?>
    <p>You searched for: 
        <strong><?= htmlspecialchars($query) ?></strong>
    </p>
<?php endif; ?>

</body>
</html>