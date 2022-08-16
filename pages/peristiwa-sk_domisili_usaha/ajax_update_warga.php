<?php
include('../../config/koneksi.php');
require '../constant.php';

$id_edit           = $_POST['id_edit'];
$warga_id          = $_POST['warga_id'];
$nama_usaha        = $_POST['nama_usaha'];
$bidang_usaha      = $_POST['bidang_usaha'];
$alamat_usaha      = $_POST['alamat_usaha'];
$status_bangunan   = $_POST['status_bangunan'];
$akta_pendirian    = $_POST['akta_pendirian'];
$tahun_pendirian   = $_POST['tahun_pendirian'];
$pimpinan          = $_POST['pimpinan'];
$jumlah_karyawan   = $_POST['jumlah_karyawan'];
$modal             = $_POST['modal'];
$masa_berlaku       = $_POST['masa_berlaku'];
$tanggal_pembuatan = $_POST['tanggal_pembuatan'];
$nama_kepala_desa  = $_POST['nama_kepala_desa'];
$nama_camat        = $_POST['nama_camat'];
$nip_camat         = $_POST['nip_camat'];

$sql = "
UPDATE  
    `sk_domisili_usaha` 
    SET
        warga_id          = '$warga_id',
        nama_usaha        = '$nama_usaha',
        bidang_usaha      = '$bidang_usaha',
        alamat_usaha      = '$alamat_usaha',
        status_bangunan   = '$status_bangunan',
        akta_pendirian    = '$akta_pendirian',
        tahun_pendirian   = '$tahun_pendirian',
        pimpinan          = '$pimpinan',
        jumlah_karyawan   = '$jumlah_karyawan',
        modal             = '$modal',
        masa_berlaku      = '$masa_berlaku',
        tanggal_pembuatan = '$tanggal_pembuatan',
        nama_kepala_desa  = '$nama_kepala_desa',
        nama_camat        = '$nama_camat',
        nip_camat         = '$nip_camat'
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
