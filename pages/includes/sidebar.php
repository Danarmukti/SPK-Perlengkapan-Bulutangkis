<?php
    $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],'/') +1);
?>
<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark " id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link <?= $page == 'index.php' ? 'active' : ''; ?> " href="index.php">
                                <div class="sb-nav-link-icon "><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Perhitungan</div>
                            <a class="nav-link <?= ($page == 'hasil-perhitungan.php') || ($page == 'perhitungan-kriteria.php') || ($page == 'addKriteria.php') ? 'collapse active' : 'collapsed'; ?>
                            " href="#" data-bs-toggle="collapse" data-bs-target="#categoriesLayout" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    AHP
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse
                            <?= ($page == 'perhitungan-kriteria.php') || ($page == 'hasil-perhitungan.php') || ($page == 'addKriteria.php') ? 'show' : ''; ?>
                            " id="categoriesLayout" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= ($page == 'perhitungan-kriteria.php') || ($page == 'addKriteria.php') ? 'active' : ''; ?>" href="perhitungan-kriteria.php">Perhitungan Kriteria</a>
                                    <a class="nav-link <?= $page == 'hasil-perhitungan.php' ? 'active' : ''; ?>" href="hasil-perhitungan.php">Hasil Perhitungan</a>
                                </nav>
                            </div>
                            <a class="nav-link <?= ($page == 'nilai-alternatif.php') || ($page == 'hasil-saw.php') ? 'collapse active' : 'collapsed'; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#productLayout" aria-expanded="false" aria-controls="productLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    SAW
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?= ($page == 'nilai-alternatif.php') || ($page == 'hasil-saw.php') ? 'show' : ''; ?>" id="productLayout" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= $page == 'nilai-alternatif.php' ? 'active' : ''; ?>" href="nilai-alternatif.php">Nilai Alternatif Saw</a>
                                    <a class="nav-link <?= $page == 'hasil-saw.php' ? 'active' : ''; ?>" href="hasil-saw.php">Hasil SAW</a>
                                </nav>
                            </div>
                            <a class="nav-link <?= $page == 'ranking.php' ? 'active' : ''; ?> " href="ranking.php">
                                <div class="sb-nav-link-icon "><i class="fa-solid fa-chart-simple"></i></div>
                                Ranking 
                            </a>
                            <div class="sb-sidenav-menu-heading">Manage</div>
                            <a class="nav-link <?= ($page == 'admins-create.php') || ($page == 'admins.php') ? 'collapse active' : 'collapsed'; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#adminLayout" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-user"></i></div>
                                Admin/staff
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?= ($page == 'admins-create.php') || ($page == 'admins.php') ? 'show' : ''; ?>" id="adminLayout" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= $page == 'admins-create.php' ? 'active' : ''; ?>" href="admins-create.php">Add Admin</a>
                                    <a class="nav-link <?= $page == 'admins.php' ? 'active' : ''; ?>" href="admins.php">View Admin</a>
                                </nav>
                            </div>
                            <a class="nav-link <?= ($page == 'user-register.php') || ($page == 'user-view.php') ? 'collapse active' : 'collapsed'; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#customerLayout" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                                User
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?= ($page == 'user-register.php') || ($page == 'user-view.php') ? 'show' : ''; ?>" id="customerLayout" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= $page == 'user-register.php' ? 'active' : ''; ?>" href="user-register.php">Add User</a>
                                    <a class="nav-link <?= $page == 'user-view.php' ? 'active' : ''; ?>" href="user-view.php">View User</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>