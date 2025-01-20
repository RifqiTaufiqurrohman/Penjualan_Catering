<?php

include '../Middleware/adminMiddleware.php';
include 'includes/header.php';

$limit = 10; // Number of entries to show in a page.
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number.
$start = ($page - 1) * $limit; // Calculate the offset for the query.

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Base query
$riwayat_pesanan_query = "SELECT * FROM pesanan WHERE `status` != '0'";

// Append date filters if set
if (!empty($start_date) && !empty($end_date)) {
    $riwayat_pesanan_query .= " AND created_at BETWEEN '$start_date' AND '$end_date'";
}

$riwayat_pesanan_query .= " ORDER BY id DESC LIMIT $start, $limit";
$riwayat_pesanan = mysqli_query($conn, $riwayat_pesanan_query);

// Query to get the total number of records
$total_query = "SELECT COUNT(*) FROM pesanan WHERE `status` != '0'";
if (!empty($start_date) && !empty($end_date)) {
    $total_query .= " AND created_at BETWEEN '$start_date' AND '$end_date'";
}
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
                            RIWAYAT PESANAN
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
                        <div class="d-flex justify-content-end mx-2">
                            <div class="col-md-9 mb-4">
                                <form method="GET" action="">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="input-group input-group-static mb-2">
                                                <h6 class="mb-n2">Tanggal Mulai</h6>
                                                <input type="date" name="start_date" class="form-control" value="<?= $start_date ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group input-group-static mb-2">
                                                <h6 class="mb-n2">Tanggal Akhir</h6>
                                                <input type="date" name="end_date" class="form-control" value="<?= $end_date ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn bg-gradient-dark"><i class="large material-icons mb-0">equalizer</i> Filter
                                            </button>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn bg-gradient-primary" onclick="printPage()"><i class="large material-icons mb-0">print</i>
                                                <span class="mb-0"> Cetak</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
                                        <h6>Status</h6>
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
                                if (mysqli_num_rows($riwayat_pesanan) > 0) {
                                    while ($item = mysqli_fetch_array($riwayat_pesanan)) {
                                ?>
                                        <tr class="align-items-center">
                                            <td class="text-center"><?= $i++ ?></td>
                                            <td class="text-center"><?= $item['nama']; ?></td>
                                            <td class="text-center"><?= $item['tracking_no']; ?></td>
                                            <td class="text-center">Rp. <?= number_format($item['total_price'], 0, ',', '.') ?>
                                            </td>
                                            <td class="text-center"><?= date('d-m-Y', strtotime($item['created_at'])); ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                if ($item['status'] == 0) {
                                                    echo "Proses";
                                                } else if ($item['status'] == 1) {
                                                    echo "Sedang Dikirim";
                                                } else if ($item['status'] == 2) {
                                                    echo "Selesai";
                                                } else if ($item['status'] == 3) {
                                                    echo "Dibatalkan";
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn bg-gradient-dark" data-bs-toggle="modal" data-bs-target="#lihatbukti<?= $item['id'] ?>">LIHAT</button>
                                            </td>
                                            <td class="text-center ">
                                                <a href="view-order.php?track=<?= $item['tracking_no']; ?>" class="btn bg-gradient-primary">Detail Pesanan</a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="lihatbukti<?= $item['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Bukti
                                                            Transfer</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="../assets/images/transaksi/<?= $item['bukti_transfer'] ?>" alt="" width="100%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="7">Tidak Ada Data Pesanan</td>
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
                                            <a class="page-link" href="?page=<?= $page - 1 ?>&start_date=<?= $start_date ?>&end_date=<?= $end_date ?>" aria-label="Previous">
                                                <span aria-hidden="true"><i class="material-icons" aria-hidden="true">chevron_left</i></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                            <a class="page-link" href="?page=<?= $i ?>&start_date=<?= $start_date ?>&end_date=<?= $end_date ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($page < $total_pages) : ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $page + 1 ?>&start_date=<?= $start_date ?>&end_date=<?= $end_date ?>" aria-label="Next">
                                                <span aria-hidden="true"><i class="material-icons" aria-hidden="true">chevron_right</i></span>
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

<script>
    function printPage() {
        // Get the start and end dates
        const startDate = document.querySelector('input[name="start_date"]').value;
        const endDate = document.querySelector('input[name="end_date"]').value;

        // Redirect to the print page with the dates as query parameters
        window.location.href = `cetakpdf.php?start_date=${startDate}&end_date=${endDate}`;
    }
</script>

<?php include 'includes/footer.php'; ?>