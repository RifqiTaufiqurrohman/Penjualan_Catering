<?php
include 'controller/userfunction.php';
include 'includes/header.php';

if (isset($_GET['category'])) {
    $category_slug = $_GET['category'];
    $category_data = getSlugActive("kategori", $category_slug);
    $category = mysqli_fetch_array($category_data);

    if ($category) {
        $cid = $category['id'];
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
                                    <?= $category['nama']; ?>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <h3><?= $category['nama']; ?></h3>
                    <div class="row">
                        <?php
                        $menu = getMenuByKategori($cid);
                        if (mysqli_num_rows($menu) > 0) {
                            foreach ($menu as $item) {
                        ?>
                                <div class="col-md-3 mb-2 mt-5">
                                    <a href="menu-detail.php?menu=<?= $item['slug']; ?>">
                                        <div class="card">
                                            <div class="card-header p-0 mx-3 mt-n4 position-relative z-index-2 d-block shadow-dark">
                                                <img src="assets/images/produk/<?= $item['image']; ?>" alt="Collections Image" class="img-fluid border-radius-lg ">
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
                        } else {
                            echo "Tidak Ada Data Menu";
                        }
            ?>
                </div>
            </div>
        </div>
        </div>
<?php
    } else {
        echo "Ada Yang Salah";
    }
} else {
    echo "Ada Yang Salah";
}
include 'includes/footer.php'; ?>