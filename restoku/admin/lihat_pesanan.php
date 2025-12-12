<?php
session_start();
include "../koneksi.php"; // panggil koneksi dari folder utama

// pastikan admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Ambil data dari tabel pesanan
$query = mysqli_query($koneksi, "SELECT * FROM pesanan ORDER BY id_pesanan DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Pesanan | Admin Resto Ku</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #fff0f0;
      margin: 0;
      padding: 0;
    }
    .navbar {
      background-color: #ff6b6b;
      color: white;
      padding: 15px;
      text-align: center;
      font-size: 22px;
      font-weight: bold;
    }
    .container {
      width: 90%;
      margin: 30px auto;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      padding: 20px;
    }
    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table, th, td {
      border: 1px solid #ddd;
    }
    th {
      background-color: #ff6b6b;
      color: white;
      padding: 10px;
    }
    td {
      padding: 10px;
      text-align: center;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    .back-btn {
      display: inline-block;
      background: #333;
      color: white;
      padding: 10px 15px;
      text-decoration: none;
      border-radius: 5px;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

  <div class="navbar">🍴 Admin Resto Ku</div>

  <div class="container">
    <a href="index.php" class="back-btn">⬅ Kembali</a>
    <h2>📦 Daftar Pesanan Masuk</h2>

    <table>
      <tr>
        <th>No</th>
        <th>Nama Pelanggan</th>
        <th>Alamat</th>
        <th>No HP</th>
        <th>Catatan</th>
        <th>Total Harga</th>
        <th>Tanggal</th>
      </tr>
      <?php 
      $no = 1;
      while ($data = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= htmlspecialchars($data['nama_pelanggan'] ?? '-') ?></td>
          <td><?= htmlspecialchars($data['alamat'] ?? '-') ?></td>
          <td><?= htmlspecialchars($data['no_hp'] ?? '-') ?></td>
          <td><?= htmlspecialchars($data['catatan'] ?? '-') ?></td>
          <td>Rp <?= number_format($data['total_harga'] ?? 0, 0, ',', '.') ?></td>
          <td><?= htmlspecialchars($data['tanggal'] ?? date('Y-m-d')) ?></td>
        </tr>
        <?php
      }
      ?>
    </table>
  </div>

</body>
</html>
