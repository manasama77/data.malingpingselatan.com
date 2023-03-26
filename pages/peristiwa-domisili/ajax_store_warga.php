<?php
include('../../config/koneksi.php');
require '../constant.php';
require '../../f_logs.php';

$tanggal_pembuatan = $_POST['tanggal_pembuatan'];
$nik               = $_POST['nik'];
$nama              = $_POST['nama'];
$tempat_lahir      = $_POST['tempat_lahir'];
$tanggal_lahir     = $_POST['tanggal_lahir'];
$jenis_kelamin     = $_POST['jenis_kelamin'];
$agama             = $_POST['agama'];
$status_perkawinan = $_POST['status_perkawinan'];
$pekerjaan         = $_POST['pekerjaan'];
$lama_domisili     = $_POST['lama_domisili'];
$alamat_domisili   = trim($_POST['alamat_domisili']);
$alamat_ktp        = trim($_POST['alamat_ktp']);
$nama_ttd          = $_POST['nama_ttd'];
$jabatan_ttd       = $_POST['jabatan_ttd'];
$nomor_induk_ttd   = $_POST['nomor_induk_ttd'];

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
INSERT INTO `domisili` 
(nomor_surat, sequence, tanggal_pembuatan, nik, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, status_perkawinan, pekerjaan, lama_domisili, alamat_domisili, alamat_ktp, nama_ttd, jabatan_ttd, nomor_induk_ttd)
VALUES
('$nomor_surat', '$sequence', '$tanggal_pembuatan', '$nik', '$nama', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$agama', '$status_perkawinan', '$pekerjaan', '$lama_domisili', '$alamat_domisili', '$alamat_ktp', '$nama_ttd', '$jabatan_ttd', '$nomor_induk_ttd')
";
$query = mysqli_query($db, $sql);

$code = 500;
$msg = "Proses Simpan Data Gagal";
$id = null;
if ($query) {
    $code = 200;
    $msg  = "Proses Simpan Data Berhasil, Proses Print Dapat Dilakukan";
    $id   = mysqli_insert_id($db);

    logs($warga_id, "Domisili", $nomor_surat, 'domisili', $id);
}

echo json_encode([
    'code' => $code,
    'msg'  => $msg,
    'id'   => $id,
    'sql'   => $sql,
]);
