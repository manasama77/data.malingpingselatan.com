<?php
include('../../config/koneksi.php');
require '../constant.php';

$id_edit           = $_POST['id_edit'];
$tanggal_pembuatan = $_POST['tanggal_pembuatan'];
$warga_id          = $_POST['warga_id_hidden'];
$tujuan            = $_POST['tujuan'];
$sejak             = $_POST['sejak'];
$sampai            = ($_POST['sampai']) ?? null;
$pekerjaan         = $_POST['pekerjaan'];
$pelapor_id        = $_POST['pelapor_id_hidden'];
$hubungan_pelapor  = ($_POST['hubungan_pelapor']) ?? null;
$nama_ttd          = $_POST['nama_ttd'];
$jabatan_ttd       = $_POST['jabatan_ttd'];
$nomor_induk_ttd   = $_POST['nomor_induk_ttd'];

$sql = "
UPDATE  
    `bekerja_luar_negeri_kota` 
    SET
        warga_id          = '$warga_id',
        tujuan            = '$tujuan',
        sejak             = '$sejak',
        sampai            = '$sampai',
        pekerjaan         = '$pekerjaan',
        pelapor_id        = '$pelapor_id',
        hubungan_pelapor  = '$hubungan_pelapor',
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
