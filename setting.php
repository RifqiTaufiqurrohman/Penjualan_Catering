<?php
include 'controller/userfunction.php';
include 'autentikasi.php';
include 'includes/header.php';
?>
<header>
    <div class="page-header min-vh-65 bg-gradient-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center my-auto">
                    <div class="brand">
                        <h1 class="text-white mb-0">Setting</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="card card-body shadow mx-2 mx-md-4 mt-n6">
    <section class="py-sm-7 py-5 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <h3 class="text-center">Setting Profile</h3>
                    <?php
                    $pelanggan = getPelanggan();
                    if (mysqli_num_rows($pelanggan) > 0) {
                        foreach ($pelanggan as $item) {
                            $decrypted_password = decryptPassword($item['password']); // Dekripsi password
                    ?>
                    <div class="card-body pb-3">
                        <form action="controller/usersetting.php" method="POST" enctype="multipart/form-data">
                            <div class="col-md-3 input-group input-group-outline mb-3">
                                <input type="hidden" name="id_users" value="<?= $item['id'] ?>">
                            </div>
                            <label class="mb-n2" for="">Foto Profile</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="file" name="image" class="form-control mx-1" placeholder="Upload Gambar">
                                <input type="hidden" name="old_image" value="<?= $item['image'] ?>">
                                <img src="assets/images/profile/<?= $item['image'] ?>" alt="" width="50px">
                            </div>
                            <label class="mb-n2" for="">Nama Lengkap</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="name" class="form-control mx-1" placeholder="Nama Lengkap"
                                    value="<?= $item['nama_lengkap'] ?>" required>
                            </div>
                            <label class="mb-n2" for="">E-mail</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="email" name="email" class="form-control mx-1" placeholder="Email"
                                    value="<?= $item['email'] ?>" required>
                            </div>
                            <label class="mb-n2" for="">Nomor WhatsApp</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="phone" class="form-control mx-1" placeholder="No Whatsapp"
                                    value="<?= $item['no_whatsapp'] ?>" required>
                            </div>
                            <label class="mb-n2" for="">Password</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="password" name="password" class="form-control mx-1" placeholder="Password"
                                    value="<?= $decrypted_password ?>" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="update_profile"
                                    class="btn bg-gradient-primary w-100 mt-4 mb-3">SIMPAN
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
    </section>
</div>
</div>
</div>
</div>
</div>
<?php include 'includes/footer.php' ?>