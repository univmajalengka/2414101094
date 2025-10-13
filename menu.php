<?php
session_start();
include "data.php";

// Tambah ke keranjang
if (isset($_GET['add'])) {
    $id = $_GET['add'];
    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = 1;
    } else {
        $_SESSION['cart'][$id]++;
    }
    header("Location: menu.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Menu Kedai Alya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f9f9f9; }
    h2 { color: #1a2a3a; font-weight: bold; }
    .card { transition: 0.3s; }
    .card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
    .btn-primary {
        background-color: #1a2a3a; border: none;
    }
    .btn-primary:hover { background-color: #2c3e50; }
    .btn-warning {
        background: #f1c40f; border: none; color: #1a2a3a; font-weight: bold;
    }
    .btn-warning:hover { background: #d4ac0d; color: #fff; }
    footer { background: #1a2a3a; color: #ccc; }
    footer span { color: #f1c40f; }
  </style>
</head>
<body>
<?php include "navbar.php"; ?>

<div class="container my-5">
  <h2 class="text-center mb-4">🍴 Menu Kami</h2>
  <div class="row">
    <?php foreach ($menus as $m): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <img src="<?= $m['gambar'] ?>" class="card-img-top" alt="<?= $m['nama'] ?>">
          <div class="card-body text-center">
            <h5 class="card-title"><?= $m['nama'] ?></h5>
            <p class="card-text">Rp <?= number_format($m['harga'],0,",",".") ?></p>
            <a href="?add=<?= $m['id'] ?>" class="btn btn-warning btn-sm">+ Keranjang</a>
            <a href="checkout.php?buy=<?= $m['id'] ?>" class="btn btn-primary btn-sm">Beli Sekarang</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<footer class="text-center p-3">
  <p class="mb-0">© <?= date("Y") ?> Kedai Alya | <span>Elegan & Manis</span></p>
</footer>

</body>
</html>
