<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "../koneksi.php";

if (isset($_POST['simpan'])) {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "../assets/img/".$gambar);

    $query = mysqli_query($koneksi, "INSERT INTO produk (nama_produk, deskripsi, harga, gambar)
                                    VALUES ('$nama_produk','$deskripsi','$harga','$gambar')");
    if ($query) {
        echo "<script>alert('Produk berhasil ditambahkan!');window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah produk!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk - Resto Ku</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="fade-in">
    <div class="form-container">
        <h2>Tambah Produk 🍜</h2>
        <form method="post" enctype="multipart/form-data">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" required>

            <label>Deskripsi</label>
            <textarea name="deskripsi" required></textarea>

            <label>Harga</label>
            <input type="number" name="harga" required>

            <label>Gambar</label>
            <input type="file" name="gambar" required>

            <button type="submit" name="simpan">Simpan</button>
            <a href="index.php" class="btn-back">Kembali</a>
        </form>
    </div>
</body>
</html>
