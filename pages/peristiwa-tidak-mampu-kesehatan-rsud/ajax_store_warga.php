<?php
include('../../config/koneksi.php');
require '../constant.php';
require '../../f_logs.php';

$tanggal_pembuatan = $_POST['tanggal_pembuatan'];
$warga_id          = $_POST['warga_id_hidden'];
$jabatan_ttd       = $_POST['jabatan_ttd'];
$nama_ttd          = $_POST['nama_ttd'];
$nomor_induk_ttd   = $_POST['nomor_induk_ttd'];
$no_register_camat = $_POST['no_register_camat'];
$nama_camat        = $_POST['nama_camat'];
$nip_camat         = $_POST['nip_camat'];

// PART NOMOR SURAT
$sql   = "SELECT `surat_sequences`.`sequence` FROM `surat_sequences` WHERE `surat_sequences`.`tanggal` = '" . date('Y-m-d') . "' ORDER BY `sequence` DESC LIMIT 1";
$query = mysqli_query($db, $sql);
$sequence = 1;
$no_urut = "001";
if (mysqli_num_rows($query) > 0) {
    $row      = mysqli_fetch_assoc($query);
    $sequence = $row['sequence'] + 1;
    if ($sequence < 10) {
        $no_urut = '00' . $sequence;
    } elseif ($sequence < 100) {
        $no_urut = '0' . $sequence;
    } elseif ($sequence < 1000) {
        $no_urut = $sequence;
    } else {
        $no_urut = $sequence;
    }
    $sql   = "UPDATE `surat_sequences` SET `sequence` = " . $sequence . " WHERE tanggal = '" . date('Y-m-d') . "'";
    $query = mysqli_query($db, $sql);
} else {
    $sql   = "INSERT INTO `surat_sequences` (tanggal, `sequence`) VALUES ('" . date('Y-m-d') . "', " . $sequence . ")";
    $query = mysqli_query($db, $sql);
}
$nomor_surat = '140-' . KODE_DESA_SURAT . '/' . $no_urut . '/' . date('m') .  '/' . date('Y');

$sql = "
INSERT INTO `tidak_mampu_kesehatan_rsud` 
(
    warga_id, 
    tanggal_pembuatan, 
    nomor_surat, 
    sequence, 
    jabatan_ttd, 
    nama_ttd, 
    nomor_induk_ttd,
    no_register_camat,
    nama_camat,
    nip_camat
)
VALUES
(
    '$warga_id', 
    '$tanggal_pembuatan', 
    '$nomor_surat', 
    $sequence, 
    '$jabatan_ttd', 
    '$nama_ttd', 
    '$nomor_induk_ttd',
    '$no_register_camat',
    '$nama_camat',
    '$nip_camat'
)
";

$query = mysqli_query($db, $sql);

$code = 500;
$msg = "Proses Simpan Data Gagal";
$id = null;
if ($query) {
    $code = 200;
    $msg  = "Proses Simpan Data Berhasil, Proses Print Dapat Dilakukan";
    $id   = mysqli_insert_id($db);

    logs($warga_id, "Keterangan Tidak Mampu Untuk Kesehatan (RSUD)", $nomor_surat, 'tidak_mampu_kesehatan_rsud', $id);
}

echo json_encode([
    'code' => $code,
    'msg'  => $msg,
    'id'   => $id,
]);
