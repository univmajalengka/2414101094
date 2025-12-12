<!DOCTYPE html>
<html>
<head>
    <title>Pemesanan Paket Wisata</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>
<header>
    <h2>Pemesanan Paket Wisata</h2>
    <nav>
        <a href="index.php">Beranda</a>
        <a href="pemesanan.php">Pemesanan</a>
        <a href="daftar_pesanan.php">Daftar Pesanan</a>
    </nav>
</header>

<form action="simpan_pesanan.php" method="POST" onsubmit="return validasi()">
    <label>Nama Pemesan</label>
    <input type="text" id="nama" name="nama">

    <label>No HP</label>
    <input type="text" id="hp" name="hp">

    <label>Tanggal Pesan</label>
    <input type="date" id="tgl" name="tanggal_pesan">

    <label>Waktu (Hari)</label>
    <input type="number" id="hari" name="hari">

    <label>Jumlah Peserta</label>
    <input type="number" id="peserta" name="peserta">

    <label>Pilih Layanan</label><br>
    <input type="checkbox" name="layanan[]" value="Penginapan" onclick="hitung()"> Penginapan (Rp 1.000.000)<br>
    <input type="checkbox" name="layanan[]" value="Transportasi" onclick="hitung()"> Transportasi (Rp 1.200.000)<br>
    <input type="checkbox" name="layanan[]" value="Makanan" onclick="hitung()"> Makanan (Rp 500.000)<br><br>

    <label>Harga Paket Perjalanan</label>
    <input type="text" id="harga" name="harga_paket" readonly>

    <label>Total Tagihan</label>
    <input type="text" id="total" name="total_tagihan" readonly>

    <button type="submit">Simpan Pesanan</button>
</form>

</body>
</html>
