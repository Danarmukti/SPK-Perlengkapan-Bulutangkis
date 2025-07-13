<?php include("includes/header.php") ?>
    <div class="container-fluid px-4">
       <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Hasil Saw
                </h4>
            </div>
            <div class="card-body">
                <?php alertMessage() ?>
                <?php
                $hasil = hitungSAW_dinamis();
                ?>
                <div class="container ">
                    <h3 class="fw-bold mb-4">Tabel Normalisasi SAW</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Alternatif</th>
                                    <?php
                                    if (!empty($hasil['data'][0]['normalisasi'])) {
                                        foreach ($hasil['data'][0]['normalisasi'] as $index => $_) {
                                            echo "<th>C" . ($index + 1) . "</th>";
                                        }
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($hasil['data'] as $baris): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($baris['nama']) ?></td>
                                        <?php foreach ($baris['normalisasi'] as $n): ?>
                                            <td><?= round($n, 3) ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                $bobotAHP = hitungBobotAHP_dinamis();
                $bobot = $bobotAHP['bobot']; 
                ?>
                <div class="container mt-5">
                    <h3 class="fw-bold mb-4">Tabel Normalisasi Terbobot SAW</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Alternatif</th>
                                    <?php
                                    if (!empty($hasil['data'][0]['normalisasi'])) {
                                        foreach ($hasil['data'][0]['normalisasi'] as $i => $_) {
                                            echo "<th>C" . ($i + 1) . "</th>";
                                        }
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($hasil['data'] as $baris): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($baris['nama']) ?></td>
                                        <?php foreach ($baris['normalisasi'] as $j => $r): ?>
                                            <td><?= round($r * $bobot[$j], 4) ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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