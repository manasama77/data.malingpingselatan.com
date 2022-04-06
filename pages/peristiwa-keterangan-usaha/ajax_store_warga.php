<?php
include('../../config/koneksi.php');
require '../constant.php';

$warga_id          = $_POST['warga_id_hidden'];
$alamat_usaha      = $_POST['alamat_usaha'];
$bidang_usaha      = $_POST['bidang_usaha'];
$jenis_usaha       = $_POST['jenis_usaha'];
$lama_usaha        = $_POST['lama_usaha'];
$tanggal_pembuatan = date('Y-m-d');

$sql   = "SELECT `keterangan_usaha`.`sequence` FROM `keterangan_usaha` ORDER BY sequence DESC";
$query = mysqli_query($db, $sql);

$sequence = 1;
$no_urut = "001";
if (mysqli_num_rows($query) > 0) {
    $row      = mysqli_fetch_assoc($query);
    $sequence = $row['sequence'] + 1;
    if ($sequence == 100) {
        $no_urut = 100;
    } elseif ($sequence >= 10 && $sequence < 100) {
        $no_urut = '0' . $sequence;
    } elseif ($sequence < 10) {
        $no_urut = '00' . $sequence;
    }
}

$nomor_surat = '140/' . $no_urut . '- ' . KODE_DESA_SURAT . '/' . date('Y');

$sql = "
INSERT INTO `keterangan_usaha` 
(warga_id, tanggal_pembuatan, nomor_surat, sequence, alamat_usaha, bidang_usaha, jenis_usaha, lama_usaha)
VALUES
($warga_id, '$tanggal_pembuatan', '$nomor_surat', $sequence, '$alamat_usaha', '$bidang_usaha', '$jenis_usaha', '$lama_usaha')
";
$query = mysqli_query($db, $sql);

$code = 500;
$msg = "Proses Simpan Data Gagal";
$id = null;
if ($query) {
    $code = 200;
    $msg  = "Proses Simpan Data Berhasil, Proses Print Dapat Dilakukan";
    $id   = mysqli_insert_id($db);
}

echo json_encode([
    'code' => $code,
    'msg'  => $msg,
    'id'   => $id,
]);
