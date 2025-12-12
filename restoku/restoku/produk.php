<?php 
session_start();
include "koneksi.php"; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>🍴 Menu Makanan - Resto Ku</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to bottom right, #ffe6e6, #fff0f5);
      margin: 0;
      padding: 0;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #ffcccc;
      padding: 15px 40px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .navbar h2 {
      color: #ff6b81;
      font-size: 22px;
    }

    .navbar a {
      text-decoration: none;
      color: #333;
      margin: 0 10px;
      font-weight: 500;
      transition: 0.3s;
    }

    .navbar a:hover {
      color: #ff6b81;
    }

    .content {
      text-align: center;
      padding: 30px;
    }

    .produk-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 25px;
      padding: 40px;
      animation: fadeIn 1s ease-in;
    }

    .produk-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      overflow: hidden;
      transition: transform 0.3s ease;
      text-align: center;
      padding: 15px;
    }

    .produk-card:hover {
      transform: scale(1.05);
    }

    .produk-card img {
      width: 100%;
      height: 320px;
      object-fit: cover;
      border-radius: 15px;
    }

    .produk-card h4 {
      margin: 10px 0 5px;
      color: #ff6b81;
      font-size: 20px;
    }

    .produk-card p {
      font-size: 14px;
      color: #666;
    }

    select, input[type="number"] {
      padding: 5px;
      border-radius: 8px;
      border: 1px solid #ccc;
      margin: 5px;
    }

    button {
      background-color: #ff6b81;
      color: white;
      border: none;
      padding: 10px 18px;
      border-radius: 10px;
      cursor: pointer;
      margin-top: 10px;
      transition: 0.3s;
    }

    button:hover {
      background-color: #ff4d6d;
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
    </div>
  </div>

  <div class="content fade-in">
    <h3>🍱 Daftar Menu Kami</h3>
    <div class="produk-container">

      <?php
      $query = mysqli_query($koneksi, "SELECT * FROM produk");
      while ($row = mysqli_fetch_assoc($query)) {
          $file_path = "img/" . $row['gambar'];

          echo '<div class="produk-card">';

          // 🧩 Pengecekan gambar
          if (file_exists($file_path)) {
              echo "<img src='$file_path' alt='{$row['nama_produk']}'>";
          } else {
              echo "<div style='width:100%;height:320px;background:#ffe6e6;
                    display:flex;align-items:center;justify-content:center;
                    color:#ff6b81;border-radius:15px;'>
                    <p>⚠️ Gambar tidak ditemukan</p></div>";
          }

          echo "<h4>{$row['nama_produk']}</h4>";
          echo "<p>{$row['deskripsi']}</p>";
          echo "<p><b>Rp " . number_format($row['harga'], 0, ',', '.') . "</b></p>";
      ?>

          <form method="post" action="tambah_keranjang.php">
            <input type="hidden" name="id_produk" value="<?= $row['id_produk'] ?>">
            <label>Pilih Pedas:</label>
            <select name="level_pedas" required>
              <option value="Tidak Pedas">Tidak Pedas</option>
              <option value="Pedas">Pedas</option>
            </select>
            <label>Jumlah:</label>
            <input type="number" name="jumlah" min="1" value="1" required>
            <br>
            <button type="submit" name="tambah">Tambah ke Keranjang</button>
          </form>

      <?php
          echo "</div>";
      }
      ?>

    </div>
  </div>
</body>
</html>
