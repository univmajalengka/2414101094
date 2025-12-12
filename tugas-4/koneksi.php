<?php
$koneksi = mysqli_connect("localhost", "root", "", "wisata");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
