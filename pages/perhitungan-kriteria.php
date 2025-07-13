<?php include("includes/header.php") ?>

    <div class="container-fluid px-4">
       <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Kriteria
                    <a href="addKriteria.php" class="btn btn-primary float-end"><i class="fa-solid fa-plus"></i> Add Kriteria</a>
                </h4>
            </div>
            <div class="card-body">
                <?php alertMessage() ?>
                <?php 
                
                $kriteria = getAll('kriteria');
                if (!$kriteria) {
                    echo '<h4>Something went Wrong! </h4>';
                    return false;
                }
                
                ?>
                <?php 
                            $kriteria = getAll('kriteria');
                            if (mysqli_num_rows($kriteria) > 0) {
                                
                            ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode</th>
                                <th>Nama Kriteria</th>
                                <th>Jenis</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($kriteria as $kriteriaItem):
                            ?>
                            <tr>
                                <td><?= $kriteriaItem['id'] ?></td>
                                <td><?= $kriteriaItem['kode'] ?></td>
                                <td><?= $kriteriaItem['nama'] ?></td>
                                <td><?= $kriteriaItem['jenis'] ?></td>
                                <td>
                                    <button type="button" 
                                    class="btn btn-success editBtn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#exampleModal" 
                                    data-id=<?= $kriteriaItem['id'] ?>
                                    data-name=<?= $kriteriaItem['nama'] ?>
                                    data-kode=<?= $kriteriaItem['kode'] ?>
                                    data-jenis=<?= $kriteriaItem['jenis'] ?>
                                     ><i class="fa-solid fa-pen"></i> Edit</button>
                                    <button type="button" 
                                    class="btn btn-danger deleteBtn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal" 
                                    data-iddelete=<?= $kriteriaItem['id'] ?>
                                     ><i class="fa-solid fa-trash"></i> Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="code.php" method="POST">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kriteria</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <input type="hidden" name="id" id="edit-id">
                                        <div class="mb-3">
                                            <label class="col-form-label">Name:</label>
                                            <input type="text" class="form-control" name="nama" id="edit-name">
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Kode:</label>
                                            <input type="text" class="form-control" name="kode" id="edit-kode">
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">jenis:</label>
                                            <input type="text" class="form-control" name="jenis" id="edit-jenis">
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="updateKriteria" class="btn btn-primary">Update kriteria</button>
                                        </div>
                                    </div>
                                    </form>
                                    
                                </div>
                                
                                </div>
                                <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="code.php" method="POST">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Kriteria Permanent</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" id="delete-id">
                                        Yakin ingin hapus permanen?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="deleteKriteria" class="btn btn-danger">Delete Permanent</button>
                                    </div>
                                    </div>
                                    </form>
                                </div>
                                </div>                                         
                            <?php 
                            }
                            else { 
                            ?>    
                                <tr>
                                    <td colspan="5">No record Found</td>
                                </tr>

                            <?php    
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
       </div>
       <?php
                                $query = "SELECT * FROM kriteria";
                                $result = mysqli_query($conn, $query);

                                $kriteria = [];
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $kriteria[] = $row;
                                }
                                ?>
                                     <div class="mt-4">
                                        <h2 class="text-center fw-bold mb-4">Preferensi Pembobotan Kriteria</h2>
                                    <form action="code.php" method="post">
                                        <table class="table table-bordered text-center align-middle">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Kriteria 1</th>
                                                    <th>Lebih Penting</th>
                                                    <th>Daripada</th>
                                                    <th>Tingkat Kepentingan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($i = 0; $i < count($kriteria); $i++): ?>
                                                    <?php for ($j = $i + 1; $j < count($kriteria); $j++): ?>
                                                        <tr>
                                                            <td><?= $kriteria[$i]['nama'] ?></td>
                                                            <td>
                                                                <select name="preferensi[<?= $kriteria[$i]['id'] ?>][<?= $kriteria[$j]['id'] ?>][pilih]" class="form-select" required>
                                                                    <option value="<?= $kriteria[$i]['id'] ?>">Kriteria 1 lebih penting</option>
                                                                    <option value="<?= $kriteria[$j]['id'] ?>">Kriteria 2 lebih penting</option>
                                                                </select>
                                                            </td>
                                                            <td><?= $kriteria[$j]['nama'] ?></td>
                                                            <td>
                                                                <select name="preferensi[<?= $kriteria[$i]['id'] ?>][<?= $kriteria[$j]['id'] ?>][tingkat]" class="form-select" required>
                                                                    <option value="1">Sama penting</option>
                                                                    <option value="2">Cukup penting</option>
                                                                    <option value="3">Lebih penting</option>
                                                                    <option value="4">Sangat penting</option>
                                                                    <option value="5">Mutlak lebih penting</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    <?php endfor; ?>
                                                <?php endfor; ?>
                                            </tbody>
                                        </table>
                                        <div class="text-center mt-4">
                                            <button type="submit" name="itungBobot" class="btn btn-primary">Kirim Preferensi</button>
                                        </div>
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
        const kodeInput = document.getElementById('edit-kode');
        const jenisInput = document.getElementById('edit-jenis');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                // edit
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const kode = this.getAttribute('data-kode');
                const jenis = this.getAttribute('data-jenis');
                idInput.value = id;
                nameInput.value = name;
                kodeInput.value = kode;
                jenisInput.value = jenis;
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