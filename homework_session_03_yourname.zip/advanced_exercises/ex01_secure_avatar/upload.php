<?php
$message = "";

// Thư mục upload
$uploadDir = "uploads/";

// Tạo folder nếu chưa tồn tại
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_FILES['avatar'])) {
        $message = "No file uploaded.";
    } else {

        $file = $_FILES['avatar'];

        // 1️⃣ Kiểm tra lỗi upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $message = "Upload error.";
        } else {

            // 2️⃣ Kiểm tra kích thước (max 2MB)
            if ($file['size'] > 2 * 1024 * 1024) {
                $message = "File must be under 2MB.";
            } else {

                // 3️⃣ Kiểm tra MIME type thực sự
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $file['tmp_name']);
                finfo_close($finfo);

                $allowedTypes = ['image/jpeg', 'image/png'];

                if (!in_array($mime, $allowedTypes)) {
                    $message = "Only JPG and PNG allowed.";
                } else {

                    // 4️⃣ Tạo tên file unique
                    $extension = ($mime === 'image/jpeg') ? '.jpg' : '.png';
                    $newFileName = uniqid('avatar_', true) . $extension;

                    $destination = $uploadDir . $newFileName;

                    // 5️⃣ Move file an toàn
                    if (move_uploaded_file($file['tmp_name'], $destination)) {
                        $message = "Upload successful!";
                    } else {
                        $message = "Failed to save file.";
                    }
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Secure Avatar Upload</title>
</head>
<body>

<h2>Upload Your Avatar</h2>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="avatar" accept="image/jpeg, image/png">
    <button type="submit">Upload</button>
</form>

<br>

<?php
if (!empty($message)) {
    echo "<p>$message</p>";
}
?>

</body>
</html>