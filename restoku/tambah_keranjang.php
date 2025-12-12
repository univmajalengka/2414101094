<?php
session_start();
include "koneksi.php";

$id_produk = $_POST['id_produk'];
$level_pedas = $_POST['level_pedas'];
$jumlah = $_POST['jumlah'];

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

$_SESSION['keranjang'][] = [
    'id_produk' => $id_produk,
    'level_pedas' => $level_pedas,
    'jumlah' => $jumlah
];

echo "<script>alert('Produk ditambahkan ke keranjang!');window.location='produk.php';</script>";
?>
