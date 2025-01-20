<?php
include 'controller/userfunction.php';
include 'autentikasi.php';
include 'includes/header.php';

if (isset($_GET['track'])) {
    $tracking_no = $_GET['track'];

    $orderData = checkTrackingNoValid($tracking_no);
    if (mysqli_num_rows($orderData) < 0) {
?>
<h4>Ada Yang Salah</h4>
<?php
        die();
    }
} else {
    ?>
<h4>Ada Yang Salah</h4>
<?php
    die();
}
$data = mysqli_fetch_array($orderData);
?>

<div class="container py-5 ">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4 mt-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white shadow-secondary ">
                        <li class="breadcrumb-item text-dark opacity-5 mb-1 mt-1"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item text-dark opacity-5 mb-1 mt-1"><a href="my-order.php">Pesanan
                                Saya</a>
                        </li>
                        <li class="breadcrumb-item text-dark active mb-1 mt-1" aria-current="page">Detail Pesanan</li>
                    </ol>
                </nav>
            </div>
            <h3>Detail Pesanan</h3>
            <div class="card card-body md-2 mt-4 shadow-secondary">
                <div class="container py-5">
                    <div class="row">
                        <div class="col-md-7">
                            <h5>Detail Pengiriman</h5>
                            <hr class="horizontal bg-dark mt-0" />
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <h6>Nama Penerima</h6>
                                    <p><?= $data['nama'] ?></p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6>Nomor WhatsApp</h6>
                                    <p><?= $data['phone'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <h6>Metode Pembayaran</h6>
                                    <p><?= $data['payment_mode'] ?></p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6>Metode Pengiriman</h6>
                                    <p><?= $data['mtd_pengiriman'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <h6>Tanggal DIambil / Diantar</h6>
                                    <p><?= date('d M Y', strtotime($data['tgl_diantar'])) ?></p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6>Nomor Pesanan</h6>
                                    <p><?= $data['tracking_no'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <h6>Patokan Alamat</h6>
                                    <p><?= $data['patokan_alamat'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <h6>Alamat Lengkap</h6>
                                    <p><?= $data['alamat'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <h6>Catatan Pesanan</h6>
                                    <p><?= $data['catatan_pesanan'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h5>Detail Pesanan</h5>
                            <hr class="horizontal bg-dark mt-0" />
                            <table class="align-items-center mb-3">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6>Produk</h6>
                                        </th>
                                        <th>
                                            <h6>Harga</h6>
                                        </th>
                                        <th>
                                            <h6>Quantity</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="mt-n3">
                                    <?php
                                    $userId = $_SESSION['auth_user']['user_id'];

                                    $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.qty as orderqty, p.* FROM pesanan o, barang_pesanan oi, produk p WHERE o.user_id='$userId' AND oi.id_pesanan=o.id AND p.id=oi.prod_id AND o.tracking_no='$tracking_no' ";
                                    $order_query_run = mysqli_query($conn, $order_query);

                                    if (mysqli_num_rows($order_query_run)) {
                                        foreach ($order_query_run as $item) {
                                    ?>
                                    <tr>
                                        <td class="text-center py-1" style="padding-right: 50px;">
                                            <img src="assets/images/produk/<?= $item['image'] ?>"
                                                alt="<?= $item['nama'] ?>" width="50px">
                                            <?= $item['nama'] ?>
                                        </td>
                                        <td class="text-center" style="padding-right: 50px;">
                                            Rp. <?= $item['harga'] ?>
                                        </td>
                                        <td class="text-center">
                                            x<?= $item['orderqty'] ?>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <hr class="horizontal bg-dark mt-2" />
                            <h5>Total : Rp. <?= number_format($data['total_price'], 0, ',', '.') ?></h5>
                            <hr class="horizontal bg-dark mt-2" />
                            <h6>Metode Pembayaran : <?= $data['payment_mode'] ?></h6>
                            <div>
                                <h6>Status :
                                    <?php
                                    if ($data['status'] == 0) {
                                        echo "Dalam Proses";
                                    } else if ($data['status'] == 1) {
                                        echo "Pesanan Sedang Dikirim";
                                    } else if ($data['status'] == 2) {
                                        echo "Pesanan Selesai";
                                    } else if ($data['status'] == 3) {
                                        echo "Pesanan Dibatalkan";
                                    }
                                    ?>
                                </h6>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <button type="" class="btn bg-gradient-dark" data-bs-toggle="modal"
                                        data-bs-target="#lacakpengiriman">Lacak Pengiriman</button>
                                </div>
                                <!-- MODAL LACAK PENGIRIMAN-->
                                <div class="modal fade" id="lacakpengiriman" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Lacak Pengiriman</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table align-items-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th
                                                                class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                                                Tanggal/Jam</th>
                                                            <th
                                                                class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                                                Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    $pengiriman = getPengiriman($tracking_no);
                                                    if (mysqli_num_rows($pengiriman) > 0) {
                                                        foreach ($pengiriman as $itemP) {
                                                    ?>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <p class="text-center text-sm font-weight-bold mb-0">
                                                                    <?= date('d-M-Y H:i:s', strtotime($itemP['created_at'])) ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="text-center text-sm font-weight-bold mb-0"
                                                                    style="word-wrap: break-word; white-space: normal;">
                                                                    <?= $itemP['pesan'] ?></p>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        }
                                                    } else {
                                                            ?>
                                                        <tr>
                                                            <td colspan="5">Belum Ada Keterangan</td>
                                                        </tr>
                                                        <?php
                                                    }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer justify-content">
                                                <button type="button" class="btn bg-gradient-dark mb-0"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END MODAL LACAK PENGIRIMAN-->
                                <?php if ($data['status'] == 0 || $data['status'] == 1): ?>
                                <div class="col-md-6 mt-2">
                                    <button type="" class="btn bg-gradient-primary" data-bs-toggle="modal"
                                        data-bs-target="#terimapesanan">Pesanan Diterima</button>
                                </div>
                                <?php endif; ?>
                                <!-- MODAL PESANAN DITERIMA-->
                                <div class="modal fade" id="terimapesanan" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pesanan
                                                    Diterima</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="controller/terimapesanan.php" method="POST">
                                                    <h6 class="">Berikan Komentar Tentang Produk Kami</h6>
                                                    <textarea name="komentar" rows="5" type="text" class="form-control"
                                                        style="border: 1px solid #ced4da !important; padding: 8px 10px;"
                                                        placeholder="Komentar Produk" required></textarea>
                                            </div>
                                            <div class="modal-footer justify-content">
                                                <button type="button" class="btn bg-gradient-dark mb-0"
                                                    data-bs-dismiss="modal">Close</button>
                                                <input type="hidden" name="tracking_no"
                                                    value="<?= $data['tracking_no'] ?>">
                                                <input type="hidden" name="order_status" value="2">
                                                <button type="submit" name="update_order_btn"
                                                    class="btn bg-gradient-primary mb-0">Pesanan Diterima</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- END MODAL PESANAN DITERIMA-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php include 'includes/footer.php' ?>