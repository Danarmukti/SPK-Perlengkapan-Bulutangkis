<?php include("includes/header.php") ?>
    <div class="container-fluid px-4">
       <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Admins/Staff
                    <a href="admins-create.php" class="btn btn-primary float-end"><i class="fa-solid fa-user-plus"></i> Add Admin</a>
                </h4>
            </div>
            <div class="card-body">
                <?php alertMessage() ?>
                <?php 
                $admins = getAll('admins');
                if (!$admins) {
                    echo '<h4>Something went Wrong! </h4>';
                    return false;
                }
                ?>
                <?php 
                            $admins = getAll('admins');
                            if (mysqli_num_rows($admins) > 0) {     
                            ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>     
                            <?php foreach ($admins as $adminItem):
                            ?>
                            <tr>
                                <td><?= $adminItem['id'] ?></td>
                                <td><?= $adminItem['name'] ?></td>
                                <td><?= $adminItem['email'] ?></td>
                                <td><?= $adminItem['phone'] ?></td>
                                <td>
                                    <?php
                                        if ($adminItem['is_ban']==1) {
                                            echo '<span class="badge bg-danger"> <i class="fa-solid fa-eye-slash"></i> Banned</span>';
                                        } else {
                                            echo '<span class="badge bg-success"> <i class="fa-solid fa-eye"></i> Active</span>';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <button type="button" 
                                    class="btn btn-success editBtn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#exampleModal" 
                                    data-id=<?= $adminItem['id'] ?>
                                    data-name=<?= $adminItem['name'] ?>
                                    data-email=<?= $adminItem['email'] ?>
                                    data-phone=<?= $adminItem['phone'] ?>
                                    data-isban=<?= $adminItem['is_ban'] ?>
                                     ><i class="fa-solid fa-pen"></i> Edit</button>
                                    <button type="button" 
                                    class="btn btn-danger deleteBtn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal" 
                                    data-iddelete=<?= $adminItem['id'] ?>
                                     ><i class="fa-solid fa-trash"></i> Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="code.php" method="POST">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Admin</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <input type="hidden" name="id" id="edit-id">
                                        <div class="mb-3">
                                            <label class="col-form-label">Name:</label>
                                            <input type="text" class="form-control" name="name" id="edit-name">
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Email:</label>
                                            <input type="email" class="form-control" name="email" id="edit-email">
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Phone:</label>
                                            <input type="text" class="form-control" name="phone" id="edit-phone">
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label">Ban (Check = ban, Uncheck = unban) </label>
                                            <br>
                                            <input type="checkbox" name="is_ban" style="width: 30px; height:30px;"; id="edit-isban"/>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="updateAdmin" class="btn btn-primary">Update Admin</button>
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
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Admin Permanent</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" id="delete-id">
                                        Yakin ingin hapus permanen?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="deleteAdmin" class="btn btn-danger">Delete Permanent</button>
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

    </div>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.editBtn');
        const deleteButtons = document.querySelectorAll('.deleteBtn');
        const idInput = document.getElementById('edit-id');
        const idDeleteInput = document.getElementById('delete-id');
        const nameInput = document.getElementById('edit-name');
        const emailInput = document.getElementById('edit-email');
        const phoneInput = document.getElementById('edit-phone');
        const is_banInput = document.getElementById('edit-isban');
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                // edit
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const email = this.getAttribute('data-email');
                const phone = this.getAttribute('data-phone');
                const is_ban = this.getAttribute('data-isban');
                idInput.value = id;
                nameInput.value = name;
                emailInput.value = email;
                phoneInput.value = phone;
                if (is_ban == 0) {
                    is_banInput.checked = false;
                } else {
                    is_banInput.checked = true;

                }
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