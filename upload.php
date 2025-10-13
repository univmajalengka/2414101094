<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDir = "img/";
    $fileName = basename($_FILES["gambar"]["name"]);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
        echo "Upload berhasil! File tersimpan di: " . $targetFile;
    } else {
        echo "Upload gagal!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Upload Foto Menu</title>
</head>
<body>
  <h2>Upload Foto Menu</h2>
  <form action="upload.php" method="post" enctype="multipart/form-data">
      <input type="file" name="gambar" required>
      <button type="submit">Upload</button>
  </form>
</body>
</html>
