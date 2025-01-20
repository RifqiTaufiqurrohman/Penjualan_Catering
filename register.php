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
                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-2">Register</h4>
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
                    <form action="controller/authcode.php" method="POST" enctype="multipart/form-data">
                        <label class="mb-n2" for="">Nama Lengkap</label>
                        <div class="input-group input-group-outline mb-2">
                            <input type="text" class="form-control" placeholder="Nama Lengkap" name="name" required>
                        </div>
                        <label class="mb-n2" for="">Nomor Whatsapp</label>
                        <div class="input-group input-group-outline mb-2">
                            <input type="number" class="form-control" placeholder="Nomor Whatsapp" name="phone" required>
                        </div>
                        <label class="mb-n2" for="">Email</label>
                        <div class="input-group input-group-outline mb-2">
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <label class="mb-n2" for="">Foto Profile</label>
                        <div class="input-group input-group-outline mb-2">
                            <input type="file" class="form-control" placeholder="Foto" name="image" required>
                        </div>
                        <label class="mb-n2" for="">Password</label>
                        <div class="input-group input-group-outline mb-2">
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        <label class="mb-n2" for="">Konfirmasi Password</label>
                        <div class="input-group input-group-outline mb-2">
                            <input type="password" class="form-control" placeholder="Konfirmasi Password" name="cpassword" required>
                        </div>
                        <button type="submit" name="register" class="btn bg-gradient-primary w-100 my-4 mb-2">REGISTER</button>
                    </form>
                    <p class="mt-4 text-sm text-center">
                        Sudah mempunyai Akun?
                        <a href="login.php" class="text-primary text-gradient font-weight-bold">Login
                            Sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>