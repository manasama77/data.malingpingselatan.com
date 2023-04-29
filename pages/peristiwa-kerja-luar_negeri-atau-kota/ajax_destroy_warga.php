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

$sql   = "SELECT * FROM `bekerja_luar_negeri_kota` WHERE `bekerja_luar_negeri_kota`.`id` = " . $id;
$query = mysqli_query($db, $sql);
$total = mysqli_num_rows($query);

if ($total == 0) {
    echo json_encode([
        'code' => 404,
        'msg'  => "Data Tidak Ditemukan"
    ]);
    exit;
}

$sql = "DELETE FROM `bekerja_luar_negeri_kota` WHERE id = " . $id . "";
$query = mysqli_query($db, $sql);

$code = 500;
$msg  = "Proses Delete Gagal";
if ($query) {
    $code = 200;
    $msg  = "Proses Delete Berhasil";
}

// delete log
require '../../f_logs.php';
$table_name = "bekerja_luar_negeri_kota";
$table_id = $id;
delete_logs($table_name, $table_id);

echo json_encode([
    'code' => 200,
    'msg'  => 'OK',
]);
