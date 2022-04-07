<?php
include('../../config/koneksi.php');
require '../constant.php';

$id_edit           = $_POST['id_edit'];
$tanggal_pembuatan = $_POST['tanggal_pembuatan'];
$warga_id          = $_POST['warga_id_hidden'];
$alamat_usaha      = $_POST['alamat_usaha'];
$bidang_usaha      = $_POST['bidang_usaha'];
$jenis_usaha       = $_POST['jenis_usaha'];
$lama_usaha        = $_POST['lama_usaha'];
$nama_ttd          = $_POST['nama_ttd'];
$jabatan_ttd       = $_POST['jabatan_ttd'];
$nomor_induk_ttd   = $_POST['nomor_induk_ttd'];

$sql = "
UPDATE  
    `keterangan_usaha` 
    SET
        warga_id          = '$warga_id',
        tanggal_pembuatan = '$tanggal_pembuatan',
        alamat_usaha      = '$alamat_usaha',
        bidang_usaha      = '$bidang_usaha',
        jenis_usaha       = '$jenis_usaha',
        lama_usaha        = '$lama_usaha',
        nama_ttd          = '$nama_ttd',
        jabatan_ttd       = '$jabatan_ttd',
        nomor_induk_ttd   = '$nomor_induk_ttd'
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
