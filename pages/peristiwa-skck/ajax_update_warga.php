<?php
include('../../config/koneksi.php');
require '../constant.php';

$id_edit              = $_POST['id_edit'];
$warga_id             = $_POST['warga_id'];
$tanggal_pembuatan    = $_POST['tanggal_pembuatan'];
$nama_kepala_desa     = $_POST['nama_kepala_desa'];
$reg_no_camat         = $_POST['reg_no_camat'];
$tanggal_ttd_camat    = $_POST['tanggal_ttd_camat'];
$nama_camat           = $_POST['nama_camat'];
$nip_camat            = $_POST['nip_camat'];
$reg_no_danramil      = $_POST['reg_no_danramil'];
$tanggal_ttd_danramil = $_POST['tanggal_ttd_danramil'];
$nama_danramil        = $_POST['nama_danramil'];
$nrp_danramil         = $_POST['nrp_danramil'];
$reg_no_kapolsek      = $_POST['reg_no_kapolsek'];
$tanggal_ttd_kapolsek = $_POST['tanggal_ttd_kapolsek'];
$nama_kapolsek        = $_POST['nama_kapolsek'];
$nrp_kapolsek         = $_POST['nrp_kapolsek'];

$sql = "
UPDATE  
    `skck` 
    SET
        warga_id             = '$warga_id',
        nama_kepala_desa     = '$nama_kepala_desa',
        reg_no_camat         = '$reg_no_camat',
        tanggal_ttd_camat    = '$tanggal_ttd_camat',
        nama_camat           = '$nama_camat',
        nip_camat            = '$nip_camat',
        reg_no_danramil      = '$reg_no_danramil',
        tanggal_ttd_danramil = '$tanggal_ttd_danramil',
        nama_danramil        = '$nama_danramil',
        nrp_danramil         = '$nrp_danramil',
        reg_no_kapolsek      = '$reg_no_kapolsek',
        tanggal_ttd_kapolsek = '$tanggal_ttd_kapolsek',
        nama_kapolsek        = '$nama_kapolsek',
        nrp_kapolsek         = '$nrp_kapolsek'
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
