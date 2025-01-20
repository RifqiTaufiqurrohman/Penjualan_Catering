<?php
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
?>
<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="" target="_blank">
            <!-- <img src="" class="navbar-brand-img h-100" alt="main_logo" /> -->
            <span class="ms-1 font-weight-bold text-white">Ardina Catering</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2" />
    <div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "index.php" ? 'active bg-gradient-primary' : '' ?> "
                    href="index.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "category.php" ? 'active bg-gradient-primary' : '' ?>"
                    href="category.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">category</i>
                    </div>
                    <span class="nav-link-text ms-1">Kategori</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "produk.php" ? 'active bg-gradient-primary' : '' ?>"
                    href="produk.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Produk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "pesanan.php" ? 'active bg-gradient-primary' : '' ?>"
                    href="pesanan.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">shopping_cart</i>
                    </div>
                    <span class="nav-link-text ms-1">Pesanan Masuk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "order-history.php" ? 'active bg-gradient-primary' : '' ?>"
                    href="order-history.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">access_time</i>
                    </div>
                    <span class="nav-link-text ms-1">Riwayat Pesanan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "rekening.php" ? 'active bg-gradient-primary' : '' ?>"
                    href="rekening.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">payments</i>
                    </div>
                    <span class="nav-link-text ms-1">Rekening</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "gallery.php" ? 'active bg-gradient-primary' : '' ?>"
                    href="gallery.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">photo_library</i>
                    </div>
                    <span class="nav-link-text ms-1">Gallery</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "users.php" ? 'active bg-gradient-primary' : '' ?>"
                    href="users.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">manage_accounts</i>
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "setting.php" ? 'active bg-gradient-primary' : '' ?>"
                    href="setting.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">settings</i>
                    </div>
                    <span class="nav-link-text ms-1">Pengaturan</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
        <div class="mx-3">
            <a class="btn bg-gradient-primary mt-4 w-100" href="../logout.php">Logout</a>
        </div>
    </div>
</aside>