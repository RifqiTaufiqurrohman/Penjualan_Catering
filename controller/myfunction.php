<?php
include "../config/config.php";

function getAll($table)
{
    global $conn;
    $query = "SELECT * FROM $table ";
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

function getUsers($table)
{
    global $conn;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($conn, $query);
}

function getRekening($table)
{
    global $conn;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($conn, $query);
}

function redirect($url, $message)
{
    $_SESSION['message'] = "$message";
    header("Location: " . $url);
    exit(0);
}

function getAllOrders()
{
    global $conn;
    $query = "SELECT * FROM pesanan WHERE `status`='0' ORDER BY id DESC";
    return $query_run = mysqli_query($conn, $query);
}
function getOrderHistory()
{
    global $conn;
    $query = "SELECT * FROM pesanan WHERE `status` !='0' ORDER BY id DESC";
    return $query_run = mysqli_query($conn, $query);
}

function checkTrackingNoValid($trackingNo)
{
    global $conn;

    $query = "SELECT * FROM pesanan WHERE tracking_no = '$trackingNo' ";
    return mysqli_query($conn, $query);
}
function getAdmin($table)
{
    global $conn;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM $table WHERE id = '$userId'";
    return $query_run = mysqli_query($conn, $query);
}

function FormatTanggal($tanggal)
{
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    $date = new DateTime($tanggal);
    $day = $date->format('d');
    $month = $bulan[(int) $date->format('m')];
    $year = $date->format('Y');

    return "$day $month $year";
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
