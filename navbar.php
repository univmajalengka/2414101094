<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$cartCount = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
?>
<nav class="navbar navbar-expand-lg" style="background:#1a2a3a;">
  <div class="container">
    <a class="navbar-brand fw-bold text-warning" href="index.php">🍽 Kedai Alya</a>
    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link text-light" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="menu.php">Menu</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="checkout.php">Checkout</a></li>
        <li class="nav-item">
          <a class="btn btn-warning ms-2" href="cart.php">
            🛒 Keranjang (<?= $cartCount ?>)
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
