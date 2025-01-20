<?php

include '../Middleware/adminMiddleware.php';
include 'includes/header.php';

?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n5 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h5 class="text-white text-capitalize ps-4">
                            PENGATURAN
                        </h5>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <?php if (isset($_SESSION['message'])) { ?>
                            <div class="alert alert-warning alert-dismissible text-white mx-3" role="alert">
                                <strong>Hey</strong> <?= $_SESSION['message']; ?>.
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                            unset($_SESSION['message']);
                        }
                        ?>

                        <div class="col-md-6 mx-auto">
                            <?php
                            $admin = getAdmin('users');
                            if (mysqli_num_rows($admin) > 0) {
                                foreach ($admin as $item) {
                                    $decrypted_password = decryptPassword($item['password']); // Dekripsi password
                            ?>
                                    <div class="card-body pb-3">
                                        <form action="controller/code.php" method="POST" enctype="multipart/form-data">
                                            <div class="col-md-3 input-group input-group-outline mb-3">
                                                <input type="hidden" name="id_users" value="<?= $item['id'] ?>">
                                            </div>
                                            <label class="mb-n2" for="">Foto Profile</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="file" name="image" class="form-control mx-1" placeholder="Upload Gambar">
                                                <input type="hidden" name="old_image" value="<?= $item['image'] ?>">
                                                <img src="../assets/images/profile/<?= $item['image'] ?>" alt="" width="50px">
                                            </div>
                                            <label class="mb-n2" for="">Nama Lengkap</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" name="name" class="form-control mx-1" placeholder="Nama Lengkap" value="<?= $item['nama_lengkap'] ?>" required>
                                            </div>
                                            <label class="mb-n2" for="">E-mail</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="email" name="email" class="form-control mx-1" placeholder="Email" value="<?= $item['email'] ?>" required>
                                            </div>
                                            <label class="mb-n2" for="">Nomor WhatsApp</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" name="phone" class="form-control mx-1" placeholder="No Whatsapp" value="<?= $item['no_whatsapp'] ?>" required>
                                            </div>
                                            <label class="mb-n2" for="">Password</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="password" name="password" class="form-control mx-1" placeholder="Password" value="<?= $decrypted_password ?>" required>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="update_profile" class="btn bg-gradient-primary w-100 mt-4 mb-3">SIMPAN
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>