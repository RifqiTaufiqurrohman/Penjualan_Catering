<?php
include '../Middleware/adminMiddleware.php';
include 'includes/header.php';

?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-warning alert-dismissible text-white mb-4" role="alert">
                    <strong>Hey</strong> <?= $_SESSION['message']; ?>.
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
                unset($_SESSION['message']);
            }
            ?>
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-symbols-outlined opacity-10">
                                    receipt_long
                                </i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Pesanan Masuk</p>
                                <?php
                                $orders = getAllOrders();
                                $totalOrders = mysqli_num_rows($orders); // Get the total number of users
                                if ($totalOrders > 0) {
                                ?>
                                    <h4 class="mb-0"><?= $totalOrders ?></h4>
                                <?php
                                } else {
                                ?>
                                    <h4 class="mb-0">0</h4>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0" />
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>Just Update</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">leaderboard</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Pesanan Selesai</p>
                                <?php
                                $history = getOrderHistory();
                                $totalOrdersH = mysqli_num_rows($history); // Get the total number of users
                                if ($totalOrdersH > 0) {
                                ?>
                                    <h4 class="mb-0"><?= $totalOrdersH ?></h4>
                                <?php
                                } else {
                                ?>
                                    <h4 class="mb-0">0</h4>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <hr class="dark horizontal my-0" />
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>Just Update</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">store</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Produk</p>
                                <?php
                                $produk = getAll('produk');
                                $totalProduk = mysqli_num_rows($produk); // Get the total number of users
                                if ($totalProduk > 0) {
                                ?>
                                    <h4 class="mb-0"><?= $totalProduk ?></h4>
                                <?php
                                } else {
                                ?>
                                    <h4 class="mb-0">0</h4>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <hr class="horizontal my-0 dark" />
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>Just Update</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Users</p>
                                <?php
                                $users = getUsers('users');
                                $totalUsers = mysqli_num_rows($users); // Get the total number of users
                                if ($totalUsers > 0) {
                                ?>
                                    <h4 class="mb-0"><?= $totalUsers ?></h4>
                                <?php
                                } else {
                                ?>
                                    <h4 class="mb-0">0</h4>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <hr class="horizontal my-0 dark" />
                        <div class="card-footer p-3">
                            <p class="mb-0">Just updated</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>