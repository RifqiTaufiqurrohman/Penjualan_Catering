<!-- Header -->
<?php

include 'controller/userfunction.php';
include 'includes/header.php';
?>

<header>
    <div class="page-header min-vh-65 bg-gradient-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center my-auto">
                    <div class="brand">
                        <h1 class="text-white mb-0">Gallery Ardina Catering</h1>
                        <p class="lead text-white opacity-8">Jelajahi koleksi foto-foto kami yang memukau, mulai dari
                            sajian elegan untuk pernikahan
                            hingga momen kebersamaan di acara korporat. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="card card-body shadow mx-3 mx-md-4 mt-n6">
    <!-- -------   START CONTENT 1 - title & description and 6 IMAGES   -------- -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto text-center mb-5">
                    <span class="badge badge-primary mb-2">Co-working</span>
                    <h2>Jelajahi Koleksi Foto Kami </h2>
                    <p>
                        Mengajak Anda untuk merayakan momen-momen istimewa. Terpesona oleh keindahan hidangan, dan
                        momen-momen tak terlupakan yang tertangkap dalam setiap frame. Buat kenangan baru bersama Ardina
                        Catering.
                    </p>
                </div>
            </div>
            <div class="row min-vh-25">
                <?php
                $gallery = getGallery("gallery");
                if (mysqli_num_rows($gallery) > 0) {
                    foreach ($gallery as $item) {
                ?>
                        <div class="col-sm-3 mb-4 text-center">
                            <a href="" data-bs-toggle="modal" data-bs-target="#lihatdetailgambar<?= $item['id'] ?>">
                                <img src="assets/images/gallery/<?= $item['image'] ?>" alt="" width="300" class="img-fluid border-radius-lg shadow-dark ">
                            </a>
                        </div>
                        <!-- MODAL DETAIL GAMBAR-->
                        <div class="modal fade" id="lihatdetailgambar<?= $item['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail Gambar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="assets/images/gallery/<?= $item['image'] ?>" alt="" width="100%">
                                        <p class="text-center text-sm font-weight-bold mb-0 mt-4"><?= $item['deskripsi'] ?></p>
                                    </div>
                                    <div class="modal-footer justify-content">
                                        <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- END MODAL HAPUS KATEGORI-->
                <?php
                    }
                } else {
                    echo "Tidak Ada Data Gallery";
                }
                ?>
            </div>
        </div>
    </section>
    <!-- -------   END CONTENT 1 - title & description and 6 IMAGES   -------- -->

</div>
</div>
</div>

<!-- Footer -->
<?php include 'includes/footer.php' ?>