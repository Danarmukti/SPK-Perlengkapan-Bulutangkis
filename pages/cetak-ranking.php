<?php
session_start();
if (!isset($_SESSION['hasil_ranking'])) {
    echo "Tidak ada data ranking untuk dicetak.";
    exit;
}
$hasil = $_SESSION['hasil_ranking'];
// Urutkan berdasarkan peringkat
usort($hasil, function ($a, $b) {
    return $b['skor'] <=> $a['skor'];
});
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Ranking</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 40px;
            font-family: 'Times New Roman', Times, serif;
            background-color: #fff;
        }
        .border-box {
            border: 1px solid #000;
            padding: 20px;
            margin-top: 30px;
        }
        .logo {
            width: 80px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
        .kop h4 {
            font-weight: bold;
            margin-bottom: 0;
        }
        .kop p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- Kop Surat -->
    <div class="text-center kop mb-4">
        <img src="assets/img/logo.png" alt="Logo" class="logo float-start me-3">
        <h4>SPK PEMILIHAN PERLENGKAPAN BULUTANGKIS</h4>
        <p>PB Garda Juara</p>
        <p>Jl. Bulutangkis No. 88, Jakarta Timur</p>
        <p>Telp. 021-12345678</p>
    </div>

    <h5 class="text-center fw-bold mt-4 mb-3">LAPORAN HASIL RANKING</h5>

    <div class="border-box">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-secondary">
                <tr>
                    <th width="10%">Peringkat</th>
                    <th width="60%">Alternatif</th>
                    <th width="30%">Skor</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $peringkat = 1;
                foreach ($hasil as $row): ?>
                    <tr>
                        <td><?= $peringkat++ ?></td>
                        <td><?= $row['nama'] ?? $row['alternatif'] ?></td>
                        <td><?= number_format($row['skor'], 4) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p class="mt-4">
            Berdasarkan hasil perhitungan menggunakan metode AHP dan SAW, alternatif dengan skor tertinggi merupakan pilihan terbaik dalam pemilihan perlengkapan bulutangkis.
        </p>
    </div>

    <div class="text-end mt-5">
        <p>Jakarta, <?= date("d M Y") ?></p>
        <p class="mb-5">Admin</p>
        <p><strong>Danar Mukti</strong></p>
    </div>

    <div class="text-center no-print mt-4">
        <button onclick="window.print()" class="btn btn-primary">🖨️ Cetak Laporan</button>
        <a href="ranking-saw.php" class="btn btn-secondary">Kembali</a>
    </div>

</body>
</html>