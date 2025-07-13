<?php include("includes/header.php");
if (!isset($_SESSION['loggedinadmin']) && !isset($_SESSION['loggedinuser'])) {
    echo "<script>window.location.href = 'login.php'</script>";
    exit;
}
?>
    <?php include("includes/navbar-secondary.php"); ?>
   <section class="container mt-5 mb-5">
    <h2 class="mb-4 text-center fw-bold">Pembobotan Kriteria (Metode AHP)</h2>

    <p class="mb-4 text-justify">
        Pada tahap ini, pengguna diminta untuk memberikan preferensi atau penilaian perbandingan antar kriteria 
        berdasarkan tingkat kepentingan relatifnya. Perbandingan dilakukan secara berpasangan 
        (pairwise comparison), sesuai prinsip metode AHP.
    </p>

    <p class="mb-4 text-justify">
        Misalnya, pengguna dapat menyatakan bahwa <strong>Harga</strong> lebih penting daripada <strong>Kualitas</strong>, 
        atau <strong>Material</strong> sama pentingnya dengan <strong>Daya Tahan</strong>. Dari preferensi ini akan dihitung 
        bobot masing-masing kriteria secara otomatis menggunakan algoritma AHP.
    </p>

    <div class="alert alert-info">
        <strong>Petunjuk:</strong> Silakan lakukan pembobotan kriteria dengan menekan tombol <strong>"Hitung Bobot Kriteria"</strong> dengan memilih 
        preferensi antar kriteria. Setelah selesai, klik tombol <strong>"Kirim preferensi"</strong>.
    </div>

    <div class="text-center mb-4">
        <a href="perbandingan.php" class="btn btn-primary btn-lg">Hitung Bobot Kriteria</a>
    </div>
</section>
<?php include("includes/footer.php") ?>