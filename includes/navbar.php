<!-- Navbar -->
<nav class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 shadow position-fixed my-3 py-2 start-0 end-0 mx-4 ">
    <div class="container-fluid ps-2 pe-0">
        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-lg font-weight-bolder" href="index.php">
            Ardina Catering
        </a>
        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="index.php">
                        <i class="text-dark me-1"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="category.php">
                        <i class="text-dark me-1"></i>
                        Collections
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="gallery.php">
                        <i class="text-dark me-1"></i>
                        Gallery
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="about.php">
                        <i class="text-dark me-1"></i>
                        About
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="contact.php">
                        <i class="text-dark me-1"></i>
                        Contact
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav d-lg-flex ">
                <?php
                if (isset($_SESSION['auth'])) {
                ?>
                    <!-- <li class="nav-item px-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0">
                            <i class="fa fa-bell fixed-plugin-button-nav cursor-pointer"></i>
                        </a>
                    </li> -->
                    <li class="nav-item px-2 d-flex align-items-center">
                        <a href="keranjang.php" class="nav-link text-body p-0">
                            <i class="fa fa-shopping-cart fixed-plugin-button-nav cursor-pointer"></i>
                            <div id="notification-badge">
                                <?php
                                $items = getCartItems();
                                $totalKeranjang = 0;
                                foreach ($items as $citem) {
                                    $totalKeranjang++;
                                ?>
                                    <span class="notification-badge"><?= $totalKeranjang; ?></span>
                                <?php
                                }
                                ?>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown px-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user cursor-pointer"></i>
                            <?= $_SESSION['auth_user']['nama_lengkap']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="profile.php">
                                    <div class=" py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">Profile</h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="setting.php">
                                    <div class=" py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">Setting</h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="logout.php">
                                    <div class=" py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">Logout</h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item d-flex align-items-center">
                        <a class="btn btn-outline-primary btn-sm mb-0 me-2" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="register.php" class="btn btn-sm mt-2 mb-2 me-1 btn-primary">Register</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->