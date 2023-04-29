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

$sql   = "SELECT * FROM `kelahiran` WHERE `kelahiran`.`id` = " . $id;
$query = mysqli_query($db, $sql);
$total = mysqli_num_rows($query);

if ($total == 0) {
    echo json_encode([
        'code' => 404,
        'msg'  => "Data Tidak Ditemukan"
    ]);
    exit;
}

$row = mysqli_fetch_assoc($query);
$warga_id = $row['warga_id'];

$sql = "DELETE FROM `kelahiran` WHERE id = " . $id . "";
$query = mysqli_query($db, $sql);

$code = 500;
$msg  = "Proses Delete Gagal";
if ($query) {
    $code = 200;
    $msg  = "Proses Delete Berhasil";
}

$sql = "DELETE FROM `warga` WHERE id_warga = " . $warga_id . "";
$query = mysqli_query($db, $sql);

$code = 500;
$msg  = "Proses Delete Gagal";
if ($query) {
    $code = 200;
    $msg  = "Proses Delete Berhasil";
}

$sql = "DELETE FROM `warga_has_kartu_keluarga` WHERE id_warga = " . $warga_id . "";
$query = mysqli_query($db, $sql);

$code = 500;
$msg  = "Proses Delete Gagal";
if ($query) {
    $code = 200;
    $msg  = "Proses Delete Berhasil";
}

// delete log
require '../../f_logs.php';
$table_name = "kelahiran";
$table_id = $id;
delete_logs($table_name, $table_id);

echo json_encode([
    'code' => 200,
    'msg'  => 'OK',
]);
