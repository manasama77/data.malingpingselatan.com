<?php
include('../../config/koneksi.php');
require '../constant.php';
require '../../f_logs.php';

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
INSERT INTO `kematian` 
(warga_id, hari, tanggal_kematian, jam_kematian, penyebab_kematian, tempat_kematian, pelapor_id, hubungan_pelapor, tanggal_pembuatan, nomor_surat, sequence, nama_ttd, jabatan_ttd, nomor_induk_ttd)
VALUES
($warga_id, '$hari', '$tanggal_kematian', '$jam_kematian', '$penyebab_kematian', '$tempat_kematian', $pelapor_id, '$hubungan_pelapor', '$tanggal_pembuatan', '$nomor_surat', $sequence, '$nama_ttd', '$jabatan_ttd', '$nomor_induk_ttd')
";
$query = mysqli_query($db, $sql);

$code = 500;
$msg = "Proses Simpan Data Gagal";
$id = null;
if ($query) {
    $code = 200;
    $msg  = "Proses Simpan Data Berhasil, Proses Print Dapat Dilakukan";
    $id   = mysqli_insert_id($db);

    logs($warga_id, "Kematian", $nomor_surat, 'kematian', $id);

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
