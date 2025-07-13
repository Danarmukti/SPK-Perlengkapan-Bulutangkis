<?php include("includes/header.php") ?>
    <div class="container-fluid px-4">
       <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Nilai Alternatif
                </h4>
            </div>
            <div class="card-body">
                <?php alertMessage() ?>
                <?php
        $kriteriaQuery = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id");
        $kriteria = [];
        while ($row = mysqli_fetch_assoc($kriteriaQuery)) {
            $kriteria[] = $row;
        }
        $alternatifQuery = mysqli_query($conn, "SELECT * FROM alternatif ORDER BY id");
        $alternatif = [];
        while ($row = mysqli_fetch_assoc($alternatifQuery)) {
            $alternatif[] = $row;
        }
        $nilaiQuery = mysqli_query($conn, "SELECT * FROM nilai_alternatif");
        $nilai = [];
        while ($row = mysqli_fetch_assoc($nilaiQuery)) {
            $nilai[$row['id_alternatif']][$row['id_kriteria']] = $row['nilai'];
        }
        ?>
        <div class="container">
            <h3 class="fw-bold mb-4">Matriks Nilai Alternatif terhadap Kriteria</h3>
            <form action="code.php" method="post">
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Alternatif</th>
                                <?php foreach ($kriteria as $k): ?>
                                    <th><?= $k['nama'] ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alternatif as $alt): ?>
                                <tr>
                                    <td><?= $alt['nama'] ?></td>
                                    <?php foreach ($kriteria as $k): ?>
                                        <td>
                                            <input type="number" name="nilai[<?= $alt['id'] ?>][<?= $k['id'] ?>]"
                                                class="form-control text-center" min="1" max="5"
                                                value="<?= $nilai[$alt['id']][$k['id']] ?? '' ?>" required>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button type="submit" name='editalternatif' class="btn btn-primary">Simpan Perubahan</button>
            </form>
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