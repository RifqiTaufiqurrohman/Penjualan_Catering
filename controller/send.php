<?php

if (isset($_POST['kirim_pesan'])) {
    $nama = $_POST['name'];
    $pesan = $_POST['pesan'];
    $no_wa = $_POST['noWa'];

    header("location:https://api.whatsapp.com/send?phone=$no_wa&text=Hallo%20Ardina%20Catering%20%0DSaya%20$nama%20%0D$pesan");
} else {
    echo "
    <script>
    window.location=history.go(-1);
    </script>
    ";
}
