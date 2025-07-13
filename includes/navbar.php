<nav class="navbar navbar-expand-lg bg-dark text-dark-emphasis shadow p-3">
  <div class="container">
    <a class="navbar-brand text-light" href="#">SPK Perlengkapan Bulutangkis AHP & SAW</a>
    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link text-light active" aria-current="page" href="index.php">Home</a>
        </li>
        <?php if(isset($_SESSION['loggedinadmin']) && is_array($_SESSION['loggedinadmin'])): ?>
          <li class="nav-item">
            <a class="btn btn-dark text-light pt-2 pb-2 ps-3 pe-3" aria-current="page" href="pages/index.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light pt-2 pb-2 ps-3 pe-3" href="#"><?= $_SESSION['loggedinadmin']['name'] ?></a>
          </li>
          <li class="nav-item">
            <a class="btn btn-danger text-light pt-2 pb-2 ps-3 pe-3" aria-current="page" href="logout.php">Logout</a>
          </li>
        <?php elseif(isset($_SESSION['loggedinuser']) && is_array($_SESSION['loggedinuser'])): ?>
          <li class="nav-item">
            <a class="nav-link text-light pt-2 pb-2 ps-3 pe-3" href="#"><?= $_SESSION['loggedinuser']['name'] ?></a>
          </li>
          <li class="nav-item">
            <a class="btn btn-danger pt-2 pb-2 ps-3 pe-3" aria-current="page" href="logout.php">Logout</a>
          </li>
          <?php else :?>
          <li class="nav-item">
            <a class="btn btn-primary pt-2 pb-2 ps-3 pe-3" aria-current="page" href="user-login.php">login</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
