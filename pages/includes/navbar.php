<nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
                <div class="me-2">
                    <a class="navbar-brand ps-3" href="index.php">SPK PERLENGKAPAN BULUTANGKIS TERBAIK AHP SAW</a>
                    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 bg-dark text-white" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
                </div>
                <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">  
                </form>
                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link ">
                        Home
                    </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user fa-fw"></i>
                            <?= $_SESSION['loggedinadmin']['name']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="admins.php">Settings</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                </ul>
            </li>
    </ul>
</nav>