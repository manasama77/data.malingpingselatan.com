<?php
include('../../config/koneksi.php');
require '../constant.php';

$id_edit           = $_POST['id_edit'];
$tanggal_pembuatan = $_POST['tanggal_pembuatan'];
$warga_id          = $_POST['warga_id_hidden'];
$lama_domisili     = $_POST['lama_domisili'];
$alamat_domisili   = trim($_POST['alamat_domisili']);
$nama_ttd          = $_POST['nama_ttd'];
$jabatan_ttd       = $_POST['jabatan_ttd'];
$nomor_induk_ttd   = $_POST['nomor_induk_ttd'];

$tgl_obj = new DateTime('now');
$tgl_obj->modify('+' . $lama_domisili . ' year');
$sampai = $tgl_obj->format('Y-m-d');

$sql = "
UPDATE  
    `domisili` 
    SET
        warga_id        = '$warga_id',
        nama_ttd        = '$nama_ttd',
        lama_domisili   = '$lama_domisili',
        alamat_domisili = '$alamat_domisili',
        sampai          = '$sampai',
        jabatan_ttd     = '$jabatan_ttd',
        nomor_induk_ttd = '$nomor_induk_ttd'
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
