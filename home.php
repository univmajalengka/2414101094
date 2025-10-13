<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kedai Alya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Hero section */
    .hero {
        background: url('img/alya.jpeg') center/cover no-repeat;
        height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        position: relative;
    }
    .hero::after {
        content: "";
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5); /* lebih gelap biar teks jelas */
    }
    .hero-content { 
        position: relative; 
        z-index: 2; 
    }
    .hero h1 { 
        font-size: 3.5rem; 
        font-weight: bold; 
        color: #f1c40f; /* emas */
    }
    .hero p {
        font-size: 1.2rem;
        color: #fff;
    }
    .hero .btn {
        background-color: #f1c40f; /* emas */
        color: #1a2a3a; /* dark blue */
        border: none;
        font-weight: bold;
    }
    .hero .btn:hover {
        background-color: #d4ac0d; /* gold lebih gelap */
        color: #fff;
    }

    /* Judul section */
    h2 {
        color:rgb(82, 128, 173); /* dark blue */
        font-weight: bold;
    }

    /* Footer */
    footer {
        background-color:rgb(81, 120, 160) !important; /* dark blue */
        color: #ccc;
    }
    footer p {
        margin: 0;
    }
    footer span, footer a {
        color: #f1c40f;
        text-decoration: none;
    }
  </style>
</head>
<body>
<?php include "navbar.php"; ?>

<section class="hero">
  <div class="hero-content">
    <h1>Selamat Datang di <span class="text-warning">Kedai Alya</span></h1>
    <p>Nikmati menu favoritmu dengan suasana hangat & manis 💕</p>
    <a href="menu.php" class="btn btn-lg fw-bold">🍴 Lihat Menu</a>
  </div>
</section>

<section class="container my-5 text-center">
  <h2 class="mb-3">Tentang Kami</h2>
  <p>Kedai Alya menyediakan berbagai pilihan makanan dan minuman lezat dengan harga terjangkau. Cocok untuk makan siang, kumpul keluarga, ataupun pesan antar.</p>
</section>

<footer class="text-white text-center p-3">
  <p class="mb-0">© <?= date("Y") ?> Kedai Alya | Dibuat dengan ❤️</p>
</footer>
</body>
</html>
