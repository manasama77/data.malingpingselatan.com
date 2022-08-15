<?php
include('../../config/koneksi.php');
require '../constant.php';

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
INSERT INTO `sk_domisili_lembaga` 
(
    jenis_lembaga,
    nama_lembaga,
    alamat,
    tahun_pendirian,
    sk_pendirian,
    jumlah_pegawai,
    pengurus,
    pimpinan,
    sekertaris,
    bendahara,
    masa_berlaku,
    tanggal_pembuatan,
    nomor_surat,
    nama_kepala_desa,
    nrp
)
VALUES
(
    '$jenis_lembaga',
    '$nama_lembaga',
    '$alamat',
    '$tahun_pendirian',
    '$sk_pendirian',
    '$jumlah_pegawai',
    '$pengurus',
    '$pimpinan',
    '$sekertaris',
    '$bendahara',
    '$masa_berlaku',
    '$tanggal_pembuatan',
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
