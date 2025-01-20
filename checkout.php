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
                        <li class="breadcrumb-item text-dark active mb-1 mt-1" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
            <h3>Checkout</h3>
            <div class="card card-body md-2 mt-4 shadow-secondary">
                <div class="container py-5">
                    <div class="row">
                        <form action="controller/checkout.php" method="POST" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-7">
                                        <h5>Detail Checkout</h5>
                                        <hr class="horizontal bg-dark mt-0" />
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="input-group input-group-static mb-2">
                                                    <h6 class="mb-n2">Nama Penerima</h6>
                                                    <input class="form-control" name="name" type="text" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 ps-md-2">
                                                <div class="input-group input-group-static mb-2">
                                                    <h6 class="mb-n2">Nomor WhatsApp</h6>
                                                    <input class="form-control" name="no_wa" type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="input-group input-group-static mb-2">
                                                    <h6 class="mb-n2">Metode Pembayaran</h6>
                                                </div>
                                                <div class="form-check form-check-info d-flex float-start mt-2">
                                                    <input class="form-check-input mt-0 text-start " type="radio" name="payment_mode" value="Transfer" id="transfer">
                                                    <label for="transfer" class="me-4"><strong>Transfer</strong></label>
                                                    <input class="form-check-input mt-0" type="radio" name="payment_mode" value="COD" id="cod"> <label for="cod" class="me-4"><strong>COD</strong></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 ps-md-2">
                                                <div class="input-group input-group-static mb-2">
                                                    <h6 class="mb-n2">Metode Pengiriman</h6>
                                                </div>
                                                <div class="form-check form-check-info d-flex float-start mt-2">
                                                    <input class="form-check-input mt-0 text-start" type="radio" name="mtd_pengiriman" value="Diambil" id="diambil">
                                                    <label for="diambil" class="me-4"><strong>Diambil</strong></label>
                                                    <input class="form-check-input mt-0" type="radio" name="mtd_pengiriman" value="Diantarkan" id="diantar">
                                                    <label for="diantar" class="me-4"><strong>Diantarkan</strong></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group input-group-static mb-2">
                                                    <h6 class="mb-n2">Tanggal Pengambilan / Diantar</h6>
                                                    <input type="date" name="tgl_diantar" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 ps-md-2">
                                                <div class="input-group input-group-static">
                                                    <h6 class="mb-n2 me-2">Jam Pengambilan / Sampai Tujuan</h6>
                                                    <input class="form-control" type="time" name="jam" placeholder="(AM 00:00-11:59 Siang / PM 12:00-11:59 Malam)" required>
                                                    <label>(AM 00:00-11:59 Siang / PM 12:00-11:59 Malam)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="input-group input-group-static mb-2">
                                                <h6 class="mb-n2">Nama Gang / Patokan</h6>
                                                <input class="form-control" type="text" name="patokan_alamat" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="input-group input-group-static mb-2">
                                                <h6 class="mb-n2">Alamat Lengkap (Dengan RT/RW)</h6>
                                                <textarea class="form-control" name="alamat" rows="3" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="input-group input-group-static mb-2">
                                                <h6 class="mb-n2">Catatan Pesanan Sesuai Request</h6>
                                                <textarea class="form-control" name="catatan_pesanan" rows="5" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <h5>Detail Pesanan</h5>
                                        <hr class="horizontal bg-dark mt-0" />
                                        <div id="keranjangsaya mb-4">
                                            <?php $items = getCartItems();
                                            $totalQuantity = 0;
                                            $totalHarga = 0;
                                            $totalKeranjang = 0;
                                            foreach ($items as $citem) {
                                                $totalQuantity += $citem['prod_qty'];
                                                $totalHarga += $citem['harga_jual'] * $citem['prod_qty'];
                                                $totalKeranjang++;
                                            ?>
                                                <div class="product_data mb-4">
                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-2">
                                                            <img src="assets/images/produk/<?= $citem['image'] ?>" alt="<?= $citem['nama'] ?>" width="60px">
                                                        </div>
                                                        <div class="col-md-5 mt-2">
                                                            <h6><?= $citem['nama'] ?></h6>
                                                        </div>
                                                        <div class="col-md-3 mt-2">
                                                            <h6>Rp. <?= $citem['harga_jual'] ?></h6>
                                                        </div>
                                                        <div class="col-md-2 mt-2">
                                                            <h6>x<?= $citem['prod_qty'] ?></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <hr class="horizontal bg-dark mt-2" />
                                        <h5>Total : Rp. <?= number_format($totalHarga, 0, ',', '.') ?></h5>
                                        <h6>Total Quantity: <?= $totalQuantity ?></h6>
                                        <hr class="horizontal bg-dark mt-2" />
                                        <?php
                                        // Menghitung 50% dari total harga sebagai DP
                                        $dpAmount = $totalHarga * 0.5;

                                        $now = time(); // Waktu saat ini dalam detik
                                        $deadlineHour = 23; // Jam batas pembayaran (23:00 WIB)
                                        // Jika waktu saat ini sudah melewati batas waktu, tambahkan 1 hari ke waktu batas pembayaran
                                        if (date('H') >= $deadlineHour) {
                                            $deadlineTime = strtotime(date("Y-m-d", strtotime("+1 day")) . " " . $deadlineHour . ":00:00");
                                        } else {
                                            $deadlineTime = strtotime(date("Y-m-d") . " " . $deadlineHour . ":00:00");
                                        }

                                        // Hitung selisih waktu antara waktu saat ini dan waktu batas pembayaran
                                        $timeDiff = $deadlineTime - $now;

                                        // Konversi selisih waktu ke dalam jam dan menit
                                        $hours = floor($timeDiff / 3600);
                                        $minutes = floor(($timeDiff % 3600) / 60);
                                        $seconds = $timeDiff % 60;
                                        ?>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn bg-gradient-primary w-100" data-bs-toggle="modal" data-bs-target="#exampleModalSignup">Checkout
                                            (<?= $totalKeranjang ?>) </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalSignup" tabindex="-1" aria-labelledby="exampleModalSignup" aria-hidden="true">
                                            <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body p-0">
                                                        <div class="card card-plain">
                                                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                                <div class="bg-gradient-primary shadow-primary border-radius-xl py-3 pe-1 text-center py-4">
                                                                    <h4 class="font-weight-bolder text-white mt-2">
                                                                        BUKTI TRANSFER
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="card-body pb-3">
                                                                <h5 class="text-center">Transfer Ke Rekening Dibawah Ini
                                                                </h5>
                                                                <div class="row col-md-12 align-items-center mb-2">
                                                                    <?php
                                                                    $rekening = getRekening("rekening");
                                                                    if (mysqli_num_rows($rekening) > 0) {
                                                                        foreach ($rekening as $itemrek) {
                                                                    ?>
                                                                            <div class="col-md-4 text-center align-items-center">
                                                                                <img src="assets/images/rekening/<?= $itemrek['foto_bank'] ?>" alt="" width="100px">
                                                                            </div>

                                                                    <?php
                                                                        }
                                                                    } else {
                                                                        echo "Tidak ada Data Bank";
                                                                    }
                                                                    ?>

                                                                </div>
                                                                <h6 class="ms-1">Pilih Bank Tujuan</h6>
                                                                <div class="col-md-3 input-group input-group-outline mb-3">
                                                                    <select name="rekening_id" class=" form-select mx-1 ms-1" id="rekening_id" onchange="pilihBank()">
                                                                        <option value="">--Pilih Bank--</option>
                                                                        <?php
                                                                        $rekening = getRekening("rekening");
                                                                        if (mysqli_num_rows($rekening) > 0) {
                                                                            foreach ($rekening as $itemrek) {
                                                                        ?>
                                                                                <option value="<?= $itemrek['id']; ?>">
                                                                                    <?= $itemrek['nama_bank'] ?>
                                                                                </option>
                                                                        <?php
                                                                            }
                                                                        } else {
                                                                            echo "Tidak ada Data Bank";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <input type="hidden" name="nama_bank" id="nama_bank">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <h6 class="ms-1">Nomor Rekening</h6>
                                                                        <div class="justify-space-between mb-3">
                                                                            <input type="text" class="form-control mx-1" placeholder="Nomor Rekening" id="no_rek" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <h6 class="ms-1">Atas Nama</h6>
                                                                        <div class="justify-space-between mb-3">
                                                                            <input type="text" name="nama_rek" id="nama_rek" class="form-control mx-1" class="form-control mx-1" placeholder="Nama Rekening" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <h6 class="ms-1">Upload Bukti Transfer</h6>
                                                                <div class="input-group input-group-outline mb-3">
                                                                    <input type="file" name="image" class="form-control mx-1" placeholder="Upload Gambar" required>
                                                                </div>
                                                                <label class="mb-0">*Bayar Dp 50% Sebesar <b>Rp.
                                                                        <?= number_format($dpAmount, 0, ',', '.') ?></b>
                                                                    Sebelum <b>Jam
                                                                        <?= $deadlineHour ?>:00
                                                                        WIB</b></label>
                                                                <label class="mb-0" id="countdown">*Hitungan Mundur
                                                                    <strong id="countdown-text"><?= $hours ?> Jam
                                                                        <?= $minutes ?>
                                                                        Menit
                                                                        <?= $seconds ?> Detik</strong></label>
                                                                <label class="mb-0">*Jika Melebihi Batas Waktu Yang
                                                                    Ditentukan, Maka Pesanan Akan Dibatalkan</label>
                                                                <label class="mb-0">*Harap Lunasi H-1 dan Akan
                                                                    Dikonfirmasi Melalui Whatsapp</label>
                                                                <label class="mb-3">*Untuk Pembayaran COD dilunasi di
                                                                    Tempat</label>
                                                                <div class="text-center">
                                                                    <button type="submit" name="checkout" class="btn bg-gradient-primary w-100">Checkout
                                                                        (<?= $totalKeranjang ?>) </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>