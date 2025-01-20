<?php

include '../config/config.php';

$id = $_POST['id'];

$query = mysqli_query($conn, "SELECT * FROM rekening WHERE id ='$id'");
$data = mysqli_fetch_array($query);
echo json_encode($data);
