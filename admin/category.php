<?php

include '../Middleware/adminMiddleware.php';
include 'includes/header.php';

$limit = 10; // Number of entries to show in a page.
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number.
$start = ($page - 1) * $limit; // Calculate the offset for the query.

$category_query = "SELECT * FROM kategori LIMIT $start, $limit";
$category = mysqli_query($conn, $category_query);

$total_query = "SELECT COUNT(*) FROM kategori";
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
                            KATEGORI
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
                            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModalSignup">
                                <i class="large material-icons mb-0">add</i>
                                <span class="mb-0"> Tambah Kategori</span>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalSignup" tabindex="-1" aria-labelledby="exampleModalSignup" aria-hidden="true">
                                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card card-plain">
                                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                    <div class="bg-gradient-primary shadow-primary border-radius-xl py-3 pe-1 text-center py-4">
                                                        <h4 class="font-weight-bolder text-white mt-2">TAMBAH KATEGORI
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="card-body pb-3">
                                                    <form action="controller/code.php" method="POST" enctype="multipart/form-data">
                                                        <div class="col-md-3 input-group input-group-outline mb-3">
                                                            <input type="text" name="name" class="form-control mx-1" placeholder="Nama Kategori" required>
                                                            <input type="text" name="slug" class="form-control mx-1" placeholder="Slug" required>
                                                        </div>
                                                        <div class="col-md-3 input-group input-group-outline mb-3">
                                                            <textarea rows="4" name="deskripsi" type="text" class="form-control mx-1" placeholder="Deskripsi" required></textarea>
                                                        </div>
                                                        <div class="input-group input-group-outline mb-3">
                                                            <input type="file" name="image" class="form-control mx-1" placeholder="Upload Gambar" required>
                                                        </div>
                                                        <div class="form-check form-check-info d-flex float-start ps-0 mx-1">
                                                            <input class="form-check-input mt-0" type="checkbox" name="status" value="" id="flexCheckDefault" checked="">
                                                            <label class="form-check-label mb-0 ms-1 mx-4" for="flexCheckDefault">
                                                                Status
                                                            </label>
                                                            <input class="form-check-input mt-0" type="checkbox" name="popular" value="" id="flexCheckDefault" checked="">
                                                            <label class="form-check-label mb-0 ms-1 mx-1" for="flexCheckDefault">
                                                                Popular
                                                            </label>
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" name="add_category_btn" class="btn bg-gradient-primary w-100 mt-4 mb-3">
                                                                Tambah
                                                                Kategori</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table align-items-center mb-0" data-page-length="10">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        No</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Nama</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Images</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Status</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // $category = getAll('kategori');
                                $i = $start + 1;
                                if (mysqli_num_rows($category) > 0) {
                                    while ($item = mysqli_fetch_array($category)) {
                                ?>
                                        <tr>
                                            <td>
                                                <p class="text-center text-sm font-weight-bold mb-0">
                                                    <?= $i++ ?></p>
                                            </td>
                                            <td>
                                                <p class="text-center text-sm font-weight-bold mb-0">
                                                    <?= $item['nama'] ?></p>
                                            </td>
                                            <td class="text-center">
                                                <img src="../assets/images/category/<?= $item['image'] ?>" width="50px" alt="<?= $item['nama'] ?>">
                                            </td>
                                            <td class="align-middle text-center">
                                                <?php
                                                if ($item['status'] == '0') {
                                                ?>
                                                    <span class="badge badge-sm bg-gradient-success">Visible</span>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="badge badge-sm bg-gradient-secondary">Hidden</span>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <!-- Button trigger modal Edit-->
                                                <button type="button" class="btn bg-gradient-primary mb-0" data-bs-toggle="modal" data-bs-target="#editcategory<?= $item['id'] ?>">
                                                    EDIT
                                                </button>
                                                <!-- Button trigger modal Delete-->
                                                <button type="button" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#deletecategory<?= $item['id'] ?>">
                                                    HAPUS
                                                </button>

                                            </td>
                                            <!-- MODAL EDIT KATGORI -->
                                            <div class="modal fade" id="editcategory<?= $item['id'] ?>" tabindex="-1" aria-labelledby="exampleModalcategory" aria-hidden="true">
                                                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-0">
                                                            <div class="card card-plain">
                                                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                                    <div class="bg-gradient-primary shadow-primary border-radius-xl py-3 pe-1 text-center py-4">
                                                                        <h4 class="font-weight-bolder text-white mt-2">EDIT
                                                                            KATEGORI
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body pb-3">
                                                                    <form action="controller/code.php" method="POST" enctype="multipart/form-data">
                                                                        <div class="col-md-3 input-group input-group-outline mb-3">
                                                                            <input type="hidden" name="id_kategori" value="<?= $item['id'] ?>">
                                                                        </div>
                                                                        <div class="col-md-3 input-group input-group-outline mb-3">
                                                                            <input type="text" name="name" class="form-control mx-1" placeholder="Nama Kategori" value="<?= $item['nama'] ?>" required>
                                                                            <input type="text" name="slug" class="form-control mx-1" placeholder="Slug" value="<?= $item['slug'] ?>" required>
                                                                        </div>
                                                                        <div class=" col-md-3 input-group input-group-outline
                                                                        mb-3">
                                                                            <textarea rows="4" name="deskripsi" type="text" class="form-control mx-1" placeholder="Deskripsi" required><?= $item['deskripsi'] ?></textarea>
                                                                        </div>
                                                                        <div class="input-group input-group-outline mb-3">
                                                                            <input type="file" name="image" class="form-control mx-1" placeholder="Upload Gambar">
                                                                            <input type="hidden" name="old_image" value="<?= $item['image'] ?>">
                                                                            <img src="../assets/images/category/<?= $item['image'] ?>" alt="" width="50px">
                                                                        </div>
                                                                        <div class="form-check form-check-info d-flex float-start ps-0 mx-1">
                                                                            <input class="form-check-input mt-0" type="checkbox" name="status" id="flexCheckDefault" <?= $item['status'] ? "checked" : "" ?>>
                                                                            <label class="form-check-label mb-0 ms-1 mx-4" for="flexCheckDefault">
                                                                                Status
                                                                            </label>
                                                                            <input class="form-check-input mt-0" type="checkbox" name="popular" id="flexCheckDefault" <?= $item['popular'] ? "checked" : "" ?>>
                                                                            <label class="form-check-label mb-0 ms-1 mx-1" for="flexCheckDefault">
                                                                                Popular
                                                                            </label>
                                                                        </div>
                                                                        <div class="text-center">
                                                                            <button type="submit" name="update_category_btn" class="btn bg-gradient-primary w-100 mt-4 mb-3">EDIT
                                                                                KATEGORI</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END MODAL EDIT KATEGORI -->
                                            <!-- MODAL HAPUS KATEGORI-->
                                            <div class="modal fade" id="deletecategory<?= $item['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus
                                                                Kategori</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="controller/code.php" method="POST">
                                                            <div class="modal-body">
                                                                <p class="text-center text-sm font-weight-bold mb-0">Apakah Anda
                                                                    yakin Ingin Menghapus <?= $item['nama'] ?></p>
                                                            </div>
                                                            <div class="modal-footer justify-content">
                                                                <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal">Close</button>
                                                                <input type="hidden" name="category_id" value="<?= $item['id'] ?>">
                                                                <button type="submit" name="hapus_kategori" class="btn bg-gradient-primary mb-0">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END MODAL HAPUS KATEGORI-->
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