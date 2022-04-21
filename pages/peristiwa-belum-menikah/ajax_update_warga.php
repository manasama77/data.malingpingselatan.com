<?php
include('../../config/koneksi.php');
require '../constant.php';

$id_edit           = $_POST['id_edit'];
$tanggal_pembuatan = $_POST['tanggal_pembuatan'];
$warga_id          = $_POST['warga_id_hidden'];
$nama_ttd          = $_POST['nama_ttd'];
$jabatan_ttd       = $_POST['jabatan_ttd'];
$nomor_induk_ttd   = $_POST['nomor_induk_ttd'];
$saksi_1           = $_POST['saksi_1'];
$saksi_2           = $_POST['saksi_2'];
$saksi_3           = $_POST['saksi_3'];

$sql = "
UPDATE  
    `belum_menikah` 
    SET
        warga_id          = '$warga_id',
        tanggal_pembuatan = '$tanggal_pembuatan',
        nama_ttd          = '$nama_ttd',
        jabatan_ttd       = '$jabatan_ttd',
        nomor_induk_ttd   = '$nomor_induk_ttd',
        saksi_1           = '$saksi_1',
        saksi_2           = '$saksi_2',
        saksi_3           = '$saksi_3'
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
