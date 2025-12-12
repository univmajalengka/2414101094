<?php
session_start();
include 'config.php';

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];
$catatan = $_POST['catatan'];

$total_harga = 0;
foreach ($_SESSION['keranjang'] as $item) {
    $id = $item['id_produk'];
    $data = mysqli_query($koneksi, "SELECT harga FROM produk WHERE id_produk='$id'");
    $p = mysqli_fetch_assoc($data);
    $total_harga += $p['harga'] * $item['jumlah'];
}

// Simpan ke tabel pesanan
mysqli_query($koneksi, "INSERT INTO pesanan (nama_pembeli, alamat, no_hp, catatan, total_harga)
VALUES ('$nama', '$alamat', '$no_hp', '$catatan', '$total_harga')");

$id_pesanan = mysqli_insert_id($koneksi);

// Simpan detail pesanan
foreach ($_SESSION['keranjang'] as $item) {
    $id_produk = $item['id_produk'];
    $jumlah = $item['jumlah'];
    $level = $item['level_pedas'];
    $data = mysqli_query($koneksi, "SELECT harga FROM produk WHERE id_produk='$id_produk'");
    $p = mysqli_fetch_assoc($data);
    $subtotal = $p['harga'] * $jumlah;

    mysqli_query($koneksi, "INSERT INTO detail_pesanan (id_pesanan, id_produk, jumlah, level_pedas, subtotal)
    VALUES ('$id_pesanan', '$id_produk', '$jumlah', '$level', '$subtotal')");
}

unset($_SESSION['keranjang']);
header("Location: sukses.php");
?>
