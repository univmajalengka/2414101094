<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin | Resto Ku</title>
    <style>
        body { font-family: Arial; background: #f9f9f9; }
        h1 { color: #333; }
        table {
            width: 90%; margin: 20px auto; border-collapse: collapse;
            background: white; box-shadow: 0 0 10px #ccc;
        }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background: #ff6b6b; color: white; }
        a.logout {
            display: inline-block; background: #333; color: white;
            padding: 10px 15px; border-radius: 5px; text-decoration: none;
            margin: 15px;
        }
        a.logout:hover { background: #ff5252; }
    </style>
</head>
<body>
    <h1 align="center">📋 Daftar Pesanan</h1>
    <div align="center">
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Pemesan</th>
            <th>Menu</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Tanggal</th>
        </tr>
        <?php
        $no = 1;
        $pesanan = mysqli_query($koneksi, "SELECT * FROM pesanan ORDER BY id_pesanan DESC");
        while ($row = mysqli_fetch_assoc($pesanan)) {
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['nama_pelanggan']}</td>
                    <td>{$row['menu']}</td>
                    <td>{$row['jumlah']}</td>
                    <td>Rp " . number_format($row['total_harga']) . "</td>
                    <td>{$row['tanggal']}</td>
                </tr>";
            $no++;
        }
        ?>
    </table>
</body>
</html>
