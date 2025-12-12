<?php
include "koneksi.php";

$nama = $_POST['nama'];
$hp = $_POST['hp'];
$tanggal = $_POST['tanggal_pesan'];
$hari = $_POST['hari'];
$peserta = $_POST['peserta'];
$layanan = implode(", ", $_POST['layanan']);
$harga = $_POST['harga_paket'];
$total = $_POST['total_tagihan'];

mysqli_query($koneksi, "INSERT INTO pesanan VALUES(
    '', '$nama', '$hp', '$tanggal', '$hari', '$peserta', '$layanan', '$harga', '$total'
)");

header("Location: daftar_pesanan.php");
?>
