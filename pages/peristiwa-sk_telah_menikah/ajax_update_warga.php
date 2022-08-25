<?php
include('../../config/koneksi.php');
require '../constant.php';

$id_edit             = $_POST['id_edit'];
$pelapor_id          = $_POST['pelapor_id'];
$pasangan_id         = $_POST['pasangan_id'];
$tanggal_menikah     = $_POST['tanggal_menikah'];
$tempat_menikah      = $_POST['tempat_menikah'];
$nama_wali_nikah     = $_POST['nama_wali_nikah'];
$nama_penghulu_nikah = $_POST['nama_penghulu_nikah'];
$tanggal_pelaporan   = $_POST['tanggal_pelaporan'];
$nama_kepala_desa    = $_POST['nama_kepala_desa'];
$nrp                 = $_POST['nrp'];
$saksi_1             = $_POST['saksi_1'];
$saksi_2             = $_POST['saksi_2'];
$saksi_3             = $_POST['saksi_3'];

$sql = "
UPDATE  
    `sk_telah_menikah` 
    SET
        pelapor_id          = '$pelapor_id',
        pasangan_id         = '$pasangan_id',
        tanggal_menikah     = '$tanggal_menikah',
        tempat_menikah      = '$tempat_menikah',
        nama_wali_nikah     = '$nama_wali_nikah',
        nama_penghulu_nikah = '$nama_penghulu_nikah',
        tanggal_pelaporan   = '$tanggal_pelaporan',
        nama_kepala_desa    = '$nama_kepala_desa',
        nrp                 = '$nrp',
        saksi_1             = '$saksi_1',
        saksi_2             = '$saksi_2',
        saksi_3             = '$saksi_3'
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
