<?php
include "koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM pesanan WHERE id='$id'");
$pesanan = mysqli_fetch_assoc($data);

// Pisahkan layanan menjadi array untuk checkbox
$layanan_terpilih = explode(", ", $pesanan['layanan']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pesanan</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>
<header>
    <h2>Edit Pesanan</h2>
    <nav>
        <a href="index.php">Beranda</a>
        <a href="pemesanan.php">Pemesanan</a>
        <a href="daftar_pesanan.php">Daftar Pesanan</a>
    </nav>
</header>

<form action="update_pesanan.php" method="POST">
    <input type="hidden" name="id" value="<?= $pesanan['id'] ?>">

    <label>Nama Pemesan</label>
    <input type="text" name="nama" value="<?= $pesanan['nama'] ?>">

    <label>No HP</label>
    <input type="text" name="hp" value="<?= $pesanan['hp'] ?>">

    <label>Tanggal Pesan</label>
    <input type="date" name="tanggal_pesan" value="<?= $pesanan['tanggal_pesan'] ?>">

    <label>Waktu (Hari)</label>
    <input type="number" id="hari" name="hari" value="<?= $pesanan['hari'] ?>" oninput="hitung()">

    <label>Jumlah Peserta</label>
    <input type="number" id="peserta" name="peserta" value="<?= $pesanan['peserta'] ?>" oninput="hitung()">

    <label>Pilih Layanan</label><br>

    <input type="checkbox" name="layanan[]" value="Penginapan"
        <?php if (in_array("Penginapan", $layanan_terpilih)) echo "checked"; ?>
        onclick="hitung()"> Penginapan (Rp 1.000.000) <br>

    <input type="checkbox" name="layanan[]" value="Transportasi"
        <?php if (in_array("Transportasi", $layanan_terpilih)) echo "checked"; ?>
        onclick="hitung()"> Transportasi (Rp 1.200.000) <br>

    <input type="checkbox" name="layanan[]" value="Makanan"
        <?php if (in_array("Makanan", $layanan_terpilih)) echo "checked"; ?>
        onclick="hitung()"> Makanan (Rp 500.000) <br><br>

    <label>Harga Paket Perjalanan</label>
    <input type="text" id="harga" name="harga_paket" value="<?= $pesanan['harga_paket'] ?>" readonly>

    <label>Total Tagihan</label>
    <input type="text" id="total" name="total_tagihan" value="<?= $pesanan['total_tagihan'] ?>" readonly>

    <button type="submit">Update Pesanan</button>
</form>

</body>
</html>
