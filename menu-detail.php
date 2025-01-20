<?php
include 'controller/userfunction.php';
include 'includes/header.php';

if (isset($_GET['menu'])) {
    $produk_slug = $_GET['menu'];
    $produk_data = getSlugActive("produk", $produk_slug);
    $produk = mysqli_fetch_array($produk_data);

    if ($produk) {
?>
<div class="container py-5 ">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4 w-100 mt-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white shadow-secondary ">
                        <li class="breadcrumb-item text-dark opacity-5 mb-1 mt-1"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item text-dark opacity-5 mb-1 mt-1"><a href="category.php">Collections</a>
                        </li>
                        <li class="breadcrumb-item text-dark active mb-1 mt-1" aria-current="page">
                            <?= $produk['nama']; ?>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="card card-body shadow-secondary md-2 mt-5">
                <div class="container product_data py-5">
                    <div class="row">
                        <div class="col-lg-6 my-auto text-center mt-n4 mb-4">
                            <img src="assets/images/produk/<?= $produk['image']; ?>" class="w-95" alt="">
                        </div>
                        <div class="col-lg-6 mt-n4 ps-0">
                            <div class="p-3 info-horizontal">
                                <div class="description">
                                    <h4 class="mb-0"><?= $produk['nama']; ?>
                                        <span class="float-end text-danger">
                                            <?php if ($produk['trending']) {
                                                        echo "Trending";
                                                    } ?></span>
                                    </h4>
                                </div>
                            </div>

                            <div class="p-3 info-horizontal mt-n3 mb-n2">
                                <div class="description">
                                    <h6 class="mb-0">Deskripsi Produk</h6>
                                    <p class="text-sm"><?= $produk['deskripsi']; ?></p>
                                </div>
                            </div>
                            <div class="p-3 info-horizontal">
                                <div class="row align-items-start mt-n4">
                                    <div class="col-md-3">
                                        <h4 class="mb-0 opacity-7 "><del style="text-decoration: line-through red;">
                                                Rp. <?= $produk['harga_asli']; ?>
                                            </del></h4>
                                    </div>
                                    <div class="col-md-3">
                                        <?php
                                                // Menghitung diskon dalam persen
                                                $hargaAsli = $produk['harga_asli'];
                                                $hargaJual = $produk['harga_jual'];

                                                $diskonPersen = ($hargaAsli - $hargaJual) / $hargaAsli * 100;

                                                // Menampilkan harga jual
                                                echo '<h4 class="mb-1">Rp. <span>' . $hargaJual . '</span></h4>';
                                                ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                                // Menampilkan total diskon dalam persen
                                                echo '<h6 class="mt-1 opacity-7 ">' . number_format($diskonPersen) . '% Off</h6>';
                                                ?>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 info-horizontal mt-n2">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="input-group" style="width:140px">
                                            <button class="btn btn-primary decrement-btn text-lg px-3 mb-4"
                                                type="button"> - </button>
                                            <input type="text" class="form-control text-center input-qty mb-4" value="1"
                                                disabled>
                                            <button class="btn btn-primary increment-btn px-3 mb-4" type="button"> +
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="text-danger font-italic mt-n4">
                                            <p class="text-xs mb-n1">* Mohon Diperhatikan Sebelum Checkout !!!</p>
                                            <p class="text-xs mb-n1">* Minimal Pembelian 30 Box</p>
                                            <p class="text-xs mb-n1">* Request Olahan Sesuai Keinginan Ketik di Catatan
                                                Dipilih Salahsatu</p>
                                            <p class="text-xs mb-n1">* Cantumkan Nomor Whatsapp yang Benar dan Tedaftar
                                                !!!</p>
                                            <p class="text-xs mb-n1">* Jika Tidak Sesuai Ketentuan Makan Pesananan Akan
                                                Dibatalkan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 info-horizontal mt-n4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-primary addToCartBtn" value="<?= $produk['id']; ?>"><i
                                                class="fa fa-shopping-cart fixed-plugin-button-nav cursor-pointer"></i>
                                            Masukan Keranjang</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-body shadow-secondary md-2 mt-5">
                <div class="container py-3">
                    <div class="row">
                        <div class="col-lg-12 my-auto mt-n4 mb-4 p-3">
                            <h4 class="text-center">Ulasan</h4>
                            <hr class="dark horizontal my-0">
                            <?php
                                    $comments_query = "SELECT o.id as oid, o.user_id, o.status, o.comments, oi.*, oi.qty as orderqty, p.*, u.* FROM pesanan o, barang_pesanan oi, produk p, users u WHERE oi.id_pesanan=o.id AND p.id=oi.prod_id AND p.slug='$produk_slug' AND o.user_id=u.id AND o.status='2' ";
                                    $order_query_run = mysqli_query($conn, $comments_query);

                                    if (mysqli_num_rows($order_query_run)) {
                                        foreach ($order_query_run as $itemc) {
                                    ?>
                            <h6 class="mt-2"><?= $itemc['nama_lengkap'] ?></h6>
                            <span><?= $itemc['comments'] ?></span>
                            <hr class="dark horizontal my-0">
                            <?php
                                        }
                                    } else {
                                        ?>
                            <h6>Belum Ada Ulasan Terkait Produk Ini</h6>
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
<?php
    } else {
        echo "Menu Tidak Ditemukan";
    }
} else {
    echo "Ada Yang Salah";
}
?>
<?php include 'includes/footer.php'; ?>