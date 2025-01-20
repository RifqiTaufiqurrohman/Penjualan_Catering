<?php
include 'controller/userfunction.php';
include 'includes/header.php';
?>

<div class="container py-5 ">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4 mt-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white shadow-secondary ">
                        <li class="breadcrumb-item text-dark opacity-5 mb-1 mt-1"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item text-dark active mb-1 mt-1" aria-current="page">Collections</li>
                    </ol>
                </nav>
            </div>
            <h3>Collections</h3>
            <div class="row">
                <?php
                $kategori = getAllActive("kategori");
                if (mysqli_num_rows($kategori) > 0) {
                    foreach ($kategori as $item) {
                ?>
                <div class="col-md-3 col-sm-3 mb-2 mt-5 ">
                    <a href="menu.php?category=<?= $item['slug']; ?>">
                        <div class="card shadow-secondary">
                            <div class="card-header p-0 mx-3 mt-n4 position-relative z-index-2 d-block shadow-dark">
                                <img src="assets/images/category/<?= $item['image']; ?>" alt="Menu Image"
                                    class="img-fluid border-radius-lg ">
                            </div>
                            <div class="card-body">
                                <h5> <?= $item['nama']; ?> </h5>
                    </a>
                    <p><?= $item['deskripsi']; ?></p>
                </div>
            </div>
        </div>
        <?php
                    }
                } else {
                    echo "Tidak Ada Data Collections";
                }
?>
    </div>
</div>
</div>
</div>

<?php include 'includes/footer.php'; ?>