<?php
session_start();

// Jika sudah login, langsung ke admin
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: admin.php");
    exit();
}

// Data login admin
$admin_user = "admin";
$admin_pass = "12345";

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if ($user == $admin_user && $pass == $admin_pass) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kedai Alya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container text-center mt-5">
    <h1 class="fw-bold text-warning">🍜 Selamat Datang di Kedai Alya</h1>
    <p class="text-muted">Makanan lezat dan bergizi siap menemani harimu 🍽️</p>

    <div class="row justify-content-center mt-4">
        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h4 class="mb-3 text-center">👩‍🍳 Login Admin</h4>
                <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                <form method="POST">
                    <input type="text" name="username" placeholder="Username" class="form-control mb-2" required>
                    <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
                    <button type="submit" name="login" class="btn btn-warning w-100">Login</button>
                </form>
            </div>

            <div class="mt-3">
                <a href="home.php" class="btn btn-outline-secondary w-100">Masuk ke Landing Page 🍴</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
