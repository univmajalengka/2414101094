<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "../koneksi.php";

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    if ($_FILES['gambar']['name'] != "") {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../assets/img/".$gambar);
        $update = mysqli_query($koneksi, "UPDATE produk SET 
                        nama_produk='$nama_produk', 
                        deskripsi='$deskripsi', 
                        harga='$harga',
                        gambar='$gambar'
                        WHERE id_produk='$id'");
    } else {
        $update = mysqli_query($koneksi, "UPDATE produk SET 
                        nama_produk='$nama_produk', 
                        deskripsi='$deskripsi', 
                        harga='$harga'
                        WHERE id_produk='$id'");
    }

    if ($update) {
        echo "<script>alert('Produk berhasil diperbarui!');window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui produk!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk - Resto Ku</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="fade-in">
    <div class="form-container">
        <h2>Edit Produk 🧁</h2>
        <form method="post" enctype="multipart/form-data">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" value="<?= $data['nama_produk'] ?>" required>

            <label>Deskripsi</label>
            <textarea name="deskripsi" required><?= $data['deskripsi'] ?></textarea>

            <label>Harga</label>
            <input type="number" name="harga" value="<?= $data['harga'] ?>" required>

            <label>Gambar (kosongkan jika tidak diganti)</label>
            <input type="file" name="gambar">

            <button type="submit" name="update">Perbarui</button>
            <a href="index.php" class="btn-back">Kembali</a>
        </form>
    </div>
</body>
</html>
