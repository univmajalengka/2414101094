<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Ambil data produk
$query = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id_produk DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Menu | Admin Resto Ku</title>
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

    .container { width: 90%; margin: 30px auto; background: white; border-radius: 10px; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
    th { background: #ff6b6b; color: white; }
    tr:nth-child(even) { background: #f9f9f9; }

    .add-btn {
      display: inline-block;
      background: #ff6b6b;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

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
    <h2>Daftar Menu</h2>
    <a href="tambah_produk.php" class="add-btn">+ Tambah Menu</a>
    <table>
      <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
      </tr>

      <?php
      $no = 1;
      while ($data = mysqli_fetch_assoc($query)) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$data['nama_produk']}</td>
                <td>Rp " . number_format($data['harga'], 0, ',', '.') . "</td>
                <td>{$data['deskripsi']}</td>
                <td>
                  <a href='edit_produk.php?id={$data['id_produk']}'>Edit</a> | 
                  <a href='hapus_produk.php?id={$data['id_produk']}' onclick='return confirm(\"Hapus menu ini?\")'>Hapus</a>
                </td>
              </tr>";
        $no++;
      }
      ?>
    </table>
  </div>

</body>
</html>
