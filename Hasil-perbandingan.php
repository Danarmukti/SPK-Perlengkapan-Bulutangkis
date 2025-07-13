<?php include("includes/header.php");
if (!isset($_SESSION['loggedinadmin']) && !isset($_SESSION['loggedinuser'])) {
    echo "<script>window.location.href = 'user-login.php'</script>";
    exit;
}
?>
<?php include("includes/navbar-secondary.php"); ?>
                <?php
                list($dataKriteria, $matriks) = ambilMatriksAHP();
                ?>
                <div class="container mt-5">
                    <h4 class="fw-bold mb-3">Matriks Perbandingan Kriteria (AHP)</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Kriteria</th>
                                    <?php foreach ($dataKriteria as $k): ?>
                                        <th><?= htmlspecialchars($k['nama']) ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($matriks as $i => $baris): ?>
                                    <tr>
                                        <th class=""><?= htmlspecialchars($dataKriteria[$i]['nama']) ?></th>
                                        <?php foreach ($baris as $nilai): ?>
                                            <td><?= round($nilai, 4) ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                                
                            </tbody>
                        </table>
                      
                    </div>
                </div>

                <?php
                $hasilAHP = hitungAHP($matriks);
                $normalisasi = $hasilAHP['normalisasi'];
                $bobot = $hasilAHP['bobot'];
                ?>
                <div class="container mt-5">
                    <h4 class="fw-bold mb-3">Normalisasi Matriks</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Kriteria</th>
                                    <?php foreach ($dataKriteria as $k): ?>
                                        <th><?= htmlspecialchars($k['nama']) ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($normalisasi as $i => $baris): ?>
                                    <tr>
                                        <th><?= htmlspecialchars($dataKriteria[$i]['nama']) ?></th>
                                        <?php foreach ($baris as $n): ?>
                                            <td><?= round($n, 4) ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container mt-4">
                    <h4 class="fw-bold mb-3">Bobot Prioritas Kriteria</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle">
                            <thead class="table-success">
                                <tr>
                                    <th>Kriteria</th>
                                    <th>Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataKriteria as $i => $k): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($k['nama']) ?></td>
                                        <td><?= round($bobot[$i], 4) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container mt-4 mb-5">
                    <h4 class="fw-bold mb-3">Rasio Konsistensi</h4>
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>λmaks</th>
                            <td><?= round($hasilAHP['lambdaMax'], 4) ?></td>
                        </tr>
                        <tr>
                            <th>CI (Consistency Index)</th>
                            <td><?= round($hasilAHP['ci'], 4) ?></td>
                        </tr>
                        <tr>
                            <th>CR (Consistency Ratio)</th>
                            <td><?= round($hasilAHP['cr'], 4) ?> <?= $hasilAHP['cr'] < 0.1 ? '(Konsisten)' : '(Tidak Konsisten)' ?></td>
                        </tr>
                    </table>
                      <div class="text-center mt-4">
                            <a href="ranking-saw.php" id="lihatranking" class="btn btn-primary">Lihat Ranking Perlengkapan</a>
                        </div>
                </div>                                
<?php include("includes/footer.php") ?>