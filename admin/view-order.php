<?php

include '../Middleware/adminMiddleware.php';
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

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n5 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h5 class="text-white text-capitalize ps-4">
                            DETAIL PESANAN
                        </h5>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    <div class="container py-3">
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
                                        <h6>Nomor Whatsapp</h6>
                                        <p><?= $data['phone'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <h6>Tanggal Diambil / Diantar</h6>
                                        <p><?= date('d M Y', strtotime($data['tgl_diantar'])) ?></p>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <h6>Jam Pengambilan / Sampai Tujuan</h6>
                                        <p><?= $data['jam'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <h6>Transfer Ke Bank</h6>
                                        <p><?= $data['nama_bank'] ?></p>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <h6>Nomor Pesanan</h6>
                                        <p><?= $data['tracking_no'] ?></p>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <h6>Nama Gang / Patokan</h6>
                                    <p><?= $data['patokan_alamat'] ?></p>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <h6>Alamat Lengkap</h6>
                                    <p><?= $data['alamat'] ?></p>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <h6>Catatan Pesanan Sesuai Request</h6>
                                    <p><?= $data['catatan_pesanan'] ?></p>
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
                                                <h6 class="ms-4">Harga</h6>
                                            </th>
                                            <th>
                                                <h6>Quantity</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="mt-n3">
                                        <?php
                                        $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.qty as orderqty, p.* FROM pesanan o, barang_pesanan oi, produk p WHERE oi.id_pesanan=o.id AND p.id=oi.prod_id AND o.tracking_no='$tracking_no' ";
                                        $order_query_run = mysqli_query($conn, $order_query);

                                        if (mysqli_num_rows($order_query_run)) {
                                            foreach ($order_query_run as $item) {
                                        ?>
                                        <tr>
                                            <td class="text-center py-1">
                                                <img src="../assets/images/produk/<?= $item['image'] ?>"
                                                    alt="<?= $item['nama'] ?>" width="50px">
                                                <?= $item['nama'] ?>
                                            </td>
                                            <td class="text-center" style="padding-right: 40px; padding-left: 25px;">
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
                                <h6>Metode Pengiriman : <?= $data['mtd_pengiriman'] ?></h6>
                                <h6>Status : </h6>
                                <div class="row">
                                    <div class="input-group-outline mb-0">
                                        <form action="controller/code.php" method="POST">
                                            <input type="hidden" name="tracking_no" value="<?= $data['tracking_no'] ?>">
                                            <select name="order_status" id="form-select" class=" form-select">
                                                <option value="0" <?= $data['status'] == 0 ? "selected" : "" ?>>
                                                    Dalam
                                                    Proses
                                                </option>
                                                <option value="1" <?= $data['status'] == 1 ? "selected" : "" ?>>
                                                    Pesanan
                                                    Sedang Dikirim
                                                </option>
                                                <option value="2" <?= $data['status'] == 2 ? "selected" : "" ?>>
                                                    Pesanan
                                                    Selesai
                                                </option>
                                                <option value="3" <?= $data['status'] == 3 ? "selected" : "" ?>>
                                                    Pesanan
                                                    Dibatalkan
                                                </option>
                                            </select>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <?php if ($data['status'] == 0 || $data['status'] == 1) : ?>
                                                    <button type="submit" name="update_order_btn"
                                                        class="btn bg-gradient-primary mt-2"><i
                                                            class="large material-icons mb-0">update</i>
                                                        UPDATE PESANAN
                                                    </button>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php if ($data['status'] == 1) : ?>
                                                    <button type="button" class="btn bg-gradient-primary mt-2"
                                                        onclick="printPage()"><i
                                                            class="large material-icons mb-0">print</i>
                                                        CETAK NOTA
                                                    </button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-7 mt-2">
                                        <button type="" class="btn bg-gradient-dark" data-bs-toggle="modal"
                                            data-bs-target="#detailpengiriman"><i
                                                class="large material-icons mb-0">input</i>
                                            INPUT PROSES PESANAN</button>
                                    </div>
                                    <div class="col-md-5">
                                        <?php
                                        $phone = $data['phone']; // Ambil nomor telepon dari data
                                        if (substr($phone, 0, 1) === '0') {
                                            $phone = '62' . substr($phone, 1);
                                        }
                                        ?>
                                        <?php if ($data['status'] == 0) : ?>
                                        <form action="controller/kirimpesan.php" method="POST" target="_blank">
                                            <input type="hidden" name="pelanggan" value="<?= $data['nama'] ?>">
                                            <input type="hidden" name="name" value="Ardina Catering">
                                            <input type="hidden" name="pesan"
                                                value="Pesanan anda akan segera di proses. Segera lunasi tagihan anda sebelum tanggal <?= date('d M Y', strtotime($data['tgl_diantar'])) ?>, jika tidak segera dilunasi maka pesanan akan dibatalkan">
                                            <input type="hidden" name="noWa" value="<?= $phone ?>">
                                            <button type="submit" name="kirim_pesan"
                                                class="btn bg-gradient-success mt-2"><i
                                                    class="large material-icons mb-0">message</i> KIRIM
                                                PESAN</button>
                                        </form>
                                        <?php endif; ?>
                                    </div>
                                    <!-- MODAL LACAK PENGIRIMAN-->
                                    <div class="modal fade" id="detailpengiriman" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Input Detail
                                                        Proses Pesanan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="controller/code.php" method="POST">
                                                    <div class="modal-body">
                                                        <input type="hidden" value="<?= $data['id'] ?>"
                                                            name="id_pesanan">
                                                        <input type="hidden" value="<?= $data['tracking_no'] ?>"
                                                            name="tracking">
                                                        <h6 class="">Keterangan</h6>
                                                        <textarea name="pesan" rows="3" type="text" class="form-control"
                                                            style="border: 1px solid #ced4da !important; padding: 8px 10px;"
                                                            placeholder="Keterangan Pengiriman" required></textarea>
                                                        <table class="table align-items-center mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th
                                                                        class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                                                        Jam</th>
                                                                    <th
                                                                        class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                                                        Pesan</th>
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
                                                                        <p
                                                                            class="text-center text-sm font-weight-bold mb-0">
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
                                                        <button type="submit" name="input_pengiriman"
                                                            class="btn bg-gradient-primary mb-1">Input
                                                            Proses</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END MODAL LACAK PENGIRIMAN-->
                                </div>
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
    window.open('print_invoice.php?track=<?= $tracking_no ?>', '_blank');
}
</script>


<?php include 'includes/footer.php'; ?>