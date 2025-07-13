<?php include("includes/header.php");
?>
<div class="py-3 bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm rounded-4">
                    <div class="p-5">
                        <?= alertMessage() ?>
                        <h4 class="text-dark mb-3">Tambah User </h4>
                        <form action="code.php" method="post">
                            <div class="mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" required class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <label for="">Email</label>
                                <input type="text" name="email" required class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" required class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary w-100" name="registerUserBtn" type="submit"><i class="fa-solid fa-user-plus"></i> Tambah User</button>
                            </div>
                            <div class="mb-3">
                                <a href="user-view.php" class="btn btn-warning w-100" name="registerUserBtn" type="submit"> View user</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php") ?>