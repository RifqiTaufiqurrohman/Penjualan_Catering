<?php

include '../Middleware/adminMiddleware.php';
include 'includes/header.php';

$limit = 10; // Number of entries to show in a page.
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number.
$start = ($page - 1) * $limit; // Calculate the offset for the query.

$rekening_query = "SELECT * FROM rekening LIMIT $start, $limit";
$rekening = mysqli_query($conn, $rekening_query);

$total_query = "SELECT COUNT(*) FROM rekening";
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
                            REKENING
                        </h5>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <?php if (isset($_SESSION['message'])) { ?>
                        <div class="alert alert-warning alert-dismissible text-white mx-3" role="alert">
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
                        <div class="d-flex justify-content-end mx-3">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModalSignup">
                                <i class="large material-icons mb-0">add</i>
                                <span class="mb-0"> Tambah Rekening</span>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalSignup" tabindex="-1"
                                aria-labelledby="exampleModalSignup" aria-hidden="true">
                                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card card-plain">
                                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                    <div
                                                        class="bg-gradient-primary shadow-primary border-radius-xl py-3 pe-1 text-center py-4">
                                                        <h4 class="font-weight-bolder text-white mt-2">TAMBAH REKENING
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="card-body pb-3">
                                                    <form action="controller/code.php" method="POST"
                                                        enctype="multipart/form-data">
                                                        <div class="input-group input-group-outline mb-3">
                                                            <input type="file" name="foto_bank"
                                                                class="form-control mx-1" placeholder="Upload Gambar"
                                                                required>
                                                        </div>
                                                        <div class="input-group input-group-outline mb-3">
                                                            <input type="text" name="name" class="form-control mx-1"
                                                                placeholder="Nama Bank" required>
                                                        </div>
                                                        <div class="input-group input-group-outline mb-3">
                                                            <input type="text" name="norek" class="form-control mx-1"
                                                                placeholder="Nomor Rekening" required>
                                                        </div>
                                                        <div class="input-group input-group-outline mb-3">
                                                            <input type="text" name="nama_rekening"
                                                                class="form-control mx-1" placeholder="Nama Rekening"
                                                                required>
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" name="add_rekening"
                                                                class="btn bg-gradient-primary w-100 mt-4 mb-3">
                                                                Tambah Rekening</button>
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
                                    <th
                                        class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        No</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Images</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Nama Bank</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Nomor Rekening</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Nama</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = $start + 1;
                                if (mysqli_num_rows($rekening) > 0) {
                                    while ($item = mysqli_fetch_array($rekening)) {
                                ?>
                                <tr>
                                    <td>
                                        <p class="text-center text-sm font-weight-bold mb-0">
                                            <?= $i++ ?></p>
                                    </td>
                                    <td class="text-center">
                                        <img src="../assets/images/rekening/<?= $item['foto_bank'] ?>" width="50px"
                                            alt="<?= $item['nama_bank'] ?>">
                                    </td>
                                    <td>
                                        <p class="text-center text-sm font-weight-bold mb-0">
                                            <?= $item['nama_bank'] ?></p>
                                    </td>
                                    <td>
                                        <p class="text-center text-sm font-weight-bold mb-0">
                                            <?= $item['no_rekening'] ?></p>
                                    </td>
                                    <td>
                                        <p class="text-center text-sm font-weight-bold mb-0">
                                            <?= $item['nama_rekening'] ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <!-- Button trigger modal Edit-->
                                        <button type="button" class="btn bg-gradient-primary mb-0"
                                            data-bs-toggle="modal" data-bs-target="#editrekening<?= $item['id'] ?>">
                                            EDIT
                                        </button>
                                        <!-- Button trigger modal Delete-->
                                        <button type="button" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal"
                                            data-bs-target="#deleterekening<?= $item['id'] ?>">
                                            HAPUS
                                        </button>
                                    </td>
                                    <!-- MODAL EDIT REKENING -->
                                    <div class="modal fade" id="editrekening<?= $item['id'] ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body p-0">
                                                    <div class="card card-plain">
                                                        <div
                                                            class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                            <div
                                                                class="bg-gradient-primary shadow-primary border-radius-xl py-3 pe-1 text-center py-4">
                                                                <h4 class="font-weight-bolder text-white mt-2">EDIT
                                                                    REKENING
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <div class="card-body pb-3">
                                                            <form action="controller/code.php" method="POST"
                                                                enctype="multipart/form-data">
                                                                <div
                                                                    class="col-md-3 input-group input-group-outline mb-3">
                                                                    <input type="hidden" name="id_rekening"
                                                                        value="<?= $item['id'] ?>">
                                                                </div>
                                                                <div class="input-group input-group-outline mb-3">
                                                                    <input type="file" name="foto_bank"
                                                                        class="form-control mx-1"
                                                                        placeholder="Upload Gambar">
                                                                    <input type="hidden" name="old_image"
                                                                        value="<?= $item['foto_bank'] ?>">
                                                                    <img src="../assets/images/rekening/<?= $item['foto_bank'] ?>"
                                                                        alt="" width="50px">
                                                                </div>
                                                                <div class="input-group input-group-outline mb-3">
                                                                    <input type="text" name="name"
                                                                        class="form-control mx-1"
                                                                        placeholder="Nama Bank"
                                                                        value="<?= $item['nama_bank'] ?>" required>
                                                                </div>
                                                                <div class="input-group input-group-outline mb-3">
                                                                    <input type="text" name="norek"
                                                                        class="form-control mx-1"
                                                                        placeholder="Nomor Rekening"
                                                                        value="<?= $item['no_rekening'] ?>" required>
                                                                </div>
                                                                <div class="input-group input-group-outline mb-3">
                                                                    <input type="text" name="nama_rekening"
                                                                        class="form-control mx-1"
                                                                        placeholder="Nama Rekening"
                                                                        value="<?= $item['nama_rekening'] ?>" required>
                                                                </div>
                                                                <div class="text-center">
                                                                    <button type="submit" name="update_rekening"
                                                                        class="btn bg-gradient-primary w-100 mt-4 mb-3">EDIT
                                                                        REKENING</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END MODAL EDIT REKENING-->
                                    <!-- MODAL HAPUS REKENING-->
                                    <div class="modal fade" id="deleterekening<?= $item['id'] ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus
                                                        Rekening</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="controller/code.php" method="POST">
                                                    <div class="modal-body">
                                                        <p class="text-center text-sm font-weight-bold mb-0">Apakah Anda
                                                            yakin Ingin Menghapus Rekening <?= $item['nama_bank'] ?> ?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer justify-content">
                                                        <button type="button" class="btn bg-gradient-dark mb-0"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <input type="hidden" name="rekening_id"
                                                            value="<?= $item['id'] ?>">
                                                        <button type="submit" name="hapus_rekening"
                                                            class="btn bg-gradient-primary mb-0">Hapus</button>
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
                                            <span aria-hidden="true"><i class="material-icons"
                                                    aria-hidden="true">chevron_left</i></span>
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
                                            <span aria-hidden="true"><i class="material-icons"
                                                    aria-hidden="true">chevron_right</i></span>
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