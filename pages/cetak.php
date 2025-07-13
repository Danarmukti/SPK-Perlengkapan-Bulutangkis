<?php 
require "../config/functions.php";
require "../config/dbcon.php";

$hasil = $_SESSION['hasil_ranking'];
// Urutkan berdasarkan peringkat
usort($hasil, function ($a, $b) {
    return $b['skor'] <=> $a['skor'];
});
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPK AHP SAW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
  <body>  

    <div class="container-fluid px-4">
       <div class="row">
            <div class="col-3 d-flex align-items-center justify-content-center">
                <img src="assets/img/logo.png" alt="Logo" style="width: 150px;" class="logo">
            </div>
            <div class="col-6 text-center">
                <h4>PB Garda Juara</h4>
                <p>Jl. Malaka No.26A, RT.5/RW.5, Cilangkap, Kec. Cipayung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13840</p>
                <p>Telp. +62 856-8453-545</p>
            </div>
            <div class="col-3"></div>
       </div>
       <div class="row">
            <div class="col"><hr></div>
       </div>
       <div class="row">
            <div class="col">
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
                <a href="ranking.php" class="btn btn-secondary">Kembali</a>
            </div>

            </div>
       </div>
    </div>
    

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/datatables-simple-demo.js"></script> -->
        
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/3.0.1/jspdf.umd.min.js" integrity="sha512-ad3j5/L4h648YM/KObaUfjCsZRBP9sAOmpjaT2BDx6u9aBrKFp7SbeHykruy83rxfmG42+5QqeL/ngcojglbJw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="assets/js/custom.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        

    </body>
</html>