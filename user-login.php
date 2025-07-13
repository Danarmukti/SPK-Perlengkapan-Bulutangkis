<?php include("includes/header.php");
if (isset($_SESSION['loggedin'])) {
?>
    <script> window.location.href = 'index.php'</script>
<?php
}
?>
<div class="py-3 bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm rounded-4">
                    <div class="p-5">
                        <?= alertMessage() ?>
                        <h4 class="text-dark mb-3">User Log In </h4>
                        <form action="login-code.php" method="post">
                            <div class="mb-3">
                                <label for="validationEmail" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="validationEmail" required>
                                <div class="valid-feedback">
                                Looks good!
                                </div>
                                <div class="invalid-feedback">
                                Email harus mengandung simbol "@".
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" required class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary w-100" name="loginUserBtn" type="submit">Log In</button>
                            </div>
                            <div class="mb-3">
                                <a href="user-register.php" class="btn btn-warning w-100" name="" type="">Daftar Akun</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  const emailInput = document.getElementById('validationEmail');

  emailInput.addEventListener('input', function () {
    const value = emailInput.value;

    if (value.includes('@')) {
      emailInput.classList.remove('is-invalid');
      emailInput.classList.add('is-valid');
    } else {
      emailInput.classList.remove('is-valid');
      emailInput.classList.add('is-invalid');
    }
  });
</script>

<?php include("includes/footer.php") ?>