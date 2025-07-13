<?php include("includes/header.php");
if (!isset($_SESSION['loggedinadmin']) && !isset($_SESSION['loggedinuser'])) {
    echo "<script>window.location.href = 'user-login.php'</script>";
    exit;
}
?>
    <?php include("includes/navbar-secondary.php"); ?>

    <h1 class="container mt-5 mb-5 justify-content-center text-center">Welcome 
        <?php if(isset($_SESSION['loggedinadmin']) && is_array($_SESSION['loggedinadmin'])): ?>
            <?= $_SESSION['loggedinadmin']['name'] ?>
        <?php elseif(isset($_SESSION['loggedinuser']) && is_array($_SESSION['loggedinuser'])): ?>
            <?= $_SESSION['loggedinuser']['name'] ?>
        <?php endif; ?>
    </h1>
    <main class="container mb-5">
            <div class="row">
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <h1 class="">
                        <p class="fw-bold">
                        Sistem Pendukung Keputusan pemilihan Perlengkapan bulutangkis Terbaik Menggunakan Metode AHP & SAW (Studi Kasus: PB Garda Juara)
                        </p>
                        <a href="pemilihan.php" class="btn btn-primary">Lakukan Pemilihan</a>
                    </h1>
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                    <img class="rounded-5 shadow " src="assets/img/S__12959749.jpg" style="width:500px; height:500px; object-fit: cover;" alt="pic">
                </div>
            </div>
    </main>
<?php include("includes/footer.php") ?>