<?php

include '../config/config.php';

if (isset($_POST['update_order_btn'])) {
    $komentar = mysqli_real_escape_string($conn, $_POST['komentar']);
    $track_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];

    $order_query = "UPDATE pesanan SET `status` = '$order_status', comments = '$komentar' WHERE tracking_no = '$track_no'";
    $update_order_query = mysqli_query($conn, $order_query);

    if ($update_order_query) {
        // Redirect to view-order.php with the updated tracking number
        header("Location: ../view-order.php?track=$track_no");
        exit(); // Ensure that no code is executed after the redirect
    } else {
        // Handle errors if the query fails
        die('Error: ' . mysqli_error($conn));
    }

    // redirect("../view-order.php?track=$track_no", "Pesanan Selesai!");
}
