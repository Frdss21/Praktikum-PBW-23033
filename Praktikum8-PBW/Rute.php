<?php
$bandara_asal = [
    "Soekarno Hatta" => 65000,
    "Husein Sastranegara" => 50000,
    "Abdul Rachman Saleh" => 40000,
    "Juanda" => 30000
];

$bandara_tujuan = [
    "Ngurah Rai" => 85000,
    "Hasanuddin" => 70000,
    "Inanwatan" => 90000,
    "Sultan Iskandar Muda" => 60000
];

if (isset($_POST['submit'])) {
    $nama_maskapai = $_POST['nama_maskapai'];
    $bandara_asal_pilih = $_POST['bandara_asal'];
    $bandara_tujuan_pilih = $_POST['bandara_tujuan'];
    $harga_tiket = (int)$_POST['harga_tiket'];

    $tanggal = date('Y-m-d H:i:s');
    $pajak_asal = $bandara_asal[$bandara_asal_pilih];
    $pajak_tujuan = $bandara_tujuan[$bandara_tujuan_pilih];
    $total_pajak = $pajak_asal + $pajak_tujuan;
    $total_bayar = $harga_tiket + $total_pajak;

    $nomor = rand(1000, 9999);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rute Penerbangan</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #dbeafe, #93c5fd);
            margin: 0;
            padding: 30px;
        }
        .container {
            width: 800px;
            margin: auto;
        }
        form {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }
        h1, h2 {
            text-align: center;
            color: #1e40af;
        }
        label {
            font-weight: 600;
            color: #374151;
        }
        input, select {
            width: 100%;
            padding: 14px;
            margin-top: 8px;
            margin-bottom: 20px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            background: #f8fafc;
            transition: 0.3s;
        }
        input:focus, select:focus {
            background: #e0f2fe;
            border-color: #3b82f6;
            outline: none;
        }
        button {
            width: 100%;
            background: linear-gradient(90deg, #3b82f6, #2563eb);
            color: white;
            padding: 16px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background: linear-gradient(90deg, #2563eb, #1d4ed8);
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            margin-top: 20px;
        }
        .card-header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #1e3a8a;
            margin-bottom: 25px;
        }
        .card-body {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }
        .card-section {
            flex: 1;
            background: #f1f5f9;
            padding: 20px;
            border-radius: 15px;
            min-width: 320px;
        }
        .card-section h3 {
            margin-top: 0;
            color: #1e40af;
            border-bottom: 2px solid #93c5fd;
            padding-bottom: 8px;
            margin-bottom: 20px;
        }
        .card-section p {
            margin: 10px 0;
            color: #475569;
        }
        .total {
            color: #1d4ed8;
            font-weight: bold;
            font-size: 22px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>✈️ Pendaftaran Rute Penerbangan</h1>
    <form method="post">
        <label>Nama Maskapai</label>
        <input type="text" name="nama_maskapai" required>

        <label>Bandara Asal</label>
        <select name="bandara_asal" required>
            <?php foreach ($bandara_asal as $nama => $pajak) { ?>
                <option value="<?= $nama ?>"><?= $nama ?></option>
            <?php } ?>
        </select>

        <label>Bandara Tujuan</label>
        <select name="bandara_tujuan" required>
            <?php foreach ($bandara_tujuan as $nama => $pajak) { ?>
                <option value="<?= $nama ?>"><?= $nama ?></option>
            <?php } ?>
        </select>

        <label>Harga Tiket (Rp)</label>
        <input type="number" name="harga_tiket" required>

        <button type="submit" name="submit">Simpan Rute</button>
    </form>

    <?php if (isset($nomor)) { ?>
    <div class="card">
        <div class="card-header">🛫 Detail Penerbangan</div>
        <div class="card-body">
            <div class="card-section">
                <h3>📄 Info Penerbangan</h3>
                <p><b>Nomor:</b> <?= $nomor ?></p>
                <p><b>Tanggal:</b> <?= $tanggal ?></p>
                <p><b>Maskapai:</b> <?= htmlspecialchars($nama_maskapai) ?></p>
                <p><b>Asal:</b> <?= $bandara_asal_pilih ?></p>
                <p><b>Tujuan:</b> <?= $bandara_tujuan_pilih ?></p>
            </div>
            <div class="card-section">
                <h3>💵 Rincian Harga</h3>
                <p><b>Tiket:</b> Rp<?= number_format($harga_tiket, 0, ',', '.') ?></p>
                <p><b>Pajak Asal:</b> Rp<?= number_format($pajak_asal, 0, ',', '.') ?></p>
                <p><b>Pajak Tujuan:</b> Rp<?= number_format($pajak_tujuan, 0, ',', '.') ?></p>
                <p><b>Total Pajak:</b> Rp<?= number_format($total_pajak, 0, ',', '.') ?></p>
                <p class="total">Total Bayar: Rp<?= number_format($total_bayar, 0, ',', '.') ?></p>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

</body>
</html>