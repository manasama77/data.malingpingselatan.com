<?php
include('../../config/koneksi.php');
require '../constant.php';

$id_edit           = $_POST['id_edit'];
$tanggal_pembuatan = $_POST['tanggal_pembuatan'];
$masa_berlaku      = $_POST['masa_berlaku'];
$jenis_lembaga     = $_POST['jenis_lembaga'];
$nama_lembaga      = $_POST['nama_lembaga'];
$alamat            = $_POST['alamat'];
$tahun_pendirian   = $_POST['tahun_pendirian'];
$sk_pendirian      = $_POST['sk_pendirian'];
$jumlah_pegawai    = $_POST['jumlah_pegawai'];
$pengurus          = $_POST['pengurus'];
$pimpinan          = $_POST['pimpinan'];
$sekertaris        = $_POST['sekertaris'];
$bendahara         = $_POST['bendahara'];
$nama_kepala_desa  = $_POST['nama_kepala_desa'];
$nrp               = $_POST['nrp'];

$sql = "
UPDATE  
    `sk_domisili_lembaga` 
    SET
        jenis_lembaga     = '$jenis_lembaga',
        nama_lembaga      = '$nama_lembaga',
        alamat            = '$alamat',
        tahun_pendirian   = '$tahun_pendirian',
        sk_pendirian      = '$sk_pendirian',
        jumlah_pegawai    = '$jumlah_pegawai',
        pengurus          = '$pengurus',
        pimpinan          = '$pimpinan',
        sekertaris        = '$sekertaris',
        bendahara         = '$bendahara',
        masa_berlaku      = '$masa_berlaku',
        tanggal_pembuatan = '$tanggal_pembuatan',
        nama_kepala_desa  = '$nama_kepala_desa',
        nrp               = '$nrp'
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
