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

$sql   = "SELECT * FROM `tidak_mampu_sekolah` WHERE `tidak_mampu_sekolah`.`id` = " . $id;
$query = mysqli_query($db, $sql);
$total = mysqli_num_rows($query);

if ($total == 0) {
    echo json_encode([
        'code' => 404,
        'msg'  => "Data Tidak Ditemukan"
    ]);
    exit;
}

$sql = "DELETE FROM `tidak_mampu_sekolah` WHERE id = " . $id . "";
$query = mysqli_query($db, $sql);

// delete log
require '../../f_logs.php';
$table_name = "tidak_mampu_sekolah";
$table_id = $id;
delete_logs($table_name, $table_id);

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
