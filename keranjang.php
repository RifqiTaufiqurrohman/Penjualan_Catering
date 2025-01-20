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
                        <li class="breadcrumb-item text-dark active mb-1 mt-1" aria-current="page">Keranjang</li>
                    </ol>
                </nav>
            </div>
            <h3>Keranjang</h3>
            <div class="card card-body md-2 mt-4 shadow-secondary">
                <div class="container py-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="keranjangsaya">
                                <?php $items = getCartItems();
                            $totalQuantity = 0;
                            $totalHarga = 0;
                            $totalKeranjang = 0;
                            if (mysqli_num_rows($items) > 0) {
                            ?>
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <h5>Produk</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>Harga</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>Jumlah</h5>
                                    </div>
                                    <div class="col-md-2 text-start">
                                        <h5>Aksi</h5>
                                    </div>
                                </div>
                                <div id="">
                                    <?php
                                    foreach ($items as $citem) {
                                        $totalQuantity += $citem['prod_qty'];
                                        $totalHarga += $citem['harga_jual'] * $citem['prod_qty'];
                                        $totalKeranjang++;
                                    ?>
                                    <div class="product_data">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <img src="assets/images/produk/<?= $citem['image'] ?>"
                                                    alt="<?= $citem['nama'] ?>" width="70px">
                                            </div>
                                            <div class="col-md-3">
                                                <h6><?= $citem['nama'] ?></h6>
                                            </div>
                                            <div class="col-md-2 hargajl">
                                                <h6>Rp. <?= $citem['harga_jual'] ?></h6>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="hidden" class="prodId" value="<?= $citem['prod_id'] ?>">
                                                <div class="input-group mt-2" style="width:140px">
                                                    <button
                                                        class="btn btn-primary text-lg px-3 mb-4 decrement-btn updateQty "
                                                        type="button"> -
                                                    </button>
                                                    <input type="text" class="form-control text-center input-qty mb-4"
                                                        value="<?= $citem['prod_qty'] ?>" disabled>
                                                    <button class="btn btn-primary px-3 mb-4 increment-btn updateQty "
                                                        type="button">
                                                        +
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-2 text-start">
                                                <button class="btn bg-gradient-primary deleteItem"
                                                    value="<?= $citem['cid'] ?>">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <hr class="horizontal bg-dark mt-4" />
                                <div class="float-end">
                                    <h5>Total : Rp. <?= number_format($totalHarga, 0, ',', ',') ?></h5>
                                    <h6>Total Quantity: <?= $totalQuantity ?></h6>
                                    <a href="checkout.php" class="btn bg-gradient-primary w-100">Checkout
                                        (<?= $totalKeranjang ?>)</a>
                                </div>
                                <?php
                            } else{
                                ?>
                                <div class="text-center">
                                    <h6>Tidak Ada Produk Di Keranjang</h6>
                                    <a href="category.php" class="btn bg-gradient-primary">Belanja Sekarang</a>
                                </div>
                                <?php
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>