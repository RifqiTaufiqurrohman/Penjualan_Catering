<?php
include '../Middleware/adminMiddleware.php';

if (isset($_GET['track'])) {
    $tracking_no = $_GET['track'];
    $orderData = checkTrackingNoValid($tracking_no);

    if (mysqli_num_rows($orderData) < 0) {
        echo "<h4>Ada Yang Salah</h4>";
        die();
    }
} else {
    echo "<h4>Ada Yang Salah</h4>";
    die();
}

$data = mysqli_fetch_array($orderData);

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
    <div class="py-2 bg-gray-200">
        <div class="row justify-content-between">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <h1 class="text-bg-gradient-dark">Ardina Catering</h1>
                            <div class="col-md-3">
                                <h6 class="mb-0">Telephone</h6>
                                <p>082320080421</p>
                            </div>
                            <div class="col-md-7">
                                <h6 class="mb-0">Alamat</h6>
                                <p>Kp. Buaran Jati, Sukadiri, Tangerang</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="">
                            <h3 class="text-bg-gradient-dark">INVOICE</h3>
                        </div>
                        <h5> No Pesanan : <?= $data['tracking_no'] ?></h5>
                        <h6 class="mb-0">Tanggal</h6>
                        <p>
                            <?= FormatTanggal(date('d F Y')) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center">
                <button class="no-print btn bg-gradient-primary " onclick="window.print()">Cetak</button>
                <a href="view-order.php?track=<?= $data['tracking_no'] ?>"
                    class="no-print btn bg-gradient-dark ">Kembali</a>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="">
                        <h6 class="mb-0">Kepada :</h6>
                        <h5 class="mb-0"><?= $data['nama'] ?></h5>
                        <p class="mb-0"><?= $data['patokan_alamat'] ?></p>
                        <p class="mb-0"><?= $data['alamat'] ?></p>
                        <p class=""><?= $data['phone'] ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-pricing">
                    <thead class="text-light">
                        <tr>
                            <th class="ps-2">
                                <h6 class="mb-0">Nama Produk</h6>
                            </th>
                            <th class="ps-2">
                                <h6 class="mb-0">Harga Produk</h6>
                            </th>
                            <th class="ps-2">
                                <h6 class="mb-0">Quantity</h6>
                            </th>
                            <th class="ps-2">
                                <h6 class="mb-0">Total</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.qty as orderqty, p.* FROM pesanan o, barang_pesanan oi, produk p WHERE oi.id_pesanan=o.id AND p.id=oi.prod_id AND o.tracking_no='$tracking_no' ";
                        $order_query_run = mysqli_query($conn, $order_query);

                        $total = 0; // Inisialisasi variabel total

                        if (mysqli_num_rows($order_query_run)) {
                            foreach ($order_query_run as $item) {
                                // Hitung total harga untuk produk ini
                                $total_price_item = $item['harga'] * $item['orderqty'];
                                // Tambahkan total harga produk ini ke total keseluruhan
                                $total += $total_price_item;
                        ?>
                        <tr>
                            <td class="py-3">
                                <span class="text-md"><?= $item['nama'] ?></span>
                            </td>
                            <td class="py-3">
                                <span class="text-md">Rp. <?= number_format($item['harga'], 0, ',', '.') ?></span>
                            </td>
                            <td class="py-3">
                                <span class="text-md">x<?= $item['orderqty'] ?></span>
                            </td>
                            <td class="py-3">
                                <span class="text-md">Rp. <?= number_format($data['total_price'], 0, ',', '.') ?></span>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="">
                            <h6>Total : Rp. <?= number_format($total, 0, ',', '.') ?></h6><br>
                            <p class="">Tangerang, <?= FormatTanggal(date('d F Y')) ?> </p><br><br>
                            <p class="">(.........................................)</p>
                        </div>
                    </div>
                    <div class="float-end mt-0">

                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>
</body>

</html>