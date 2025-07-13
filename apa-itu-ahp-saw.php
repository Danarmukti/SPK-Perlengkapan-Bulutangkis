<?php include("includes/header.php");
if (!isset($_SESSION['loggedinadmin']) && !isset($_SESSION['loggedinuser'])) {
    echo "<script>window.location.href = 'login.php'</script>";
    exit;
}
?>
    <?php include("includes/navbar-secondary.php"); ?>
   <div class="container mt-5">
  <h2 class="mb-4">Apa itu Metode AHP & SAW?</h2>
  <div class="mb-4">
    <h4>🔷 AHP (Analytical Hierarchy Process)</h4>
    <p>
      AHP adalah metode pengambilan keputusan yang digunakan untuk menentukan prioritas dari sejumlah kriteria atau alternatif dengan cara membandingkan satu per satu (pairwise comparison). AHP cocok digunakan ketika keputusan melibatkan banyak kriteria yang bersifat subyektif.
    </p>
  </div>
  <div class="mb-4">
    <h4>🔷 SAW (Simple Additive Weighting)</h4>
    <p>
      SAW merupakan metode pengambilan keputusan yang menggunakan penjumlahan terbobot dari setiap kriteria. SAW mengharuskan semua nilai kriteria dinormalisasi terlebih dahulu, kemudian dihitung total skor untuk setiap alternatif berdasarkan bobot kriteria.
    </p>
  </div>
  <div class="mb-4">
    <h4>🔷 Kombinasi AHP dan SAW</h4>
    <p>
      Dalam sistem ini, AHP digunakan untuk menentukan bobot pentingnya masing-masing kriteria (seperti harga, kualitas, bahan, dll), kemudian SAW digunakan untuk menghitung dan menentukan alternatif perlengkapan bulutangkis terbaik berdasarkan bobot dari AHP tersebut.
    </p>
  </div>
</div>
<?php include("includes/footer.php") ?>