<?php include("includes/header.php");
if (!isset($_SESSION['loggedinadmin']) && !isset($_SESSION['loggedinuser'])) {
    echo "<script>window.location.href = 'login.php'</script>";
    exit;
}
?>
    <?php include("includes/navbar-secondary.php"); ?>
<?php
$query = "SELECT * FROM kriteria";
$result = mysqli_query($conn, $query);

$kriteria = [];
while ($row = mysqli_fetch_assoc($result)) {
    $kriteria[] = $row;
}
?>
<div class="container mt-5 mb-5">
    <h2 class="text-center fw-bold mb-4">Preferensi Pembobotan Kriteria</h2>
    <form action="login-code.php" method="post">
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
<?php include("includes/footer.php"); ?>