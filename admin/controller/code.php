<?php

include('../../config/config.php');
include('../../controller/myfunction.php');


// TAMBAH KATEGORI
if (isset($_POST['add_category_btn'])) {
    $name = htmlspecialchars($_POST['name']);
    $slug = htmlspecialchars($_POST['slug']);
    $description = htmlspecialchars($_POST['deskripsi']);
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $image = $_FILES['image']['name'];

    $path = "../../assets/images/category";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $file_name = time() . '.' . $image_ext;

    $cate_query = "INSERT INTO kategori (nama, slug, deskripsi, status, popular, image ) VALUES ('$name','$slug','$description','$status','$popular','$file_name')";

    $cate_query_run = mysqli_query($conn, $cate_query);
    if ($cate_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $file_name);
        redirect("../category.php", "Kategori Suskes Ditambahkan");
    } else {
        redirect("../category.php", "Ada yang salah!");
    }
}
// UPDATE KATEGORI
else if (isset($_POST['update_category_btn'])) {
    $kategori_id = $_POST['id_kategori'];
    $name = htmlspecialchars($_POST['name']);
    $slug = htmlspecialchars($_POST['slug']);
    $description = htmlspecialchars($_POST['deskripsi']);
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    $path = "../../assets/images/category";
    $update_query = "UPDATE kategori SET nama='$name', slug='$slug', deskripsi='$description', `status`='$status', popular='$popular', `image`='$update_filename' WHERE id='$kategori_id'";

    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../../assets/images/category/" . $old_image)) {
                unlink("../../assets/images/category/" . $old_image);
            }
        }
        redirect("../category.php", "Kategori Berhasil Dirubah!");
    } else {
        redirect("../category.php", "Ada Yang Salah!");
    }
}
// DELETE KATEGORI
else if (isset($_POST['hapus_kategori'])) {
    $category_id = mysqli_escape_string($conn, $_POST['category_id']);

    $category_query = "SELECT * FROM kategori WHERE id='$category_id'";
    $category_query_run = mysqli_query($conn, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM kategori WHERE id='$category_id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {

        if (file_exists("../../assets/images/category/" . $image)) {
            unlink("../../assets/images/category/" . $image);
        }

        redirect("../category.php", "Kategori Berhasil Dihapus!");
    } else {
        redirect("../category.php", "Kategori Gagal Dihapus!");
    }
}
// TAMBAH PRODUK
else if (isset($_POST['tambah_produk'])) {
    $kategori_id = htmlspecialchars($_POST['kategori_id']);
    $name = htmlspecialchars($_POST['name']);
    $slug = htmlspecialchars($_POST['slug']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $harga_asli = htmlspecialchars($_POST['harga_asli']);
    $harga_jual = htmlspecialchars($_POST['harga_jual']);
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $image = $_FILES['image']['name'];

    $path = "../../assets/images/produk";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    if ($name != "" && $slug != "" && $deskripsi != "") {

        $produk_query = "INSERT INTO produk (kategori_id, nama, slug, deskripsi, harga_asli, harga_jual, status, trending, image) VALUES ('$kategori_id', '$name', '$slug', '$deskripsi', '$harga_asli', '$harga_jual', '$status', '$trending', '$filename')";

        $produk_query_run = mysqli_query($conn, $produk_query);

        if ($produk_query_run) {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
            redirect("../produk.php", "Produk Suskes Ditambahkan");
        } else {
            redirect("../produk.php", "Ada yang salah!");
        }
    } else {
        redirect("../produk.php", "Semua Bidang Wajib Diisi!");
    }
}
// EDIT PRODUK
else if (isset($_POST['update_produk'])) {
    $produk_id = $_POST['id_produk'];
    $kategori_id = htmlspecialchars($_POST['kategori_id']);
    $name = htmlspecialchars($_POST['name']);
    $slug = htmlspecialchars($_POST['slug']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $harga_asli = htmlspecialchars($_POST['harga_asli']);
    $harga_jual = htmlspecialchars($_POST['harga_jual']);
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $path = "../../assets/images/produk";

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    $update_produk_query = "UPDATE produk SET kategori_id='$kategori_id', nama='$name', slug='$slug', deskripsi='$deskripsi', harga_asli='$harga_asli', harga_jual='$harga_jual', status='$status', trending='$trending', image='$update_filename' WHERE id='$produk_id' ";

    $update_produk_query_run = mysqli_query($conn, $update_produk_query);

    if ($update_produk_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../../assets/images/produk/" . $old_image)) {
                unlink("../../assets/images/produk/" . $old_image);
            }
        }
        redirect("../produk.php", "Produk Berhasil Dirubah!");
    } else {
        redirect("../produk.php", "Ada yang Salah!");
    }
}
// DELETE PRODUK
else if (isset($_POST['hapus_produk'])) {
    $produk_id = mysqli_escape_string($conn, $_POST['produk_id']);

    $produk_query = "SELECT * FROM produk WHERE id='$produk_id'";
    $produk_query_run = mysqli_query($conn, $produk_query);
    $produk_data = mysqli_fetch_array($produk_query_run);
    $produk_image = $produk_data['image'];

    $delete_produk_query = "DELETE FROM produk WHERE id='$produk_id'";
    $delete_produk_query_run = mysqli_query($conn, $delete_produk_query);

    if ($delete_produk_query_run) {

        if (file_exists("../../assets/images/produk/" . $produk_image)) {
            unlink("../../assets/images/produk/" . $produk_image);
        }

        redirect("../produk.php", "Produk Berhasil Dihapus!");
    } else {
        redirect("../produk.php", "Produk Gagal Dihapus!");
    }
}
// STATUS PESANAN
else if (isset($_POST['update_order_btn'])) {
    $track_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];

    $order_query = "UPDATE pesanan SET `status` = '$order_status' WHERE tracking_no = '$track_no'";
    $update_order_query = mysqli_query($conn, $order_query);

    redirect("../view-order.php?track=$track_no", "Status Pesanan Berhasil Dirubah!");
}
// STATUS PENGIRIMAN
else if (isset($_POST['input_pengiriman'])) {
    $id_pesanan = $_POST['id_pesanan'];
    $track_no = $_POST['tracking'];
    $pesan = $_POST['pesan'];

    $cate_query = "INSERT INTO pengiriman (tracking_no, id_pesanan, pesan) VALUES ('$track_no','$id_pesanan','$pesan')";
    $cate_query_run = mysqli_query($conn, $cate_query);

    redirect("../view-order.php?track=$track_no", "Berhasil Input Pengiriman !");
}
// TAMBAH REKENING
else if (isset($_POST['add_rekening'])) {
    $nama_bank = htmlspecialchars($_POST['name']);
    $no_rekening = htmlspecialchars($_POST['norek']);
    $nama_rekening = htmlspecialchars($_POST['nama_rekening']);

    $image = $_FILES['foto_bank']['name'];

    $path = "../../assets/images/rekening";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $file_name = time() . '.' . $image_ext;

    $cate_query = "INSERT INTO rekening (foto_bank, nama_bank, no_rekening, nama_rekening) VALUES ('$file_name','$nama_bank','$no_rekening','$nama_rekening')";

    $cate_query_run = mysqli_query($conn, $cate_query);
    if ($cate_query_run) {
        move_uploaded_file($_FILES['foto_bank']['tmp_name'], $path . '/' . $file_name);
        redirect("../rekening.php", "Rekening Suskes Ditambahkan");
    } else {
        redirect("../rekening.php", "Ada yang salah!");
    }
}
// UPDATE REKENING
else if (isset($_POST['update_rekening'])) {
    $rekening_id = $_POST['id_rekening'];
    $name = htmlspecialchars($_POST['name']);
    $norek = htmlspecialchars($_POST['norek']);
    $nama_rekening = htmlspecialchars($_POST['nama_rekening']);

    $new_image = $_FILES['foto_bank']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    $path = "../../assets/images/rekening";
    $update_query = "UPDATE rekening SET foto_bank='$update_filename', nama_bank='$name', no_rekening='$norek', nama_rekening='$nama_rekening' WHERE id='$rekening_id'";

    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        if ($_FILES['foto_bank']['name'] != "") {
            move_uploaded_file($_FILES['foto_bank']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../../assets/images/rekening/" . $old_image)) {
                unlink("../../assets/images/rekening/" . $old_image);
            }
        }
        redirect("../rekening.php", "Rekening Berhasil Dirubah!");
    } else {
        redirect("../rekening.php", "Ada Yang Salah!");
    }
}
// DELETE REKENING
else if (isset($_POST['hapus_rekening'])) {
    $rekening_id = mysqli_escape_string($conn, $_POST['rekening_id']);

    $rekening_query = "SELECT * FROM rekening WHERE id='$rekening_id'";
    $rekening_query_run = mysqli_query($conn, $rekening_query);
    $rekening_data = mysqli_fetch_array($rekening_query_run);
    $image = $rekening_data['foto_bank'];

    $delete_query = "DELETE FROM rekening WHERE id='$rekening_id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {

        if (file_exists("../../assets/images/rekening/" . $image)) {
            unlink("../../assets/images/rekening/" . $image);
        }

        redirect("../rekening.php", "Rekening Berhasil Dihapus!");
    } else {
        redirect("../rekening.php", " Ada Yang Salah!");
    }
}
// TAMBAH GALLERY
else if (isset($_POST['add_gallery'])) {
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    // $user_id = $_SESSION['auth']['user_id'];
    $image = $_FILES['image']['name'];

    $path = "../../assets/images/gallery";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $file_name = time() . '.' . $image_ext;

    $cate_query = "INSERT INTO gallery (image, deskripsi) VALUES ('$file_name', '$deskripsi')";

    $cate_query_run = mysqli_query($conn, $cate_query);
    if ($cate_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $file_name);
        redirect("../gallery.php", "Foto Suskes Ditambahkan");
    } else {
        redirect("../gallery.php", "Ada yang salah!");
    }
}
// UPDATE GALLERY
else if (isset($_POST['update_gallery'])) {
    $gallery_id = $_POST['id_gallery'];
    $deskripsi = htmlspecialchars($_POST['deskripsi']);

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    $path = "../../assets/images/gallery";
    $update_query = "UPDATE gallery SET `image`='$update_filename', deskripsi='$deskripsi' WHERE id='$gallery_id'";

    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../../assets/images/gallery/" . $old_image)) {
                unlink("../../assets/images/gallery/" . $old_image);
            }
        }
        redirect("../gallery.php", "Foto Berhasil Dirubah!");
    } else {
        redirect("../gallery.php", "Ada Yang Salah!");
    }
}
// DELETE GALLERY
else if (isset($_POST['hapus_gallery'])) {
    $gallery_id = mysqli_escape_string($conn, $_POST['gallery_id']);

    $gallery_query = "SELECT * FROM gallery WHERE id='$gallery_id'";
    $gallery_query_run = mysqli_query($conn, $gallery_query);
    $gallery_data = mysqli_fetch_array($gallery_query_run);
    $image = $gallery_data['image'];

    $delete_query = "DELETE FROM gallery WHERE id='$gallery_id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {

        if (file_exists("../../assets/images/gallery/" . $image)) {
            unlink("../../assets/images/gallery/" . $image);
        }

        redirect("../gallery.php", "Foto Berhasil Dihapus!");
    } else {
        redirect("../gallery.php", " Ada Yang Salah!");
    }
}
// ADD USERS
else if (isset($_POST['tambah_users'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_user']);
    $phone = mysqli_real_escape_string($conn, $_POST['telp_user']);
    $email = mysqli_real_escape_string($conn, $_POST['email_user']);
    $password = mysqli_real_escape_string($conn, $_POST['password_user']);

    $image = $_FILES['image']['name'];

    $path = "../../assets/images/profile";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $file_name = time() . '.' . $image_ext;

    // Cek Email sudah ada atau tidak
    $check_email_query = "SELECT email FROM users WHERE email='$email' ";
    $check_email_query_run = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['message'] = "Email Sudah Terdaftar";
        header('Location: ../users.php');
    } else {
        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);
        // Insert Data
        $insert_query = "INSERT INTO `users` (`nama_lengkap`, `image`, `email`, `no_whatsapp`, `password`) VALUES ('$nama', '$file_name', '$email', '$phone', '$password') ";
        $insert_query_run = mysqli_query($conn, $insert_query);
        if ($insert_query_run) {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $file_name);
            redirect("../users.php", "Berhasil Menambahkan User");
        } else {
            redirect("../users.php", "Gagal Menambahkan User");
        }
    }
}
// UPDATE USERS
else if (isset($_POST['update_users'])) {
    $users_id = mysqli_real_escape_string($conn, $_POST['id_users']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Enkripsi password baru
    $encrypted_password = encryptPassword($password);

    $update_query = "UPDATE users SET `password`='$encrypted_password' WHERE id='$users_id'";

    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        redirect("../users.php", "Password Berhasil Dirubah!");
    } else {
        redirect("../users.php", "Ada Yang Salah!");
    }
}
// DELETE USERS
else if (isset($_POST['hapus_users'])) {
    $users_id = mysqli_escape_string($conn, $_POST['users_id']);

    $users_query = "SELECT * FROM users WHERE id='$users_id'";
    $users_query_run = mysqli_query($conn, $users_query);
    $users_data = mysqli_fetch_array($users_query_run);
    $image = $users_data['image'];

    $delete_query = "DELETE FROM users WHERE id='$users_id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {

        if (file_exists("../../assets/images/profile/" . $image)) {
            unlink("../../assets/images/profile/" . $image);
        }

        redirect("../users.php", "Users Berhasil Dihapus!");
    } else {
        redirect("../users.php", " Ada Yang Salah!");
    }
}
// UPDATE PROFILE
if (isset($_POST['update_profile'])) {
    $users_id = mysqli_real_escape_string($conn, $_POST['id_users']);
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['name']));
    $email = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['email']));
    $no_wa = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['phone']));

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
} else {
    header('Location: ../produk.php');
}
