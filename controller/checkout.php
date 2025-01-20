<?php

include '../config/config.php';

if (isset($_SESSION['auth'])) {
    if (isset($_POST['checkout'])) {
        $nama = mysqli_real_escape_string($conn, $_POST['name']);
        $no_wa = mysqli_real_escape_string($conn, $_POST['no_wa']);
        $payment_mode = mysqli_real_escape_string($conn, $_POST['payment_mode']);
        $mtd_pengiriman = mysqli_real_escape_string($conn, $_POST['mtd_pengiriman']);
        $tgl_diantar = mysqli_real_escape_string($conn, $_POST['tgl_diantar']);
        $jam = mysqli_real_escape_string($conn, $_POST['jam']);
        $patokan_alamat = mysqli_real_escape_string($conn, $_POST['patokan_alamat']);
        $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
        $catatan_pesanan = mysqli_real_escape_string($conn, $_POST['catatan_pesanan']);
        $rekening_id = mysqli_real_escape_string($conn, $_POST['rekening_id']);
        $nama_bank = mysqli_real_escape_string($conn, $_POST['nama_bank']);

        if ($nama == "" || $no_wa == "" || $payment_mode == "" || $mtd_pengiriman == "" || $tgl_diantar == "" || $jam == "" || $patokan_alamat == "" || $alamat == "" || $catatan_pesanan == "" || $rekening_id == "" || $nama_bank == "") {
            $_SESSION['message'] = "Isi Semua Form";
            header("Location: ../checkout.php");
            exit(0);
        }

        $userId = $_SESSION['auth_user']['user_id'];
        $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.nama, p.image, p.harga_jual FROM keranjang c, produk p 
                    WHERE c.prod_id = p.id AND c.user_id='$userId' ORDER BY c.id DESC";
        $query_run = mysqli_query($conn, $query);

        $totalHarga = 0;
        foreach ($query_run as $citem) {
            $totalHarga += $citem['harga_jual'] * $citem['prod_qty'];
        }

        $tracking_no = "AC" . rand(1111, 9999) . substr($no_wa, 2);

        $image = $_FILES['image']['name'];

        $path = "../assets/images/transaksi";

        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . '.' . $image_ext;

        $insert_query = "INSERT INTO pesanan (tracking_no, user_id, nama, phone, payment_mode, mtd_pengiriman , tgl_diantar, jam, patokan_alamat, alamat, catatan_pesanan, total_price, rekening_id, nama_bank, bukti_transfer) VALUES ('$tracking_no', '$userId', '$nama', '$no_wa', '$payment_mode', '$mtd_pengiriman', '$tgl_diantar', '$jam', '$patokan_alamat', '$alamat', '$catatan_pesanan', '$totalHarga', '$rekening_id', '$nama_bank', '$filename')";
        $insert_query_run = mysqli_query($conn, $insert_query);

        if ($insert_query_run) {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
            $order_id = mysqli_insert_id($conn);
            foreach ($query_run as $citem) {
                $prod_id = $citem['prod_id'];
                $prod_qty = $citem['prod_qty'];
                $price = $citem['harga_jual'];

                $insert_items_query = "INSERT INTO barang_pesanan (id_pesanan, prod_id, qty, harga) VALUES ('$order_id','$prod_id','$prod_qty','$price')";
                $insert_items_query_run = mysqli_query($conn, $insert_items_query);
            }

            $hapus_keranjang = "DELETE FROM keranjang WHERE user_id = '$userId'";
            $hapus_keranjang_run = mysqli_query($conn, $hapus_keranjang);

            $_SESSION['message'] = "Order Sukses";
            header('Location: ../my-order.php');
            die();
        }
    }
} else {
    header('Location: ../index.php');
}
