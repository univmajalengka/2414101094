<?php
session_start();
include "data.php";

// Ubah jumlah item
if (isset($_GET['action'])) {
    $id = $_GET['id'];
    if ($_GET['action'] == "plus") $_SESSION['cart'][$id]++;
    if ($_GET['action'] == "minus") {
        $_SESSION['cart'][$id]--;
        if ($_SESSION['cart'][$id] <= 0) unset($_SESSION['cart'][$id]);
    }
    if ($_GET['action'] == "remove") unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Keranjang Belanja</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
        background-color: #f9f9f9;
    }
    h2 {
        color: #1a2a3a; /* dark blue */
        font-weight: bold;
    }
    .table thead {
        background-color: #1a2a3a;
        color: #f1c40f; /* gold */
    }
    .btn-primary {
        background-color: #1a2a3a;
        border: none;
    }
    .btn-primary:hover {
        background-color: #2c3e50;
    }
    .btn-warning {
        background-color: #f1c40f;
        border: none;
        color: #1a2a3a;
        font-weight: bold;
    }
    .btn-warning:hover {
        background-color: #d4ac0d;
        color: #fff;
    }
    footer {
        background-color: #1a2a3a;
        color: #ccc;
    }
    footer p {
        margin: 0;
    }
    footer span {
        color: #f1c40f;
    }
  </style>
</head>
<body class="container py-5">

  <h2 class="mb-4 text-center">🛒 Keranjang Belanja</h2>
  
  <table class="table table-bordered text-center align-middle shadow">
    <thead>
      <tr>
        <th>Item</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Total</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $grand = 0;
    if (!empty($_SESSION['cart'])):
      foreach ($_SESSION['cart'] as $id => $qty):
        $m = array_filter($menus, fn($x) => $x['id']==$id);
        $m = array_values($m)[0];
        $total = $m['harga'] * $qty;
        $grand += $total;
    ?>
      <tr>
        <td><?= $m['nama'] ?></td>
        <td>Rp <?= number_format($m['harga'],0,",",".") ?></td>
        <td>
          <a href="?action=minus&id=<?= $id ?>" class="btn btn-sm btn-secondary">-</a>
          <strong><?= $qty ?></strong>
          <a href="?action=plus&id=<?= $id ?>" class="btn btn-sm btn-secondary">+</a>
        </td>
        <td>Rp <?= number_format($total,0,",",".") ?></td>
        <td><a href="?action=remove&id=<?= $id ?>" class="btn btn-danger btn-sm">Hapus</a></td>
      </tr>
    <?php endforeach; else: ?>
      <tr>
        <td colspan="5" class="text-muted">Keranjang masih kosong</td>
      </tr>
    <?php endif; ?>
    </tbody>
  </table>

  <h4 class="text-end">Grand Total: <span class="text-success">Rp <?= number_format($grand,0,",",".") ?></span></h4>

  <div class="d-flex justify-content-between mt-4">
    <a href="index.php" class="btn btn-warning">⬅️ Lanjut Belanja</a>
    <?php if ($grand > 0): ?>
      <a href="checkout.php" class="btn btn-primary">✅ Checkout</a>
    <?php endif; ?>
  </div>

  <footer class="text-center mt-5 p-3">
    <p>© <?= date("Y") ?> Kedai Alya | <span>Elegan & Manis</span></p>
  </footer>
</body>
</html>
