<?php

include 'config/config.php';

function getAllActive($table)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE `status`='0'";
    return $query_run = mysqli_query($conn, $query);
}

function getAllTrending()
{
    global $conn;
    $query = "SELECT * FROM produk WHERE trending='1'";
    return $query_run = mysqli_query($conn, $query);
}

function getRekening($table)
{
    global $conn;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($conn, $query);
}

function getGallery($table)
{
    global $conn;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($conn, $query);
}

function getPengiriman($tracking_no)
{
    global $conn;
    $query = "SELECT * FROM pengiriman WHERE tracking_no='$tracking_no'";
    return $query_run = mysqli_query($conn, $query);
}

function getPelanggan()
{
    global $conn;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM users WHERE id = '$userId'";
    return $query_run = mysqli_query($conn, $query);
}

function getSlugActive($table, $slug)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE `slug`='$slug' AND `status`='0' LIMIT 1";
    return $query_run = mysqli_query($conn, $query);
}

function getMenuByKategori($category_id)
{
    global $conn;
    $query = "SELECT * FROM produk WHERE `kategori_id`='$category_id' AND `status`='0'";
    return $query_run = mysqli_query($conn, $query);
}

function getIDActive($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE `id`='$id' AND `status`='0'";
    return $query_run = mysqli_query($conn, $query);
}

function getCartItems()
{
    global $conn;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.nama, p.image, p.harga_jual FROM keranjang c, produk p 
                WHERE c.prod_id = p.id AND c.user_id='$userId' ORDER BY c.id DESC";
    return $query_run = mysqli_query($conn, $query);
}

function getOrders()
{
    global $conn;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM pesanan WHERE user_id = '$userId' ORDER BY id DESC";
    return $query_run = mysqli_query($conn, $query);
}

function redirect($url, $message)
{
    $_SESSION['message'] = "$message";
    header("Location: " . $url);
    exit(0);
}

function checkTrackingNoValid($trackingNo)
{
    global $conn;
    $userId = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM pesanan WHERE tracking_no = '$trackingNo' AND user_id = '$userId'";
    return mysqli_query($conn, $query);
}

function encryptPassword($password)
{
    $cipher = "aes-256-cbc";
    $key = "ardina2019"; // Ganti dengan kunci rahasia Anda
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));
    $encrypted = openssl_encrypt($password, $cipher, $key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}

function decryptPassword($encrypted_password)
{
    $cipher = "aes-256-cbc";
    $key = "ardina2019"; // Ganti dengan kunci rahasia Anda
    list($encrypted_data, $iv) = explode('::', base64_decode($encrypted_password), 2);
    return openssl_decrypt($encrypted_data, $cipher, $key, 0, $iv);
}
