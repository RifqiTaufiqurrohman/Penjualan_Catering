<?php

include '../Middleware/adminMiddleware.php';
include 'includes/header.php';

$limit = 10; // Number of entries to show in a page.
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number.
$start = ($page - 1) * $limit; // Calculate the offset for the query.

$produk_query = "SELECT * FROM produk LIMIT $start, $limit";
$produk = mysqli_query($conn, $produk_query);

$total_query = "SELECT COUNT(*) FROM produk";
$total_result = mysqli_query($conn, $total_query);
$total_data = mysqli_fetch_array($total_result)[0];

$total_pages = ceil($total_data / $limit);

?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n5 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h5 class="text-white text-capitalize ps-4">
                            PRODUK
                        </h5>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <?php if (isset($_SESSION['message'])) { ?>
                            <div class="alert alert-warning alert-dismissible text-white mx-3" role="alert">
                                <strong>Hey</strong> <?= $_SESSION['message']; ?>.
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                            unset($_SESSION['message']);
                        }
                        ?>
                        <div class="d-flex justify-content-end mx-3">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#tambahproduk"><i class="large material-icons mb-0">add</i>
                                <span class="mb-0"> Tambah Produk</span>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="tambahproduk" tabindex="-1" aria-labelledby="exampleModalSignup" aria-hidden="true">
                                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card card-plain">
                                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                    <div class="bg-gradient-primary shadow-primary border-radius-xl py-3 pe-1 text-center py-4">
                                                        <h4 class="font-weight-bolder text-white mt-2">TAMBAH PRODUK
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="card-body pb-3">
                                                    <form action="controller/code.php" method="POST" enctype="multipart/form-data">
                                                        <div class="col-md-3 input-group input-group-outline mb-3">
                                                            <select name="kategori_id" class=" form-select mx-1 ms-1">
                                                                <option selected>Pilih Kategori</option>
                                                                <?php
                                                                $categories = getAll("kategori");
                                                                if (mysqli_num_rows($categories) > 0) {
                                                                    foreach ($categories as $item) {
                                                                ?>
                                                                        <option value="<?= $item['id']; ?>"><?= $item['nama'] ?>
                                                                        </option>
                                                                <?php
                                                                    }
                                                                } else {
                                                                    echo "Tidak ada Kategori";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 input-group input-group-outline mb-3">
                                                            <input type="text" name="name" class="form-control mx-1" placeholder="Nama Produk" required>
                                                            <input type="text" name="slug" class="form-control mx-1" placeholder="Slug" required>
                                                        </div>
                                                        <div class="col-md-3 input-group input-group-outline mb-3">
                                                            <textarea rows="5" name="deskripsi" type="text" class="form-control mx-1" placeholder="Deskripsi Produk" required></textarea>
                                                        </div>
                                                        <div class="col-md-3 input-group input-group-outline mb-3">
                                                            <input type="text" name="harga_asli" class="form-control mx-1" placeholder="Harga Asli" required>
                                                            <input type="text" name="harga_jual" class="form-control mx-1" placeholder="Harga Jual" required>
                                                        </div>
                                                        <div class="input-group input-group-outline mb-3">
                                                            <input type="file" name="image" class="form-control mx-1" placeholder="Upload Gambar" required>
                                                        </div>
                                                        <div class="col-md-3 input-group input-group-outline mb-3">
                                                            <div class="form-check form-check-info d-flex float-start ps-0 mx-2">
                                                                <input class="form-check-input mt-2 mb-0" type="checkbox" name="status" value="" id="flexCheckDefault" checked="">
                                                                <label class="form-check-label mt-2 mb-0 ms-2 mx-6" for="flexCheckDefault">
                                                                    Hide
                                                                </label>
                                                                <input class="form-check-input mt-2 mb-0" type="checkbox" name="trending" value="" id="flexCheckDefault" checked="">
                                                                <label class="form-check-label mt-2 mb-0 ms-2 mx-7" for="flexCheckDefault">
                                                                    Trending
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" name="tambah_produk" class="btn bg-gradient-primary w-100 mt-4 mb-2">Tambah
                                                                Produk</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        No</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Nama</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Images</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Harga Asli</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Harga Jual</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Status</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // $produk = getAll('produk');
                                $i = $start + 1;
                                if (mysqli_num_rows($produk) > 0) {
                                    while ($item = mysqli_fetch_array($produk)) {
                                ?>
                                        <tr>
                                            <td>
                                                <p class="text-center text-sm font-weight-bold mb-0">
                                                    <?= $i++ ?>
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-center text-sm font-weight-bold mb-0">
                                                    <?= $item['nama'] ?>
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <img src="../assets/images/produk/<?= $item['image'] ?>" width="50px" alt="<?= $item['nama'] ?>">
                                            </td>
                                            <td>
                                                <p class="text-center text-sm font-weight-bold mb-0">
                                                    <?= $item['harga_asli'] ?>
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-center text-sm font-weight-bold mb-0">
                                                    <?= $item['harga_jual'] ?>
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?php
                                                if ($item['status']) {
                                                    // Checkbox aktif, tampilkan badge dengan class bg-gradient-secondary
                                                ?>
                                                    <span class="badge badge-sm bg-gradient-secondary">Hidden</span>
                                                <?php
                                                } else {
                                                    // Checkbox tidak aktif, tampilkan badge dengan class bg-gradient-success
                                                ?>
                                                    <span class="badge badge-sm bg-gradient-success">Visible</span>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <!-- Button trigger modal Edit-->
                                                <button type="button" class="btn bg-gradient-primary mb-0" data-bs-toggle="modal" data-bs-target="#editproduk<?= $item['id'] ?>
                                                ">
                                                    EDIT
                                                </button>
                                                <!-- Button trigger modal Delete-->
                                                <button type="button" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#deleteproduk<?= $item['id'] ?>">
                                                    HAPUS
                                                </button>

                                            </td>
                                            <!-- MODAL EDIT PRODUK -->
                                            <div class="modal fade" id="editproduk<?= $item['id'] ?>" tabindex="-1" aria-labelledby="exampleModalcategory" aria-hidden="true">
                                                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-0">
                                                            <div class="card card-plain">
                                                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                                    <div class="bg-gradient-primary shadow-primary border-radius-xl py-3 pe-1 text-center py-4">
                                                                        <h4 class="font-weight-bolder text-white mt-2">EDIT
                                                                            PRODUK
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body pb-3">
                                                                    <form action="controller/code.php" method="POST" enctype="multipart/form-data">
                                                                        <div class="col-md-3 input-group input-group-outline mb-3">
                                                                            <input type="hidden" name="id_produk" value="<?= $item['id'] ?>">
                                                                        </div>
                                                                        <div class="col-md-3 input-group input-group-outline mb-3">
                                                                            <select name="kategori_id" class=" form-select mx-1 ms-1">
                                                                                <option selected>Pilih Kategori</option>
                                                                                <?php
                                                                                $categories = getAll("kategori");
                                                                                if (mysqli_num_rows($categories) > 0) {
                                                                                    foreach ($categories as $itemc) {
                                                                                ?>
                                                                                        <option value="<?= $itemc['id']; ?>" <?= $item['kategori_id'] == $itemc['id'] ? 'selected' : '' ?>>
                                                                                            <?= $itemc['nama']; ?>
                                                                                        </option>
                                                                                <?php
                                                                                    }
                                                                                } else {
                                                                                    echo "Tidak ada Kategori";
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-3 input-group input-group-outline mb-3">
                                                                            <input type="text" name="name" class="form-control mx-1" placeholder="Nama Produk" value="<?= $item['nama'] ?>" required>
                                                                            <input type="text" name="slug" class="form-control mx-1" placeholder="Slug" value="<?= $item['slug'] ?>" required>
                                                                        </div>
                                                                        <div class="col-md-3 input-group input-group-outline mb-3">
                                                                            <textarea rows="5" name="deskripsi" type="text" class="form-control mx-1" placeholder="Deskripsi Produk" required><?= $item['deskripsi'] ?></textarea>
                                                                        </div>
                                                                        <div class="col-md-3 input-group input-group-outline mb-3">
                                                                            <input type="text" name="harga_asli" class="form-control mx-1" placeholder="Harga Asli" value="<?= $item['harga_asli'] ?>" required>
                                                                            <input type="text" name="harga_jual" class="form-control mx-1" placeholder="Harga Jual" value="<?= $item['harga_jual'] ?>" required>
                                                                        </div>
                                                                        <div class="input-group input-group-inline mb-3">
                                                                            <input type="hidden" name="old_image" value="<?= $item['image'] ?>">
                                                                            <img src="../assets/images/produk/<?= $item['image'] ?>" alt="" class="mx-1" width="100px">
                                                                            <input type="file" name="image" class="form-control mx-1" placeholder="Upload Gambar">
                                                                        </div>
                                                                        <div class="col-md-3 input-group input-group-outline mb-3">
                                                                            <div class="form-check form-check-info d-flex float-start ps-0 mx-2">
                                                                                <input class="form-check-input mt-2 mb-0" id="flexCheckDefault" type="checkbox" name="status" <?= $item['status'] == '0' ? '' : 'checked' ?>>
                                                                                <label class="form-check-label mt-2 mb-0 ms-2 mx-6" for="flexCheckDefault">
                                                                                    Hide
                                                                                </label>
                                                                                <input class="form-check-input mt-2 mb-0" type="checkbox" name="trending" id="flexCheckDef" <?= $item['trending'] == '0' ? '' : 'checked' ?>>
                                                                                <label class="form-check-label mt-2 mb-0 ms-2 mx-7" for="flexCheckDef">
                                                                                    Trending
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-center">
                                                                            <button type="submit" name="update_produk" class="btn bg-gradient-primary w-100 mt-4 mb-2">Edit
                                                                                Produk</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END MODAL EDIT PRODUK -->
                                            <!-- MODAL HAPUS PRODUK -->
                                            <div class="modal fade" id="deleteproduk<?= $item['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus
                                                                Produk</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="controller/code.php" method="POST">
                                                            <div class="modal-body">
                                                                <p class="text-center text-sm font-weight-bold mb-0">Apakah Anda
                                                                    yakin Ingin Menghapus <?= $item['nama'] ?> ?</p>
                                                            </div>
                                                            <div class="modal-footer justify-content">
                                                                <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal">Close</button>
                                                                <input type="hidden" name="produk_id" value="<?= $item['id'] ?>">
                                                                <button type="submit" name="hapus_produk" class="btn bg-gradient-primary mb-0">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END MODAL HAPUS PRODUK -->
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "Tidak ada data yang ditemukan";
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="row justify-space-between py-2">
                            <div class="col-lg-4 mx-auto">
                                <ul class="pagination pagination-primary m-4">
                                    <?php if ($page > 1) : ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                                <span aria-hidden="true"><i class="material-icons" aria-hidden="true">chevron_left</i></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <?php if ($page < $total_pages) : ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                                                <span aria-hidden="true"><i class="material-icons" aria-hidden="true">chevron_right</i></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>