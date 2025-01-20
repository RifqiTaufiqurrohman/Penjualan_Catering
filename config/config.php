<?php
session_start();

date_default_timezone_set('Asia/Jakarta'); // Menetapkan Zona Waktu Default

$host = "localhost";
$username = "root";
$password = "";
$database = "project_skripsi";

// Koneksi Database
$conn = mysqli_connect($host, $username, $password, $database);

// Cek Koneksi Database
if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
