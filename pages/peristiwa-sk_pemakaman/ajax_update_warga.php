<?php
include('../../config/koneksi.php');
require '../constant.php';

$id_edit            = $_POST['id_edit'];
$jenazah_id         = $_POST['jenazah_id'];
$tanggal_meninggal  = $_POST['tanggal_meninggal'];
$penyebab_kematian  = $_POST['penyebab_kematian'];
$pengurus_pemakaman = $_POST['pengurus_pemakaman'];
$dimakamkan_di      = $_POST['dimakamkan_di'];
$pelapor_id         = $_POST['pelapor_id'];
$tanggal_pelaporan  = $_POST['tanggal_pelaporan'];
$nama_kepala_desa   = $_POST['nama_kepala_desa'];
$nrp                = $_POST['nrp'];

$sql = "
UPDATE  
    `sk_pemakaman` 
    SET
        jenazah_id         = '$jenazah_id',
        tanggal_meninggal  = '$tanggal_meninggal',
        penyebab_kematian  = '$penyebab_kematian',
        pengurus_pemakaman = '$pengurus_pemakaman',
        dimakamkan_di      = '$dimakamkan_di',
        pelapor_id         = '$pelapor_id',
        tanggal_pelaporan  = '$tanggal_pelaporan',
        nama_kepala_desa   = '$nama_kepala_desa',
        nrp                = '$nrp'
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
