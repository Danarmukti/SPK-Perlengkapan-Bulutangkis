<?php include("includes/header.php") ?>

    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h1 class="mt-4">DASHBOARD </h1>
                <?php alertMessage(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                    <div class="card card-body alert alert-info p-3">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Admin</p>
                        <h5 class="font-weight-bold mb-0 ">
                            <?= getCount('admins'); ?>
                        </h5>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card card-body alert alert-warning p-3">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Alternatif</p>
                        <h5 class="font-weight-bold mb-0">
                            <?= getCount('alternatif'); ?>
                        </h5>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card card-body alert alert-warning p-3">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total kriteria</p>
                        <h5 class="font-weight-bold mb-0">
                            <?= getCount('kriteria'); ?>
                        </h5>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card card-body alert alert-warning p-3">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total User</p>
                        <h5 class="font-weight-bold mb-0">
                            <?= getCount('user'); ?>
                        </h5>
                    </div>
                </div>
        </div>
    </div>
   
                      
<?php include("includes/footer.php") ?>