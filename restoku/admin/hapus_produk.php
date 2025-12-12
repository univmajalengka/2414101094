<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "../koneksi.php";

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk='$id'");

if ($query) {
    echo "<script>alert('Produk berhasil dihapus!');window.location='index.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus produk!');</script>";
}
?>
