<?php

if (!isset($_SESSION['auth'])) {
    redirect("login.php", "Login Untuk Melanjutkan");
}
