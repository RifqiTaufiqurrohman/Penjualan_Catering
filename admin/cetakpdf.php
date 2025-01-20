<?php

include '../Middleware/adminMiddleware.php';

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Base query
$riwayat_pesanan_query = "SELECT id, nama, tracking_no, total_price, created_at FROM pesanan WHERE `status` != '3'";

// Append date filters if set
if (!empty($start_date) && !empty($end_date)) {
    $riwayat_pesanan_query .= " AND created_at BETWEEN '$start_date' AND '$end_date'";
}

$riwayat_pesanan_query .= " ORDER BY id DESC";
$riwayat_pesanan = mysqli_query($conn, $riwayat_pesanan_query);

$total_transactions = 0;
$total_revenue = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>Ardina Catering</title>

    <link rel="icon" type="image/x-icon" href="../assets/images/1.jpg">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.min.css" rel="stylesheet" />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
    @media print {
        .no-print {
            display: none;
        }
    }
    </style>
</head>

<body>
    <section class="pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="text-bg-gradient-dark text-center">CV. ARDINA BERKAH MULIA</h2>
                    <p class="mb-2">Kp. Buaran Jati, 03/04, Desa Buaran Jati, Kecamatan Sukadiri, Kabupaten
                        Tangerang, Provinsi Banten</p>

                    <hr class="horizontal dark mb-4" />
                    <?php if (!empty($start_date) && !empty($end_date)) { ?>
                    <h6>Periode: <?= date('d-m-Y', strtotime($start_date)) ?> s/d
                        <?= date('d-m-Y', strtotime($end_date)) ?></h6>
                    <?php } ?>
                    <button class="no-print btn bg-gradient-primary " onclick="window.print()">Cetak</button>
                    <a href="order-history.php?start_date=<?= urlencode($start_date) ?>&end_date=<?= urlencode($end_date) ?>"
                        class="no-print btn bg-gradient-dark ">Kembali</a>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-pricing">
                            <thead class="text-light">
                                <tr>
                                    <th class="ps-2">
                                        <h6 class="mb-0">No</h6>
                                    </th>
                                    <th class="ps-2">
                                        <h6 class="mb-0">Nama</h6>
                                    </th>
                                    <th class="ps-2">
                                        <h6 class="mb-0">No Pesanan</h6>
                                    </th>
                                    <th class="ps-2">
                                        <h6 class="mb-0">Harga</h6>
                                    </th>
                                    <th class="ps-2">
                                        <h6 class="mb-0">Tanggal</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if (mysqli_num_rows($riwayat_pesanan) > 0) {
                                    while ($item = mysqli_fetch_array($riwayat_pesanan)) {
                                        $total_transactions++;
                                        $total_revenue += $item['total_price'];
                                ?>
                                <tr>
                                    <td class="py-3">
                                        <span class="text-xs"><?= $i++ ?></span>
                                    </td>
                                    <td class="py-3">
                                        <span class="text-xs"><?= $item['nama'] ?></span>
                                    </td>
                                    <td class="py-3">
                                        <span class="text-xs"><?= $item['tracking_no'] ?></span>
                                    </td>
                                    <td class="py-3">
                                        <span class="text-xs">Rp.
                                            <?= number_format($item['total_price'], 0, ',', '.') ?></span>
                                    </td>
                                    <td class="py-3">
                                        <span
                                            class="text-xs"><?= date('d-m-Y', strtotime($item['created_at'])) ?></span>
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
                        <div class="">
                            <h6>Total Transaksi : <?= $total_transactions ?></h6>
                            <h6>Total Pendapatan : Rp. <?= number_format($total_revenue, 0, ',', '.') ?></h6>
                        </div>
                        <div class="float-end mt-0">
                            <p class="">Tangerang, <?= FormatTanggal(date('d F Y')) ?> </p><br><br>
                            <p class="text-center">(Nina Agustina)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>