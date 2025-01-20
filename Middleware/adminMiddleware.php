<?php
include '../controller/myfunction.php';

if (isset($_SESSION['auth'])) {
    if ($_SESSION['role_as'] != 1) {
        redirect("../index.php", "Anda tidak berwenang mengakses halaman ini");
    }
} else {
    redirect("../login.php", "Login untuk melanjutkan");
}
