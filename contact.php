<?php
include 'controller/userfunction.php';
include 'autentikasi.php';
include 'includes/header.php';
?>
<header>
    <div class="page-header min-vh-65 bg-gradient-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center my-auto">
                    <div class="brand">
                        <h1 class="text-white mb-0">Contact</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="card card-body shadow mx-2 mx-md-4 mt-n6">
    <section class="py-sm-7 py-5 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <h3 class="text-center">Contact</h3>
                    <div class="card-body pb-3">
                        <form action="controller/send.php" method="POST" target="_blank">
                            <label class="mb-n2" for="">Nama Lengkap</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="name" class="form-control mx-1" placeholder="Nama Lengkap"
                                    required>
                            </div>
                            <label class="mb-n2" for="">Pesan</label>
                            <div class="input-group input-group-outline mb-3">
                                <textarea rows="5" name="pesan" class="form-control mx-1" placeholder="Isi Pesan"
                                    required></textarea>
                            </div>
                            <input type="hidden" name="noWa" value="6281386146350">
                            <div class="text-center">
                                <button type="submit" name="kirim_pesan"
                                    class="btn bg-gradient-primary w-100 mt-4 mb-3">KIRIM
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
</div>
</div>
</div>
<?php include 'includes/footer.php' ?>