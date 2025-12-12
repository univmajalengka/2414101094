<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin | Resto Ku</title>
  <style>
    body { font-family: Arial; background: #fff8f8; margin: 0; padding: 0; }
    .navbar {
      background-color: #ff6b6b;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 40px;
    }
    .navbar a { color: white; text-decoration: none; margin: 0 10px; font-weight: bold; }
    .navbar a:hover { text-decoration: underline; }

    .container {
      text-align: center;
      padding: 50px;
    }

    .card {
      display: inline-block;
      background: white;
      border-radius: 10px;
      padding: 30px;
      margin: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 250px;
      transition: 0.2s;
    }

    .card:hover {
      transform: scale(1.05);
    }

    .card h3 { color: #ff6b6b; }
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <h2>🍴 Admin Resto Ku</h2>
    <div>
      <a href="index.php">🏠 Dashboard</a>
      <a href="produk.php">🍜 Kelola Menu</a>
      <a href="lihat_pesanan.php">🧾 Pesanan</a>
      <a href="logout.php" onclick="return confirm('Yakin ingin logout?')">🚪 Logout</a>
    </div>
  </div>

  <div class="container">
    <h1>Selamat Datang, <?php echo $_SESSION['admin']; ?>!</h1>
    <p>Kelola data restoranmu dengan mudah dari panel ini.</p>

    <div class="card">
      <h3>🍜 Kelola Menu</h3>
      <p>Tambah, ubah, atau hapus menu makanan & minuman.</p>
      <a href="produk.php">Lihat Menu</a>
    </div>

    <div class="card">
      <h3>🧾 Lihat Pesanan</h3>
      <p>Lihat daftar pesanan pelanggan terbaru.</p>
      <a href="lihat_pesanan.php_
