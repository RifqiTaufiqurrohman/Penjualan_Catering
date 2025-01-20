<?php

if (isset($_POST['kirim_pesan'])) {
    $pelanggan = $_POST['pelanggan'];
    $nama = $_POST['name'];
    $pesan = $_POST['pesan'];
    $no_wa = $_POST['noWa'];

    header("location:https://api.whatsapp.com/send?phone=$no_wa&text=Hallo%20$pelanggan%20kami%20dari%20$nama%20%0D$pesan");
} else {
    echo "
    <script>
    window.location=history.go(-1);
    </script>
    ";
}
