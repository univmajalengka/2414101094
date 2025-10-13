<?php
session_start();
include "data.php";

// Beli langsung 1 item
if (isset($_GET['buy'])) {
    $_SESSION['cart'] = [ $_GET['buy'] => 1 ];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['order'] = [
        "nama" => $_POST['nama'],
        "hp" => $_POST['hp'],
        "tanggal" => $_POST['tanggal']
    ];
    header("Location: nota.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f9f9f9; }
    h2 { color: #1a2a3a; font-weight: bold; }
    .btn-primary {
        background-color: #1a2a3a; border: none;
    }
    .btn-primary:hover { background-color: #2c3e50; }
    footer {
        background: #1a2a3a; color: #ccc;
    }
    footer span { color: #f1c40f; }
  </style>
</head>
<body class="container py-5">
  <h2 class="mb-4 text-center">📝 Form Pemesanan</h2>
  <form method="post" class="shadow p-4 bg-white rounded">
    <div class="mb-3">
      <label class="form-label">Nama Pemesan</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">No. HP</label>
      <input type="text" name="hp" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Tanggal Kunjungan</label>
      <input type="date" name="tanggal" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">✅ Konfirmasi Pesanan</button>
  </form>

  <footer class="text-center mt-5 p-3">
    <p>© <?= date("Y") ?> Kedai Alya | <span>Elegan & Manis</span></p>
  </footer>
</body>
</html>
