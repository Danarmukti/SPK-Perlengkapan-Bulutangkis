<?php include("includes/header.php") ?>

    <div class="container-fluid px-4">
       <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Perhitungan AHP
                </h4>
            </div>
            <div class="card-body">
                <?php alertMessage() ?>
                
                <?php
                list($dataKriteria, $matriks) = ambilMatriksAHP();
                ?>

                <div class="container">
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
                // Hitung AHP
                $hasilAHP = hitungAHP($matriks);
                $normalisasi = $hasilAHP['normalisasi'];
                $bobot = $hasilAHP['bobot'];
                ?>

                <!-- TABEL NORMALISASI -->
                <div class="container mt-5">
                    <h4 class="fw-bold mb-3">Normalisasi Matriks</h4>
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
                                <?php foreach ($normalisasi as $i => $baris): ?>
                                    <tr>
                                        <th><?= htmlspecialchars($dataKriteria[$i]['nama']) ?></th>
                                        <?php foreach ($baris as $n): ?>
                                            <td><?= round($n, 3) ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- TABEL BOBOT PRIORITAS -->
                <div class="container mt-4">
                    <h4 class="fw-bold mb-3">Bobot Prioritas Kriteria</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Kriteria</th>
                                    <th>Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataKriteria as $i => $k): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($k['nama']) ?></td>
                                        <td><?= round($bobot[$i], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- NILAI LAMBDA MAX, CI, CR -->
                <div class="container mt-4 mb-5">
                    <h4 class="fw-bold mb-3">Rasio Konsistensi</h4>
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>λmaks</th>
                            <td><?= round($hasilAHP['lambdaMax'], 3) ?></td>
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
                            <a href="hasil-saw.php" id="lihatranking" class="btn btn-primary">Lihat Ranking Perlengkapan</a>
                        </div>
                </div> 



    </div>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.editBtn');
        const deleteButtons = document.querySelectorAll('.deleteBtn');
        const idInput = document.getElementById('edit-id');
        const idDeleteInput = document.getElementById('delete-id');
        const nameInput = document.getElementById('edit-name');
        const emailInput = document.getElementById('edit-email');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                // edit
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const email = this.getAttribute('data-email');
                idInput.value = id;
                nameInput.value = name;
                emailInput.value = email;
                // edit
            });
        });
                // delete
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const idDelete = this.getAttribute('data-iddelete');
                idDeleteInput.value = idDelete;
            });
        });
                // delete

        });
        </script>
<?php include("includes/footer.php") ?>