<?php
session_start();
include "../koneksi.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $cek = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($cek);

    if ($data) {
        $_SESSION['admin'] = $data['nama_admin'];
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Username atau password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin | Resto Ku</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; }
        .login-box {
            background: white; padding: 30px; width: 300px;
            margin: 100px auto; border-radius: 10px; box-shadow: 0 0 10px #aaa;
        }
        input, button {
            width: 100%; padding: 10px; margin: 10px 0;
            border-radius: 5px; border: 1px solid #ccc;
        }
        button { background: #ff6b6b; color: white; border: none; cursor: pointer; }
        button:hover { background: #ff5252; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2 align="center">Login Admin 🍴</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
