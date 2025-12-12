<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Resto Ku 🍱 - Selamat Datang</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #ffe6e6;
      animation: fadeIn 1s ease-in-out;
    }

    .navbar {
      background-color: #ff809f;
      color: white;
      padding: 15px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
    }

    .navbar a {
      color: white;
      text-decoration: none;
      margin: 0 12px;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .navbar a:hover {
      color: #ffe6e6;
    }

    .hero {
      text-align: center;
      padding: 60px 20px 40px;
    }

    .hero h1 {
      font-size: 38px;
      color: #333;
    }

    .hero span {
      color: #ff4d6d;
      font-weight: bold;
    }

    .hero p {
      font-size: 18px;
      color: #555;
      margin-bottom: 30px;
    }

    /* 🌸 INI BAGIAN GAMBAR DEPAN */
    .hero img {
      width: 80%;
      max-width: 800px;
      border-radius: 20px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.2);
      transition: transform 0.3s ease;
    }

    .hero img:hover {
      transform: scale(1.05);
    }

    .button {
      background-color: #ff4d6d;
      color: white;
      padding: 12px 24px;
      border-radius: 30px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s ease;
      display: inline-block;
      margin-top: 20px;
    }

    .button:hover {
      background-color: #e63950;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body class="fade-in">
  <div class="navbar">
    <h2>🍴 Resto Ku</h2>
    <div>
      <a href="index.php">Home</a>
      <a href="tentang.php">Tentang</a>
      <a href="produk.php">Menu</a>
      <a href="keranjang.php">Keranjang</a>
      <a href="kontak.php">Kontak</a>
      <a href="admin/login.php">Admin</a>
    </div>
  </div>

  <div class="hero fade-in">
    <h1>Selamat Datang di <span>Resto Ku</span></h1>
    <p>Nikmati berbagai pilihan makanan lezat, hangat, dan penuh cinta 💕</p>

    <!-- 🖼️ FOTO DEPAN TOKO -->
    <img src="img/alya.jpeg" alt="Foto depan resto" class="hero-img">


    <br>
    <a href="produk.php" class="button">🍛 Lihat Menu</a>
  </div>
</body>
</html>
