<?php
    $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],'/') +1);
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary text-dark-emphasis shadow p-3">
        <div class="container">
            <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNav">
            <ul class="navbar-nav nav-underline">
                <li class="nav-item">
                <a class="nav-link <?= $page == 'index.php' ? 'active' : ''; ?>" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?= $page == 'apa-itu-ahp-saw.php' ? 'active' : ''; ?>" href="apa-itu-ahp-saw.php">Apa itu AHP & SAW</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?= $page == 'pemilihan.php' ? 'active' : ''; ?>" href="pemilihan.php">Pemilihan</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?= $page == 'perbandingan.php' ? 'active' : ''; ?>"  href="perbandingan.php">Perhitungan AHP</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?= $page == 'Hasil-perbandingan.php' ? 'active' : ''; ?>" href="Hasil-perbandingan.php">Hasil Perbandingan</a>
                </li>
                <li class="nav-item ">
                <a class="nav-link <?= $page == 'ranking-saw.php' ? 'active' : ''; ?>"  href="ranking-saw.php">Ranking SAW</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>