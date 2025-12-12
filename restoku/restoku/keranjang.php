<?php
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Keranjang - Resto Ku</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fff8f8;
      margin: 0;
      padding: 0;
    }
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #ffcccc;
      padding: 15px 30px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .navbar h2 {
      color: #ff6b81;
      margin: 0;
    }
    .navbar a {
      text-decoration: none;
      color: #333;
      background: white;
      padding: 6px 12px;
      border-radius: 6px;
    }
    .navbar a:hover {
      background-color: #ff6b81;
      color: white;
    }
    .content {
      max-width: 800px;
      margin: 40px auto;
      background: white;
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }
    th, td {
      border: 1px solid #ffd6d6;
      padding: 10px;
      text-align: center;
    }
    th {
      background-color: #ffe6e6;
    }
    .button {
      display: inline-block;
      margin-top: 15px;
      background-color: #ff6b81;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 8px;
    }
    .button:hover {
      background-color: #ff4d6d;
    }
    h3 {
      color: #ff4d6d;
      text-align: center;
    }
  </style>
</head>
<body class="fade-in">

  <div class="navbar">
    <h2>🛍️ Keranjang Belanja</h2>
    <a href="produk.php">⬅ Kembali ke Menu</a>
  </div>

  <div class="content fade-in">
    <h3>Daftar Pesanan Kamu</h3>

    <table>
      <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Pedas</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Total</th>
      </tr>

      <?php
      $no = 1;
      $total = 0;

      // Jika session keranjang ada dan tidak kosong
      if (!empty($_SESSION['keranjang'])) {
        foreach ($_SESSION['keranjang'] as $item) {
          $id_produk = $item['id_produk'];
          $query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'");

          // Pastikan produk ada di database
          if ($query && mysqli_num_rows($query) > 0) {
            $produk = mysqli_fetch_assoc($query);
            $subtotal = $produk['harga'] * $item['jumlah'];
            $total += $subtotal;
            echo "
            <tr>
              <td>$no</td>
              <td>{$produk['nama_produk']}</td>
              <td>{$item['level_pedas']}</td>
              <td>{$item['jumlah']}</td>
              <td>Rp " . number_format($produk['harga'], 0, ',', '.') . "</td>
              <td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>
            </tr>";
            $no++;
          }
        }
      } else {
        echo "<tr><td colspan='6'>Keranjang masih kosong!</td></tr>";
      }
      ?>
    </table>

    <h3>Total Bayar: Rp <?= number_format($total, 0, ',', '.') ?></h3>
    <?php if (!empty($_SESSION['keranjang'])): ?>
      <a href="checkout.php" class="button">Lanjut ke Pembayaran 💳</a>
    <?php endif; ?>
  </div>

</body>
</html>
