<?php

include('../config/config.php');
include('myfunction.php');

if (isset($_POST['update_profile'])) {
    $users_id = $_POST['id_users'];
    $nama = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $no_wa = htmlspecialchars($_POST['phone']);

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    $path = "../assets/images/profile";

    // Enkripsi password baru
    $encrypted_password = encryptPassword($_POST['password']);

    //Update Query
    $update_query = "UPDATE users SET `image`='$update_filename', nama_lengkap='$nama', email='$email', no_whatsapp='$no_wa', `password`='$encrypted_password' WHERE id='$users_id'";

    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../assets/images/profile/" . $old_image)) {
                unlink("../assets/images/profile/" . $old_image);
            }
        }
        redirect("../setting.php", "Berhasil Dirubah!");
    } else {
        redirect("../setting.php", "Ada Yang Salah!");
    }
}
