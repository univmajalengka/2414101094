<?php
session_start();
include "data.php";

$order = $_SESSION['order'] ?? null;
$cart = $_SESSION['cart'] ?? [];
if (!$order || empty($cart)) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Nota Pemesanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f9f9f9; }
    h2 { color: #1a2a3a; font-weight: bold; }
    .card { border-color: #1a2a3a; }
    .card-header { background: #1a2a3a; color: #f1c40f; font-weight: bold; }
    .btn-warning {
        background: #f1c40f; border: none; color: #1a2a3a; font-weight: bold;
    }
    .btn-warning:hover { background: #d4ac0d; color: #fff; }
    footer { background: #1a2a3a; color: #ccc; }
    footer span { color: #f1c40f; }
  </style>
</head>
<body class="container py-5">

  <h2 class="mb-4 text-center">🧾 Nota Pemesanan</h2>

  <div class="card shadow">
    <div class="card-header">Detail Pemesan</div>
    <div class="card-body">
      <p><strong>Nama:</strong> <?= htmlspecialchars($order['nama']) ?></p>
      <p><strong>No. HP:</strong> <?= htmlspecialchars($order['hp']) ?></p>
      <p><strong>Tanggal Kunjungan:</strong> <?= htmlspecialchars($order['tanggal']) ?></p>
    </div>
  </div>

  <table class="table table-bordered mt-4 shadow text-center align-middle">
    <thead style="background:#1a2a3a; color:#f1c40f;">
      <tr>
        <th>Item</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $grand = 0;
      foreach ($cart as $id => $qty):
        $m = array_filter($menus, fn($x) => $x['id']==$id);
        $m = array_values($m)[0];
        $total = $m['harga'] * $qty;
        $grand += $total;
      ?>
      <tr>
        <td><?= $m['nama'] ?></td>
        <td>Rp <?= number_format($m['harga'],0,",",".") ?></td>
        <td><?= $qty ?></td>
        <td>Rp <?= number_format($total,0,",",".") ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h4 class="text-end mt-3">Grand Total: <span class="text-success">Rp <?= number_format($grand,0,",",".") ?></span></h4>

  <div class="text-center mt-4">
    <a href="index.php" class="btn btn-warning">🏠 Kembali ke Beranda</a>
  </div>

  <footer class="text-center mt-5 p-3">
    <p>© <?= date("Y") ?> Kedai Alya | <span>Elegan & Manis</span></p>
  </footer>
</body>
</html>
