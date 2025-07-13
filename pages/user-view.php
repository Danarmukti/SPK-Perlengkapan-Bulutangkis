<?php include("includes/header.php") ?>
    <div class="container-fluid px-4">
       <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">User
                    <a href="user-register.php" class="btn btn-primary float-end"><i class="fa-solid fa-user-plus"></i> Add User</a>
                </h4>
            </div>
            <div class="card-body">
                <?php alertMessage() ?>
                <?php 
                $user = getAll('user');
                if (!$user) {
                    echo '<h4>Something went Wrong! </h4>';
                    return false;
                }
                ?>
                <?php 
                            $user = getAll('user');
                            if (mysqli_num_rows($user) > 0) {
                                
                            ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php foreach ($user as $userItem):
                            ?>
                            <tr>
                                <td><?= $userItem['id'] ?></td>
                                <td><?= $userItem['name'] ?></td>
                                <td><?= $userItem['email'] ?></td>
                                <td>
                                    <button type="button" 
                                    class="btn btn-success editBtn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#exampleModal" 
                                    data-id=<?= $userItem['id'] ?>
                                    data-name=<?= $userItem['name'] ?>
                                    data-email=<?= $userItem['email'] ?>
                                     ><i class="fa-solid fa-pen"></i> Edit</button>
                                    <button type="button" 
                                    class="btn btn-danger deleteBtn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal" 
                                    data-iddelete=<?= $userItem['id'] ?>
                                     ><i class="fa-solid fa-trash"></i> Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                                <!-- editmodal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="code.php" method="POST">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
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
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="updateUser" class="btn btn-primary">Update user</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                </div>
                                <!-- deletemodal  -->
                                <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="code.php" method="POST">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete User Permanent</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" id="delete-id">
                                        Yakin ingin hapus permanen?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="deleteUser" class="btn btn-danger">Delete Permanent</button>
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