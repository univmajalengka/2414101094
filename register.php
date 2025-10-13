<?php
session_start();
$conn = new mysqli("localhost", "root", "", "kedai_alya");

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($cek->num_rows > 0) {
        $error = "Username sudah digunakan!";
    } else {
        $conn->query("INSERT INTO users (nama, username, password) VALUES ('$nama', '$username', '$password')");
        echo "<script>alert('Pendaftaran berhasil! Silakan login.');window.location='login_user.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi | Kedai Alya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container">
    <div class="card mt-5 mx-auto" style="max-width:400px;">
        <div class="card-body">
            <h3 class="text-center mb-3">📝 Daftar Akun Baru</h3>

            <?php if (isset($error)) { ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php } ?>

            <form method="POST">
                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="register" class="btn btn-success w-100">Daftar</button>
            </form>

            <p class="mt-3 text-center">Sudah punya akun? <a href="login_user.php">Login</a></p>
        </div>
    </div>
</div>

</body>
</html>
