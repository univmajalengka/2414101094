<?php
include "koneksi.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$hp = $_POST['hp'];
$tanggal = $_POST['tanggal_pesan'];
$hari = $_POST['hari'];
$peserta = $_POST['peserta'];
$layanan = implode(", ", $_POST['layanan']);
$harga = $_POST['harga_paket'];
$total = $_POST['total_tagihan'];

$query = "UPDATE pesanan SET 
        nama='$nama',
        hp='$hp',
        tanggal_pesan='$tanggal',
        hari='$hari',
        peserta='$peserta',
        layanan='$layanan',
        harga_paket='$harga',
        total_tagihan='$total'
        WHERE id='$id'";

mysqli_query($koneksi, $query);

header("Location: daftar_pesanan.php");
?>
