<?php
function hitungDiskon($totalBelanja)
{
    if ($totalBelanja >= 100000) {
        return 0.10 * $totalBelanja;
    } elseif ($totalBelanja >= 50000) {
        return 0.05 * $totalBelanja;
    } else {
        return 0;
    }
}

$hasil = false;

if (isset($_POST['totalBelanja'])) {
    $totalBelanja = $_POST['totalBelanja'];
    $diskon = hitungDiskon($totalBelanja);
    $totalBayar = $totalBelanja - $diskon;
    $hasil = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Perhitungan Diskon Lucu 🛍️</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ffd6ff, #e7c6ff, #c8b6ff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: #ffffff;
            padding: 25px;
            width: 380px;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            animation: fadeIn .8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h3 {
            background: #ffb3c6;
            padding: 10px;
            border-radius: 12px;
            font-size: 20px;
            color: #5a189a;
        }

        input {
            width: 95%;
            padding: 10px;
            border-radius: 10px;
            border: 2px solid #c8b6ff;
            outline: none;
            margin: 10px 0;
            font-size: 16px;
        }

        input:focus {
            border-color: #9d4edd;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #c77dff;
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            font-size: 17px;
            cursor: pointer;
            transition: .3s;
        }

        button:hover {
            background: #9d4edd;
            transform: scale(1.05);
        }

        table {
            margin: 15px auto 5px;
            width: 100%;
            font-size: 15px;
        }

        td {
            padding: 4px;
            text-align: left;
            color: #5a189a;
        }

        .total {
            font-weight: bold;
            font-size: 17px;
            color: #7b2cbf;
        }
    </style>
</head>
<body>

<div class="card">
    <h3>🛍️ Hitung Diskon Belanja</h3>

    <form action="" method="POST">
        <input type="number" name="totalBelanja" placeholder="Masukkan total belanja..." required>
        <button type="submit">Hitung Diskon 💸</button>
    </form>

    <?php if ($hasil) { ?>
    <table>
        <tr><td>Total Belanja</td><td>: Rp <?= number_format($totalBelanja, 0, ',', '.') ?></td></tr>
        <tr><td>Diskon</td><td>: Rp <?= number_format($diskon, 0, ',', '.') ?></td></tr>
        <tr><td class="total">Total Bayar</td><td class="total">: Rp <?= number_format($totalBayar, 0, ',', '.') ?></td></tr>
    </table>
    <?php } ?>
</div>

</body>
</html>
