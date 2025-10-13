<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login_admin.php");
    exit();
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "kedai_alya");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses tambah menu baru
if (isset($_POST['tambah_menu'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "img/" . $gambar);

    $sql = "INSERT INTO menu (nama, harga, deskripsi, gambar) VALUES ('$nama', '$harga', '$deskripsi', '$gambar')";
    $conn->query($sql);
    header("Location: admin.php");
}

// Proses hapus menu
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM menu WHERE id=$id");
    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin | Kedai Alya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand fw-bold" href="#">👩‍🍳 Admin Kedai Alya</a>
    <div class="ms-auto">
        <a href="logout_admin.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <h3 class="mb-3">📋 Daftar Menu</h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $result = $conn->query("SELECT * FROM menu ORDER BY id DESC");
        $no = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['nama']}</td>
                    <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                    <td>{$row['deskripsi']}</td>
                    <td><img src='img/{$row['gambar']}' width='80'></td>
                    <td><a href='admin.php?hapus={$row['id']}' class='btn btn-sm btn-danger'>Hapus</a></td>
                </tr>";
            $no++;
        }
        ?>
        </tbody>
    </table>

    <hr>
    <h4>➕ Tambah Menu Baru</h4>
    <form method="POST" enctype="multipart/form-data" class="mt-3">
        <div class="mb-2">
            <label>Nama Menu</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="2"></textarea>
        </div>
        <div class="mb-2">
            <label>Upload Gambar</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" name="tambah_menu" class="btn btn-success mt-2">Tambah Menu</button>
    </form>
</div>

</body>
</html>
