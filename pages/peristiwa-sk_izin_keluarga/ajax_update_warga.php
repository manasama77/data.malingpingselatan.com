<?php
include('../../config/koneksi.php');
require '../constant.php';

$id_edit           = $_POST['id_edit'];
$warga_id          = $_POST['warga_id'];
$jenis_relasi      = $_POST['jenis_relasi'];
$keluarga_id       = $_POST['keluarga_id'];
$keperluan         = $_POST['keperluan'];
$tanggal_pelaporan = $_POST['tanggal_pelaporan'];
$nama_kepala_desa  = $_POST['nama_kepala_desa'];
$nrp               = $_POST['nrp'];

$sql = "
UPDATE  
    `sk_izin_keluarga` 
    SET
        warga_id          = '$warga_id',
        jenis_relasi      = '$jenis_relasi',
        keluarga_id       = '$keluarga_id',
        keperluan         = '$keperluan',
        tanggal_pelaporan = '$tanggal_pelaporan',
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
