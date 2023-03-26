<?php
include('../../config/koneksi.php');
require '../constant.php';
require '../../f_logs.php';

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
INSERT INTO `sk_domisili_usaha` 
(
    warga_id,
    nama_usaha,
    bidang_usaha,
    alamat_usaha,
    status_bangunan,
    akta_pendirian,
    tahun_pendirian,
    pimpinan,
    jumlah_karyawan,
    modal,
    masa_berlaku,
    tanggal_pembuatan,
    nama_kepala_desa,
    nama_camat,
    nip_camat,
    nomor_surat
)
VALUES
(
    '$warga_id',
    '$nama_usaha',
    '$bidang_usaha',
    '$alamat_usaha',
    '$status_bangunan',
    '$akta_pendirian',
    '$tahun_pendirian',
    '$pimpinan',
    '$jumlah_karyawan',
    '$modal',
    '$masa_berlaku',
    '$tanggal_pembuatan',
    '$nama_kepala_desa',
    '$nama_camat',
    '$nip_camat',
    '$nomor_surat'
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

    logs($warga_id, "Surat Keterangan Domisili Usaha", $nomor_surat, 'sk_domisili_usaha', $id);
}

echo json_encode([
    'code' => $code,
    'msg'  => $msg,
    'id'   => $id,
]);
