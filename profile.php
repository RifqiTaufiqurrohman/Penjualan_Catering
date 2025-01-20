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
                        <h1 class="text-white mb-0">My Profile</h1>
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
                <div class="col-md-12 mx-auto">
                    <?php
                    $pelanggan = getPelanggan();
                    if (mysqli_num_rows($pelanggan) > 0) {
                        foreach ($pelanggan as $item) {
                    ?>
                    <div class="mt-n8 mt-md-n9 text-center">
                        <img class="avatar avatar-xxl shadow-xl position-relative z-index-2"
                            src="assets/images/profile/<?= $item['image'] ?>" alt="bruce" loading="lazy">
                    </div>
                    <div class="row py-5">
                        <div class="col-lg-7 col-md-7 z-index-2 position-relative px-md-2 px-sm-5 mx-auto">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h3 class="mb-0"><?= $item['nama_lengkap'] ?></h3>
                                <div class="d-block">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-auto">
                                    <?php
                                            $orders = getOrders();
                                            $total_order = mysqli_num_rows($orders);
                                            if ($total_order > 0) {
                                            ?>
                                    <span class="h6"><?= $total_order ?></span>
                                    <span>Barang Dipesan</span>
                                    <?php
                                            }
                                            ?>
                                </div>
                            </div>
                            <a href="my-order.php" class="btn bg-gradient-primary mb-0">Pesanan Saya</a>
                            <a href="setting.php" class="btn bg-gradient-dark mb-0">Setting</a>
                        </div>
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