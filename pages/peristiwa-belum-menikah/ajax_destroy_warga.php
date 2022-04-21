<?php
include('../../config/koneksi.php');

$id = $_POST['id'];

if (!$id) {
    echo json_encode([
        'code' => 404,
        'msg'  => "Data Tidak Ditemukan"
    ]);
    exit;
}

$sql   = "SELECT * FROM `belum_menikah` WHERE `belum_menikah`.`id` = " . $id;
$query = mysqli_query($db, $sql);
$total = mysqli_num_rows($query);

if ($total == 0) {
    echo json_encode([
        'code' => 404,
        'msg'  => "Data Tidak Ditemukan"
    ]);
    exit;
}

$sql = "DELETE FROM `belum_menikah` WHERE id = " . $id . "";
$query = mysqli_query($db, $sql);

$code = 500;
$msg  = "Proses Delete Gagal";
if ($query) {
    $code = 200;
    $msg  = "Proses Delete Berhasil";
}

echo json_encode([
    'code' => 200,
    'msg'  => 'OK',
]);
