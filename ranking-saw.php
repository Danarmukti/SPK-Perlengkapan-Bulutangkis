<?php include("includes/header.php");
if (!isset($_SESSION['loggedinadmin']) && !isset($_SESSION['loggedinuser'])) {
    echo "<script>window.location.href = 'login.php'</script>";
    exit;
}
include("includes/navbar-secondary.php");
if (!isset($_SESSION['hasil_ranking']) || !isset($_SESSION['ranking'])) {
    echo "<div class='container mt-5'><div class='alert alert-warning text-center'>Belum ada hasil ranking. Silakan lakukan pembobotan terlebih dahulu.</div></div>";
    include("includes/footer.php");
    exit;
}
$hasil = $_SESSION['hasil_ranking'];
$ranking = $_SESSION['ranking'];
usort($hasil, function ($a, $b) {
    return $b['skor'] <=> $a['skor'];
});
$no = 1;
?>
<div class="container mt-5 mb-5">
    <h2 class="text-center fw-bold mb-4">Hasil Ranking Pemilihan Perlengkapan Bulutangkis</h2>
    <table class="table table-bordered table-hover table-striped text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>Peringkat</th>
                <th>Alternatif</th>
                <th>Skor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hasil as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= number_format($row['skor'], 4) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="text-start mb-3">
    <a href="cetak-ranking.php" target="_blank" class="btn btn-outline-primary">
        <i class="fa-solid fa-print"></i> Cetak Laporan
    </a>
</div>
</div>
<?php include("includes/footer.php"); ?>
