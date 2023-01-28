<?php
include('../../config/koneksi.php');
require '../constant.php';

$id_edit              = $_POST['id_edit'];
$warga_1_id        = $_POST['warga_1_id'];
$warga_2_id        = $_POST['warga_2_id'];
$tanggal_kuasa     = $_POST['tanggal_kuasa'];
$keperluan         = $_POST['keperluan'];
$tanggal_pelaporan = $_POST['tanggal_pelaporan'];
$saksi_1           = $_POST['saksi_1'];
$saksi_2           = $_POST['saksi_2'];
$saksi_3           = $_POST['saksi_3'];
$nama_kepala_desa  = $_POST['nama_kepala_desa'];

$sql = "
UPDATE  
    `surat_kuasa` 
    SET
        warga_1_id        = '$warga_1_id',
        warga_2_id        = '$warga_2_id',
        tanggal_kuasa     = '$tanggal_kuasa',
        keperluan         = '$keperluan',
        tanggal_pelaporan = '$tanggal_pelaporan',
        saksi_1           = '$saksi_1',
        saksi_2           = '$saksi_2',
        saksi_3           = '$saksi_3',
        nama_kepala_desa  = '$nama_kepala_desa'
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
