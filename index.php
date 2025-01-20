<!-- Header -->
<?php

include 'controller/userfunction.php';
include 'includes/header.php';
?>

<header>
    <div class="page-header min-vh-75 bg-gradient-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 my-auto">
                    <?php if (isset($_SESSION['message'])) { ?>
                        <div class="alert alert-warning alert-dismissible text-white mt-4 mx-3 mb-0 " role="alert">
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
                    <div class="brand">
                        <h1 class="text-white mb-0"> Ardina Catering</h1>
                        <p class="text-white opacity-8"> Selamat datang di Ardina Catering Kami adalah pilihan utama
                            bagi mereka yang menginginkan pengalaman kuliner yang luar biasa dalam setiap acara penting
                            mereka. </p>
                        <a href="category.php" class="btn bg-gradient-primary mt-4" type="button" name="button">Order
                            Sekarang</a>
                    </div>
                </div>
                <div class="col-lg-6 ms-auto">
                    <img src="assets/images/pngegg (5).png" class="w-90 z-index-2 mt-5" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</header>
<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6 my-auto">
                <h3>Tentang Ardina Catering</h3>
                <p class="pe-5">Ardina Catering adalah Perusahaan yang beroperasi dibawah naungan CV. Ardina Berkah
                    Mulia, yang berlokasi di Buaran jati kecamatan sukadiri, Kabupaten Tangerang, Banten. Ardina
                    Catering adalah sebuah usaha mikro kecil dan menengah (UMKM) yang bergerak di bidang jasa boga telah
                    beroperasi sejak tahun 2019</p>
                <a href="about.php" class="text-primary icon-move-right">More about us
                    <i class="fas fa-arrow-right text-sm ms-1"></i>
                </a>
            </div>
            <div class="col-lg-6 mt-lg-0 mt-5 ps-lg-0 ps-0">
                <div class="p-3 info-horizontal">
                    <div class="icon icon-shape  bg-gradient-primary shadow-primary text-center">
                        <i class="fa fa-signal"></i>
                    </div>
                    <div class="description ps-3">
                        <p class="mb-0">Menjamin Kebersihan dan Nilai Gizi Makanan Sampai ke Tangan Pelanggan.</p>
                    </div>
                </div>

                <div class="p-3 info-horizontal">
                    <div class="icon icon-shape  bg-gradient-primary shadow-primary text-center">
                        <i class="fa fa-handshake-o"></i>
                    </div>
                    <div class="description ps-3">
                        <p class="mb-0">Menghasilkan kepuasan Rasa dan Layanan Sesuai Harapan Pelanggan.</p>
                    </div>
                </div>
                <div class="p-3 info-horizontal">
                    <div class="icon icon-shape  bg-gradient-primary shadow-primary text-center">
                        <i class="fa fa-hourglass"></i>
                    </div>
                    <div class="description ps-3">
                        <p class="mb-0">Dengan Semangat Tinggi dan keterampilan Kuliner Yang Luar Biasa.</p>
                    </div>
                </div>
            </div>
        </div>
        <hr class="horizontal dark mt-4 mb-4" />
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-center">TRENDING</h4>
                <div class="owl-carousel owl-theme mt-4">
                    <?php
                    $trendingProduk = getAllTrending();
                    if (mysqli_num_rows($trendingProduk) > 0) {
                        foreach ($trendingProduk as $item) {
                    ?>
                            <div class="item">
                                <a href="menu-detail.php?menu=<?= $item['slug']; ?>">
                                    <div class="card shadow-secondary mt-4 mb-4 ms-1">
                                        <div
                                            class="card-header p-0 mx-4 mt-n4 position-relative z-index-2 d-block shadow-secondary">
                                            <img src="assets/images/produk/<?= $item['image']; ?>" alt="Collections Image"
                                                class="img-fluid border-radius-lg ">
                                        </div>
                                        <div class="card-body">
                                            <h5> <?= $item['nama']; ?> </h5>
                                            <p>Rp. <?= $item['harga_jual']; ?></p>
                                        </div>
                                </a>
                            </div>
                </div>

        <?php
                        }
                    }
        ?>
            </div>
            <hr class="horizontal dark mt-4 mb-4" />
            <div class="col-lg-12">
                <h4 class="text-center">LOKASI</h4>
                <div class="card shadow-secondary mt-4">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.390198276872!2d106.54525951000541!3d-6.078006759609687!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a01acdccc955d%3A0x22ed244c8ba2557e!2sARDINA%20CATERING!5e0!3m2!1sid!2sid!4v1703857142289!5m2!1sid!2sid"
                        style="border:0; width: 100%; height: 350px;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Footer -->
<?php include 'includes/footer.php' ?>