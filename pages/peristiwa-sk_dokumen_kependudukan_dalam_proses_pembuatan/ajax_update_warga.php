<?php
include('../../config/koneksi.php');
require '../constant.php';

$id_edit           = $_POST['id_edit'];
$warga_id          = $_POST['warga_id'];
$tanggal_pembuatan = $_POST['tanggal_pembuatan'];
$jenis_pembuatan   = $_POST['jenis_pembuatan'];
$nama_kepala_desa  = $_POST['nama_kepala_desa'];
$nrp               = $_POST['nrp'];

$sql = "
UPDATE  
    `sk_dokumen_kependudukan_dalam_proses_pembuatan` 
    SET
        warga_id          = '$warga_id',
        tanggal_pembuatan = '$tanggal_pembuatan',
        jenis_pembuatan   = '$jenis_pembuatan',
        nama_kepala_desa  = '$nama_kepala_desa',
        nrp               = '$nrp'
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
