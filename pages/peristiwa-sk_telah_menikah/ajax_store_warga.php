<?php
include('../../config/koneksi.php');
require '../constant.php';
require '../../f_logs.php';

$pelapor_id          = $_POST['pelapor_id'];
$pasangan_id         = $_POST['pasangan_id'];
$tanggal_menikah     = $_POST['tanggal_menikah'];
$tempat_menikah      = $_POST['tempat_menikah'];
$nama_wali_nikah     = $_POST['nama_wali_nikah'];
$nama_penghulu_nikah = $_POST['nama_penghulu_nikah'];
$tanggal_pelaporan   = $_POST['tanggal_pelaporan'];
$nama_kepala_desa    = $_POST['nama_kepala_desa'];
$nrp                 = $_POST['nrp'];
$saksi_1             = $_POST['saksi_1'];
$saksi_2             = $_POST['saksi_2'];
$saksi_3             = $_POST['saksi_3'];


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
INSERT INTO `sk_telah_menikah` 
(
    pelapor_id,
    pasangan_id,
    tanggal_menikah,
    tempat_menikah,
    nama_wali_nikah,
    nama_penghulu_nikah,
    tanggal_pelaporan,
    nama_kepala_desa,
    nrp,
    saksi_1,
    saksi_2,
    saksi_3,
    nomor_surat
)
VALUES
(
    '$pelapor_id',
    '$pasangan_id',
    '$tanggal_menikah',
    '$tempat_menikah',
    '$nama_wali_nikah',
    '$nama_penghulu_nikah',
    '$tanggal_pelaporan',
    '$nama_kepala_desa',
    '$nrp',
    '$saksi_1',
    '$saksi_2',
    '$saksi_3',
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

    logs($warga_id, "Surat Keterangan Telah Menikah", $nomor_surat, 'sk_telah_menikah', $id);
}

echo json_encode([
    'code' => $code,
    'msg'  => $msg,
    'id'   => $id,
]);
