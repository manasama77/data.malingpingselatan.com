<?php
include('../../config/koneksi.php');
require '../constant.php';

$id_edit              = $_POST['id_edit'];
$orangtua_id          = $_POST['orangtua_id'];
$anak_id              = $_POST['anak_id'];
$penghasilan_orangtua = $_POST['penghasilan_orangtua'];
$keperluan            = $_POST['keperluan'];
$tanggal_pelaporan    = $_POST['tanggal_pelaporan'];
$nama_kepala_desa     = $_POST['nama_kepala_desa'];
$nrp                  = $_POST['nrp'];

$sql = "
UPDATE  
    `sk_penghasilan_orangtua` 
    SET
        orangtua_id          = '$orangtua_id',
        anak_id              = '$anak_id',
        penghasilan_orangtua = '$penghasilan_orangtua',
        keperluan            = '$keperluan',
        tanggal_pelaporan    = '$tanggal_pelaporan',
        nama_kepala_desa     = '$nama_kepala_desa',
        nrp                  = '$nrp'
WHERE
    id = $id_edit
";

$query = mysqli_query($db, $sql);

$code = 500;
$msg = "Proses Update Data Gagal";
$id = null;
if ($query) {
    $code = 200;
    $msg  = "Proses Update Data Berhasil, Proses Print Dapat Dilakukan";
    $id   = mysqli_insert_id($db);
}

echo json_encode([
    'code' => $code,
    'msg'  => $msg,
    'id'   => $id,
]);
