<?php
include('../../config/koneksi.php');
require '../constant.php';

$warga_id              = $_POST['warga_id'];
$keterangan_kehilangan = $_POST['keterangan_kehilangan'];
$tanggal_pelaporan     = $_POST['tanggal_pelaporan'];
$nama_kepala_desa      = $_POST['nama_kepala_desa'];
$nrp                   = $_POST['nrp'];


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
INSERT INTO `sk_hilang` 
(
    warga_id,
    keterangan_kehilangan,
    tanggal_pelaporan,
    nomor_surat,
    nama_kepala_desa,
    nrp
)
VALUES
(
    '$warga_id',
    '$keterangan_kehilangan',
    '$tanggal_pelaporan',
    '$nomor_surat',
    '$nama_kepala_desa',
    '$nrp'
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
}

echo json_encode([
    'code' => $code,
    'msg'  => $msg,
    'id'   => $id,
]);
