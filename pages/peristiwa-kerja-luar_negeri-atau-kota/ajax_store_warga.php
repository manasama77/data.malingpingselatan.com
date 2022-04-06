<?php
include('../../config/koneksi.php');
require '../constant.php';

$tanggal_pembuatan = $_POST['tanggal_pembuatan'];
$warga_id          = $_POST['warga_id_hidden'];
$tujuan            = $_POST['tujuan'];
$sejak             = $_POST['sejak'];
$sampai            = ($_POST['sampai']) ?? null;
$pekerjaan         = $_POST['pekerjaan'];
$pelapor_id        = $_POST['pelapor_id_hidden'];
$hubungan_pelapor  = ($_POST['hubungan_pelapor']) ?? null;

$sql   = "SELECT `bekerja_luar_negeri_kota`.`sequence` FROM `bekerja_luar_negeri_kota` ORDER BY sequence DESC";
$query = mysqli_query($db, $sql);

$sequence = 1;
$no_urut = "001";
if (mysqli_num_rows($query) > 0) {
    $row      = mysqli_fetch_row($query);
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
INSERT INTO `bekerja_luar_negeri_kota` 
(warga_id, tujuan, sejak, sampai, pekerjaan, pelapor_id, hubungan_pelapor, tanggal_pembuatan, nomor_surat, sequence)
VALUES
($warga_id, '$tujuan', '$sejak', '$sampai', '$pekerjaan', $pelapor_id, '$hubungan_pelapor', '$tanggal_pembuatan', '$nomor_surat', $sequence)
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
