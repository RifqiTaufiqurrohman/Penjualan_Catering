<?php
session_start();

if (isset($_SESSION['auth'])) {
    $_SESSION['message'] = "Anda Sudah Masuk";
    header('Location: index.php');
    exit();
}

include 'includes/header.php';
?>

<div class="container mt-8 mb-4">
    <div class="row">
        <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-2">Login</h4>
                    </div>
                </div>
                <?php if (isset($_SESSION['message'])) { ?>
                    <div class="alert alert-warning alert-dismissible text-white mt-4 mx-3 mb-0 " role="alert">
                        <strong>Hey</strong> <?= $_SESSION['message']; ?>.
                        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                    unset($_SESSION['message']);
                }
                ?>
                <div class="card-body">
                    <form action="controller/authcode.php" method="POST">
                        <label class="mb-n2" for="">Email</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <label class="mb-n2" for="">Password</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-check form-switch d-flex align-items-center mb-3">
                            <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                            <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="loginbtn" class="btn bg-gradient-primary w-100 my-4 mb-2">Login</button>
                        </div>
                    </form>
                    <p class="mt-4 text-sm text-center">
                        Belum mempunyai Akun?
                        <a href="register.php" class="text-primary text-gradient font-weight-bold">Daftar
                            Sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>