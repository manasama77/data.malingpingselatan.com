<?php
include('../../config/koneksi.php');
require '../constant.php';
require '../../f_logs.php';

$tanggal_pembuatan = $_POST['tanggal_pembuatan'];
$warga_id          = $_POST['warga_id_hidden'];
$nama_ttd          = $_POST['nama_ttd'];
$jabatan_ttd       = $_POST['jabatan_ttd'];
$nomor_induk_ttd   = $_POST['nomor_induk_ttd'];
$saksi_1           = $_POST['saksi_1'];
$saksi_2           = $_POST['saksi_2'];
$saksi_3           = $_POST['saksi_3'];

$sql   = "SELECT `belum_menikah`.`sequence` FROM `belum_menikah` ORDER BY sequence DESC";
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
INSERT INTO `belum_menikah` 
(warga_id, tanggal_pembuatan, nomor_surat, sequence, nama_ttd, jabatan_ttd, nomor_induk_ttd, saksi_1, saksi_2, saksi_3)
VALUES
('$warga_id', '$tanggal_pembuatan', '$nomor_surat', $sequence, '$nama_ttd', '$jabatan_ttd', '$nomor_induk_ttd', '$saksi_1', '$saksi_2', '$saksi_3')
";

$query = mysqli_query($db, $sql);

$code = 500;
$msg = "Proses Simpan Data Gagal";
$id = null;
if ($query) {
    $code = 200;
    $msg  = "Proses Simpan Data Berhasil, Proses Print Dapat Dilakukan";
    $id   = mysqli_insert_id($db);

    logs($warga_id, "Belum Menikah", $nomor_surat, 'belum_menikah', $id);
}

echo json_encode([
    'code' => $code,
    'msg'  => $msg,
    'id'   => $id,
]);
