<?php

include '../Middleware/adminMiddleware.php';
include 'includes/header.php';

$limit = 10; // Number of entries to show in a page.
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number.
$start = ($page - 1) * $limit; // Calculate the offset for the query.

$users_query = "SELECT * FROM users LIMIT $start, $limit";
$users = mysqli_query($conn, $users_query);

$total_query = "SELECT COUNT(*) FROM users";
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
                            USERS
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
                                <span class="mb-0"> Tambah Users</span>
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
                                                        <h4 class="font-weight-bolder text-white mt-2">TAMBAH USERS
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="card-body pb-3">
                                                    <form action="controller/code.php" method="POST"
                                                        enctype="multipart/form-data">
                                                        <label class="mb-n2" for="">Nama Lengkap</label>
                                                        <div class="input-group input-group-outline mb-2">
                                                            <input type="text" class="form-control"
                                                                placeholder="Nama Lengkap" name="nama_user" required>
                                                        </div>
                                                        <label class="mb-n2" for="">Nomor Whatsapp</label>
                                                        <div class="input-group input-group-outline mb-2">
                                                            <input type="number" class="form-control"
                                                                placeholder="Nomor Whatsapp" name="telp_user" required>
                                                        </div>
                                                        <label class="mb-n2" for="">Email</label>
                                                        <div class="input-group input-group-outline mb-2">
                                                            <input type="email" class="form-control" placeholder="Email"
                                                                name="email_user" required>
                                                        </div>
                                                        <label class="mb-n2" for="">Foto Profile</label>
                                                        <div class="input-group input-group-outline mb-2">
                                                            <input type="file" class="form-control" placeholder="Foto"
                                                                name="image" required>
                                                        </div>
                                                        <label class="mb-n2" for="">Password</label>
                                                        <div class="input-group input-group-outline mb-2">
                                                            <input type="password" class="form-control"
                                                                placeholder="Password" name="password_user" required>
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" name="tambah_users"
                                                                class="btn bg-gradient-primary w-100 mt-4 mb-3">
                                                                Tambah Users</button>
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
                                        Nama</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Email</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        No Whatsapp</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Role</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-10">
                                        Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = $start + 1;
                                if (mysqli_num_rows($users) > 0) {
                                    while ($item = mysqli_fetch_array($users)) {
                                ?>
                                <tr>
                                    <td>
                                        <p class="text-center text-sm font-weight-bold mb-0">
                                            <?= $i++ ?></p>
                                    </td>
                                    <td class="text-center">
                                        <img src="../assets/images/profile/<?= $item['image'] ?>" width="50px"
                                            alt="<?= $item['nama_lengkap'] ?>">
                                    </td>
                                    <td>
                                        <p class="text-center text-sm font-weight-bold mb-0">
                                            <?= $item['nama_lengkap'] ?></p>
                                    </td>
                                    <td>
                                        <p class="text-center text-sm font-weight-bold mb-0">
                                            <?= $item['email'] ?></p>
                                    </td>
                                    <td>
                                        <p class="text-center text-sm font-weight-bold mb-0">
                                            <?= $item['no_whatsapp'] ?></p>
                                    </td>
                                    <td>
                                        <p class="text-center text-sm font-weight-bold mb-0">
                                            <?= ($item['role_as'] == 1) ? 'Admin' : 'Pelanggan' ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <!-- Button trigger modal Edit-->
                                        <button type="button" class="btn bg-gradient-primary mb-0"
                                            data-bs-toggle="modal" data-bs-target="#editusers<?= $item['id'] ?>">
                                            EDIT
                                        </button>
                                        <!-- Button trigger modal Delete-->
                                        <button type="button" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal"
                                            data-bs-target="#deleteusers<?= $item['id'] ?>">
                                            HAPUS
                                        </button>
                                    </td>
                                    <!-- MODAL EDITT USERS -->
                                    <div class="modal fade" id="editusers<?= $item['id'] ?>" tabindex="-1"
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
                                                                    USERS
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <div class="card-body pb-3">
                                                            <form action="controller/code.php" method="POST"
                                                                enctype="multipart/form-data">
                                                                <div
                                                                    class="col-md-3 input-group input-group-outline mb-3">
                                                                    <input type="hidden" name="id_users"
                                                                        value="<?= $item['id'] ?>">
                                                                </div>
                                                                <label class="mb-n2" for="">Password Baru</label>
                                                                <div class="input-group input-group-outline mb-3">
                                                                    <input type="password" name="password"
                                                                        class="form-control mx-1"
                                                                        placeholder="Password Baru" required>
                                                                </div>
                                                                <div class="text-center">
                                                                    <button type="submit" name="update_users"
                                                                        class="btn bg-gradient-primary w-100 mt-4 mb-3">SIMPAN
                                                                    </button>
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
                                    <div class="modal fade" id="deleteusers<?= $item['id'] ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus
                                                        Users</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="controller/code.php" method="POST">
                                                    <div class="modal-body">
                                                        <p class="text-center text-sm font-weight-bold mb-0">Apakah Anda
                                                            yakin Ingin Menghapus <?= $item['nama_lengkap'] ?> ?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer justify-content">
                                                        <button type="button" class="btn bg-gradient-dark mb-0"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <input type="hidden" name="users_id" value="<?= $item['id'] ?>">
                                                        <button type="submit" name="hapus_users"
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