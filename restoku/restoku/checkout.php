<?php
session_start();
include "koneksi.php";

// Matikan notice agar tampilan lebih bersih saat debug (tidak mematikan error penting)
error_reporting(E_ALL & ~E_NOTICE);

// Jika keranjang kosong, langsung arahkan kembali ke produk
if (empty($_SESSION['keranjang'])) {
    echo "<script>alert('Keranjang kosong. Silakan pilih produk dahulu.'); window.location='produk.php';</script>";
    exit;
}

$pesan_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bayar'])) {
    // Ambil & sanitasi input
    $nama    = mysqli_real_escape_string($koneksi, trim($_POST['nama'] ?? ''));
    $alamat  = mysqli_real_escape_string($koneksi, trim($_POST['alamat'] ?? ''));
    $no_hp   = mysqli_real_escape_string($koneksi, trim($_POST['no_hp'] ?? ''));
    $catatan = mysqli_real_escape_string($koneksi, trim($_POST['catatan'] ?? ''));

    // Validasi sederhana
    if ($nama === '' || $alamat === '' || $no_hp === '') {
        $pesan_error = "Nama, alamat, dan No HP wajib diisi.";
    } else {
        // Hitung total dan persiapkan data detail (cek produk ada)
        $total = 0;
        $detail_items = []; // array of ['id_produk'=>..,'jumlah'=>..,'level_pedas'=>..]

        foreach ($_SESSION['keranjang'] as $idx => $item) {
            // pastikan struktur item benar
            if (!isset($item['id_produk']) || !isset($item['jumlah'])) {
                continue; // lewati item yang rusak
            }
            $id_produk = (int)$item['id_produk'];
            $jumlah = (int)$item['jumlah'];
            $level_pedas = isset($item['level_pedas']) ? $item['level_pedas'] : 'Tidak Pedas';
            if ($jumlah <= 0) $jumlah = 1;

            // ambil harga produk dari DB dan pastikan produk masih ada
            $stmtP = $koneksi->prepare("SELECT harga FROM produk WHERE id_produk = ?");
            if (!$stmtP) {
                $pesan_error = "Gagal mempersiapkan query produk: " . $koneksi->error;
                break;
            }
            $stmtP->bind_param("i", $id_produk);
            $stmtP->execute();
            $resP = $stmtP->get_result();
            if ($resP && $resP->num_rows > 0) {
                $rowP = $resP->fetch_assoc();
                $harga = (float)$rowP['harga'];
                $subtotal = $harga * $jumlah;
                $total += $subtotal;
                $detail_items[] = [
                    'id_produk' => $id_produk,
                    'jumlah' => $jumlah,
                    'level_pedas' => $level_pedas
                ];
            }
            $stmtP->close();
        } // end foreach session

        if ($pesan_error === '') {
            // Mulai transaksi
            $koneksi->begin_transaction();

            // Insert ke tabel pesanan
            $stmt = $koneksi->prepare("INSERT INTO pesanan (nama_pembeli, alamat, no_hp, catatan, total_harga) VALUES (?, ?, ?, ?, ?)");
            if (!$stmt) {
                $pesan_error = "Gagal mempersiapkan query simpan pesanan: " . $koneksi->error;
            } else {
                $stmt->bind_param("ssssd", $nama, $alamat, $no_hp, $catatan, $total);
                $ok = $stmt->execute();
                if (!$ok) {
                    $pesan_error = "Gagal menyimpan pesanan: " . $stmt->error;
                    $stmt->close();
                    $koneksi->rollback();
                } else {
                    $id_pesanan = $koneksi->insert_id;
                    $stmt->close();

                    // Simpan detail pesanan (prepared)
                    $stmtDetail = $koneksi->prepare("INSERT INTO detail_pesanan (id_pesanan, id_produk, jumlah, level_pedas) VALUES (?, ?, ?, ?)");
                    if (!$stmtDetail) {
                        $pesan_error = "Gagal mempersiapkan query detail: " . $koneksi->error;
                        $koneksi->rollback();
                    } else {
                        foreach ($detail_items as $d) {
                            $stmtDetail->bind_param("iiis", $id_pesanan, $d['id_produk'], $d['jumlah'], $d['level_pedas']);
                            $ok2 = $stmtDetail->execute();
                            if (!$ok2) {
                                $pesan_error = "Gagal menyimpan detail pesanan: " . $stmtDetail->error;
                                break;
                            }
                        }

                        if ($pesan_error === '') {
                            $koneksi->commit();
                            // Kosongkan keranjang
                            unset($_SESSION['keranjang']);
                            echo "<script>alert('Pesanan berhasil disimpan. Terima kasih!'); window.location='sukses.php';</script>";
                            exit;
                        } else {
                            $koneksi->rollback();
                        }
                        $stmtDetail->close();
                    }
                }
            }
        } // end if no pesan_error
    } // end else validasi
} // end if POST
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Checkout - Resto Ku</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .form-container { max-width:520px; margin:40px auto; background:#fff; padding:24px; border-radius:12px; box-shadow:0 3px 10px rgba(0,0,0,0.08); }
    label{ font-weight:600; display:block; margin-top:10px; color:#333; }
    input, textarea { width:100%; padding:10px; border-radius:8px; border:1px solid #ddd; margin-top:6px; }
    button { background:#ff6b81; color:#fff; padding:12px 18px; border:none; border-radius:10px; margin-top:14px; cursor:pointer; }
    .error { background:#ffe6e6; color:#b00020; padding:10px; border-radius:8px; margin-bottom:10px; }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Checkout Pembelian 🧾</h2>

    <?php if ($pesan_error !== ''): ?>
      <div class="error">Error: <?php echo htmlspecialchars($pesan_error); ?></div>
    <?php endif; ?>

    <form method="post" novalidate>
      <label>Nama Lengkap</label>
      <input type="text" name="nama" required>

      <label>Alamat Lengkap</label>
      <textarea name="alamat" rows="3" required></textarea>

      <label>No HP</label>
      <input type="text" name="no_hp" required>

      <label>Catatan (opsional)</label>
      <textarea name="catatan" rows="2"></textarea>

      <button type="submit" name="bayar">Lanjut ke Pembayaran 💳</button>
    </form>
  </div>
</body>
</html>
