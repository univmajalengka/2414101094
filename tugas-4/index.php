<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Beranda - Paket Wisata</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<header>
    <h2>UMKM Paket Wisata</h2>
    <nav>
        <a href="index.php">Beranda</a>
        <a href="pemesanan.php">Pemesanan</a>
        <a href="daftar_pesanan.php">Daftar Pesanan</a>
    </nav>
</header>

<h3>Daftar Paket Wisata</h3>
<div class="paket-container">

    <div class="paket-card">
        <img src="img/alam1.jpg">
        <p>Paket A – Wisata Alam</p>
        <a href="https://www.youtube.com/live/hTcBL_bg29A?si=rKR6edbvAPIaLvAH" target="_blank">Video Promo</a>
        <br><a class="btn" href="pemesanan.php">Pesan Sekarang</a>
    </div>

    <div class="paket-card">
        <img src="img/pantai1.jpg">
        <p>Paket B – Pantai</p>
        <a href="https://youtu.be/K1QICrgxTjA?si=-v7o0Y210h9dR0a2" target="_blank">Video Promo</a>
        <br><a class="btn" href="pemesanan.php">Pesan Sekarang</a>
    </div>

    <div class="paket-card">
        <img src="img/gunung1.jpg">
        <p>Paket C – Pegunungan</p>
        <a href="https://youtu.be/QhSoNpADm7U?si=j3Qwggak6MrEVWgO" target="_blank">Video Promo</a>
        <br><a class="btn" href="pemesanan.php">Pesan Sekarang</a>
    </div>

</div>
</body>
</html>
