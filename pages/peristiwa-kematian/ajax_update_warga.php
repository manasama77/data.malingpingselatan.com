<?php
include('../../config/koneksi.php');
require '../constant.php';

$id_edit           = $_POST['id_edit'];
$tanggal_pembuatan = $_POST['tanggal_pembuatan'];
$warga_id          = $_POST['warga_id_hidden'];
$tanggal_kematian  = $_POST['tanggal_kematian'];
$jam_kematian      = $_POST['jam_kematian'];
$penyebab_kematian = $_POST['penyebab_kematian'];
$tempat_kematian   = $_POST['tempat_kematian'];
$pelapor_id        = $_POST['pelapor_id_hidden'];
$hubungan_pelapor  = $_POST['hubungan_pelapor'];
$nama_ttd          = $_POST['nama_ttd'];
$jabatan_ttd       = $_POST['jabatan_ttd'];
$nomor_induk_ttd   = $_POST['nomor_induk_ttd'];
$hari              = day_name_indo($_POST['tanggal_kematian']);

$sql = "
UPDATE  
    `kematian` 
    SET
        warga_id          = '$warga_id',
        hari              = '$hari',
        tanggal_kematian  = '$tanggal_kematian',
        jam_kematian      = '$jam_kematian',
        penyebab_kematian = '$penyebab_kematian',
        tempat_kematian   = '$tempat_kematian',
        pelapor_id        = '$pelapor_id',
        hubungan_pelapor  = '$hubungan_pelapor',
        tanggal_pembuatan = '$tanggal_pembuatan',
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

    $sql_warga = "UPDATE warga SET status_warga = 'Meninggal' WHERE id_warga = '$warga_id'";
    mysqli_query($db, $sql_warga);
}

echo json_encode([
    'code' => $code,
    'msg'  => $msg,
    'id'   => $id,
]);


function day_name_indo($tanggal)
{
    $tgl_obj = new DateTime($tanggal);
    $name_eng = $tgl_obj->format('D');

    $arr = [
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
    ];

    if ($name_eng == "Sun") {
        return $arr['0'];
    } elseif ($name_eng == "Mon") {
        return $arr['1'];
    } elseif ($name_eng == "Tue") {
        return $arr['2'];
    } elseif ($name_eng == "Wed") {
        return $arr['3'];
    } elseif ($name_eng == "Thu") {
        return $arr['4'];
    } elseif ($name_eng == "Fri") {
        return $arr['5'];
    } elseif ($name_eng == "Sat") {
        return $arr['6'];
    }
}
