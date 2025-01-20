<?php
include 'controller/userfunction.php';
include 'autentikasi.php';
include 'includes/header.php';
?>
<div class="container py-5 ">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4 mt-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white shadow-secondary ">
                        <li class="breadcrumb-item text-dark opacity-5 mb-1 mt-1"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item text-dark active mb-1 mt-1" aria-current="page">Pesanan Saya</li>
                    </ol>
                </nav>
            </div>
            <h3>Pesanan Saya</h3>
            <div class="card card-body md-2 mt-4 shadow-secondary">
                <div class="container py-5">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center font-weight-bolder">
                                    <h5>No Pesanan</h5>
                                </th>
                                <th class="text-center font-weight-bolder">
                                    <h5>Harga</h5>
                                </th>
                                <th class="text-center font-weight-bolder">
                                    <h5>Tanggal</h5>
                                </th>
                                <th class="text-center font-weight-bolder">
                                    <h5>Detail</h5>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders = getOrders();
                            if (mysqli_num_rows($orders) > 0) {
                                foreach ($orders as $item) {
                            ?>
                                    <tr class="align-items-center">
                                        <td class="text-center"><?= $item['tracking_no']; ?></td>
                                        <td class="text-center"><?= $item['total_price']; ?></td>
                                        <td class="text-center"><?= $item['created_at']; ?></td>
                                        <td class="text-center ">
                                            <a href="view-order.php?track=<?= $item['tracking_no']; ?>" class="btn bg-gradient-primary">Detail Pesanan</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5">Tidak Ada Data Pesanan</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php include 'includes/footer.php' ?>