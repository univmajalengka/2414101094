<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pesanan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<h2>Daftar Pesanan</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Nama</th>
    <th>HP</th>
    <th>Tgl Pesan</th>
    <th>Hari</th>
    <th>Peserta</th>
    <th>Layanan</th>
    <th>Harga</th>
    <th>Total</th>
    <th>Aksi</th>
</tr>

<?php
$data = mysqli_query($koneksi, "SELECT * FROM pesanan");
while ($d = mysqli_fetch_array($data)) {
?>
<tr>
    <td><?= $d['nama'] ?></td>
    <td><?= $d['hp'] ?></td>
    <td><?= $d['tanggal_pesan'] ?></td>
    <td><?= $d['hari'] ?></td>
    <td><?= $d['peserta'] ?></td>
    <td><?= $d['layanan'] ?></td>
    <td><?= $d['harga_paket'] ?></td>
    <td><?= $d['total_tagihan'] ?></td>
    <td>
        <a href="edit_pesanan.php?id=<?= $d['id'] ?>">Edit</a> |
        <a href="delete_pesanan.php?id=<?= $d['id'] ?>" onclick="return confirm('Hapus pesanan?')">Delete</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
