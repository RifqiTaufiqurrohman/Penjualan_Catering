<?php

include '../Middleware/adminMiddleware.php';
include 'includes/header.php';

$limit = 10; // Number of entries to show in a page.
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number.
$start = ($page - 1) * $limit; // Calculate the offset for the query.

$pesanan_query = "SELECT * FROM pesanan WHERE `status`='0' ORDER BY id DESC LIMIT $start, $limit";
$pesanan = mysqli_query($conn, $pesanan_query);

$total_query = "SELECT COUNT(*) FROM pesanan";
$total_result = mysqli_query($conn, $total_query);
$total_data = mysqli_fetch_array($total_result)[0];

$total_pages = ceil($total_data / $limit);

?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n5 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h5 class="text-white text-capitalize ps-4">
                            PESANAN MASUK
                        </h5>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <?php if (isset($_SESSION['message'])) { ?>
                        <div class="alert alert-warning alert-dismissible text-white mx-3" role="alert">
                            <strong>Hey</strong> <?= $_SESSION['message']; ?>.
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
                            unset($_SESSION['message']);
                        }
                        ?>
                        <div class="d-flex justify-content-end mx-3">
                        </div>
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center font-weight-bolder">
                                        <h6>No</h6>
                                    </th>
                                    <th class="text-center font-weight-bolder">
                                        <h6>Nama</h6>
                                    </th>
                                    <th class="text-center font-weight-bolder">
                                        <h6>No Pesanan</h6>
                                    </th>
                                    <th class="text-center font-weight-bolder">
                                        <h6>Harga</h6>
                                    </th>
                                    <th class="text-center font-weight-bolder">
                                        <h6>Tanggal</h6>
                                    </th>
                                    <th class="text-center font-weight-bolder">
                                        <h6>Bukti Transfer</h6>
                                    </th>
                                    <th class="text-center font-weight-bolder">
                                        <h6>Detail</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = $start + 1;
                                if (mysqli_num_rows($pesanan) > 0) {
                                    while ($item = mysqli_fetch_array($pesanan)) {
                                ?>
                                <tr class="align-items-center">
                                    <td class="text-center"><?= $i++ ?></td>
                                    <td class="text-center"><?= $item['nama']; ?></td>
                                    <td class="text-center"><?= $item['tracking_no']; ?></td>
                                    <td class="text-center">Rp. <?= number_format($item['total_price'], 0, ',', '.') ?>
                                    </td>
                                    <td class="text-center"><?= $item['created_at']; ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn bg-gradient-dark" data-bs-toggle="modal"
                                            data-bs-target="#lihatbukti<?= $item['id'] ?>">LIHAT</button>
                                    </td>
                                    <td class="text-center ">
                                        <a href="view-order.php?track=<?= $item['tracking_no']; ?>"
                                            class="btn bg-gradient-primary">Detail Pesanan</a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="lihatbukti<?= $item['id'] ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Bukti
                                                    Transfer</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="../assets/images/transaksi/<?= $item['bukti_transfer'] ?>"
                                                    alt="" width="100%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                        <div class="row justify-space-between py-2">
                            <div class="col-lg-4 mx-auto">
                                <ul class="pagination pagination-primary m-4">
                                    <?php if ($page > 1) : ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                            <span aria-hidden="true"><i class="material-icons"
                                                    aria-hidden="true">chevron_left</i></span>
                                        </a>
                                    </li>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                    <?php endfor; ?>

                                    <?php if ($page < $total_pages) : ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                                            <span aria-hidden="true"><i class="material-icons"
                                                    aria-hidden="true">chevron_right</i></span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>