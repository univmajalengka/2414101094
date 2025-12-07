DOKUMENTASI DETEKSI & ANALISIS ERROR


🧩 1. Daftar Error yang Ditemukan
No	Lokasi Error	Pesan Error / Indikasi	Jenis Error	Penyebab	Solusi
1	form-daftar.php baris 1	HTML tidak terdeteksi sebagai HTML5	Syntax	DOCTYPE salah → <!DOCTYPE >	Ubah ke <!DOCTYPE html>
2	proses-pendaftaran-2.php baris variabel input	Undefined variable	Syntax & Runtime	Variabel $sekolah ditulis tanpa $ → sekolah = ...	Perbaiki jadi $sekolah = $_POST['sekolah_asal'];
3	proses-pendaftaran-2.php bagian SQL	“You have an error in your SQL syntax”	SQL Syntax	Keyword VALUE salah → harus VALUES (jamak)	Ubah ke VALUES(...)
4	phpMyAdmin saat create table	#1046 - No database selected	Runtime	Database belum dipilih sebelum membuat tabel	Pilih DB dulu → lalu jalankan SQL
5	PHP saat submit form	Unknown database 'pendaftaran_siswa'	Runtime	Database tidak ada / nama salah	Buat database dengan nama tepat: pendaftaran_siswa
6	proses-pendaftaran-2.php	Tidak ada filter keamanan	Security Issue	Query langsung tanpa prepared statement	Gunakan prepared statement MySQLi
7	form-daftar.php	Data bisa kosong	Logic	Input tidak diberi required	Tambahkan required pada setiap field
8	koneksi.php	Potensi koneksi gagal	Runtime	Password DB tidak sesuai default XAMPP	Password dikosongkan → ""
🛠 2. Contoh Error Asli dari Browser
Error yang sempat kakak kirim (sudah benar dicatatkan)

Unknown database 'pendaftaran_siswa'

📌 Penyebab: Database belum dibuat / nama beda
📌 Solusi: Buat database sesuai koneksi → pendaftaran_siswa

💡 3. Perbaikan yang Sudah Dilakukan

✔ Perbaikan sintaks variabel PHP
✔ Perbaikan SQL → VALUES
✔ Tambah required pada form input
✔ Prepared Statement → mencegah SQL Injection
✔ Koneksi database disesuaikan XAMPP (tanpa password)
✔ Membuat database + tabel benar

🧪 4. Hasil Pengujian Setelah Perbaikan
Uji	Status
Form tampil	✔ Berhasil
Submit data	✔ Berhasil
Data masuk DB	✔ Tersimpan
Redirect status=sukses	✔ Berfungsi
Tidak ada error PHP	✔ Bersih
🎯 Kesimpulan

Sebelum perbaikan, program tidak bisa berjalan karena gabungan error sintaks, SQL, dan koneksi database.
Setelah diperbaiki sesuai best practices (diperintahkan dalam file tugas) 

