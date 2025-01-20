<?php

include('../config/config.php');
include('myfunction.php');

if (isset($_POST['register'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    $image = $_FILES['image']['name'];

    $path = "../assets/images/profile";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $file_name = time() . '.' . $image_ext;

    // Cek Email sudah ada atau tidak
    $check_email_query = "SELECT email FROM users WHERE email='$email' ";
    $check_email_query_run = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['message'] = "Email Sudah Terdaftar";
        header('Location: ../register.php');
    } else {
        if ($password == $cpassword) {
            // enkripsi password
            $encrypted_password = encryptPassword($password);
            // Insert Data
            $insert_query = "INSERT INTO `users` (`nama_lengkap`, `image`, `email`, `no_whatsapp`, `password`) VALUES ('$nama', '$file_name', '$email', '$phone', '$encrypted_password') ";
            $insert_query_run = mysqli_query($conn, $insert_query);
            if ($insert_query_run) {
                move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $file_name);
                redirect("../login.php", "Register Berhasil");
            } else {
                redirect("../register.php", "Register Gagal");
            }
        } else {
            redirect("../register.php", "Password Tidak Cocok");
        }
    }
}
// LOGIN BUTTON
else if (isset($_POST['loginbtn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $login_query = "SELECT * FROM users WHERE email='$email'";
    $login_query_run = mysqli_query($conn, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {
        $userdata = mysqli_fetch_array($login_query_run);
        $stored_encrypted_password = $userdata['password'];

        // Dekripsi password yang tersimpan
        $stored_password = decryptPassword($stored_encrypted_password);

        if ($password == $stored_password) {
            $_SESSION['auth'] = true;
            $userid = $userdata['id'];
            $username = $userdata['nama_lengkap'];
            $useremail = $userdata['email'];
            $role_as = $userdata['role_as'];

            $_SESSION['auth_user'] = [
                'user_id' => $userid,
                'nama_lengkap' => $username,
                'email' => $useremail
            ];

            $_SESSION['role_as'] = $role_as;

            if ($role_as == 1) {
                redirect("../admin/index.php", "Welcome Admin");
            } else {
                redirect("../index.php", "Login Berhasil");
            }
        } else {
            redirect("../login.php", "Password Salah");
        }
    } else {
        redirect("../login.php", "Akun Tidak Ditemukan");
    }
}
