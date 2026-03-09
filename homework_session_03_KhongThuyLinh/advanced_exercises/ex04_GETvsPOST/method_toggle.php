<?php
$method = $_SERVER['REQUEST_METHOD'];
$data = [];

if ($method === 'GET' && !empty($_GET)) {
    $data = $_GET;
}

if ($method === 'POST' && !empty($_POST)) {
    $data = $_POST;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>GET vs POST Toggle</title>
</head>
<body>

<h2>GET vs POST Toggle Demo</h2>

<form id="demoForm" method="GET">
    
    <label>
        <input type="radio" name="method_select" value="GET" checked onclick="changeMethod('GET')">
        Send via GET
    </label>

    <label>
        <input type="radio" name="method_select" value="POST" onclick="changeMethod('POST')">
        Send via POST
    </label>

    <br><br>

    <label>Name:</label><br>
    <input type="text" name="name"><br><br>

    <label>Email:</label><br>
    <input type="text" name="email"><br><br>

    <button type="submit">Submit</button>
</form>

<hr>

<h3>Server Response</h3>

<p><strong>Detected Method:</strong> <?php echo $method; ?></p>

<?php if (!empty($data)) : ?>
    <pre>
<?php print_r($data); ?>
    </pre>
<?php endif; ?>

<script>
function changeMethod(method) {
    document.getElementById("demoForm").method = method;
}
</script>

</body>
</html>