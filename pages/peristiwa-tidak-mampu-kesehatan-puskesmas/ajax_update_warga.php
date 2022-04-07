<?php
include('../../config/koneksi.php');
require '../constant.php';

$id_edit           = $_POST['id_edit'];
$tanggal_pembuatan = $_POST['tanggal_pembuatan'];
$warga_id          = $_POST['warga_id_hidden'];
$no_rt_ttd         = $_POST['no_rt_ttd'];
$nama_rt_ttd       = $_POST['nama_rt_ttd'];
$no_rw_ttd         = $_POST['no_rw_ttd'];
$nama_rw_ttd       = $_POST['nama_rw_ttd'];
$nama_tksk_ttd     = $_POST['nama_tksk_ttd'];
$jabatan_ttd       = $_POST['jabatan_ttd'];
$nama_ttd          = $_POST['nama_ttd'];
$nomor_induk_ttd   = $_POST['nomor_induk_ttd'];
$no_register_camat = $_POST['no_register_camat'];
$nama_camat        = $_POST['nama_camat'];
$nip_camat         = $_POST['nip_camat'];

$sql = "
UPDATE  
    `tidak_mampu_kesehatan_puskesmas` 
    SET
        warga_id          = '$warga_id',
        tanggal_pembuatan = '$tanggal_pembuatan',
        no_rt_ttd         = '$no_rt_ttd',
        nama_rt_ttd       = '$nama_rt_ttd',
        no_rw_ttd         = '$no_rw_ttd',
        nama_rw_ttd       = '$nama_rw_ttd',
        nama_tksk_ttd     = '$nama_tksk_ttd',
        nama_ttd          = '$nama_ttd',
        jabatan_ttd       = '$jabatan_ttd',
        nomor_induk_ttd   = '$nomor_induk_ttd',
        no_register_camat = '$no_register_camat',
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
