<?php
include('../../config/koneksi.php');
require '../constant.php';
require '../../f_logs.php';

$warga_id              = $_POST['warga_id'];
$acara                 = $_POST['acara'];
$tanggal_jam_acara     = $_POST['tanggal_jam_acara'];
$tempat_acara          = $_POST['tempat_acara'];
$jumlah_peserta        = $_POST['jumlah_peserta'];
$hiburan               = $_POST['hiburan'];
$penanggungjawab_acara = $_POST['penanggungjawab_acara'];
$tanggal_pelaporan     = $_POST['tanggal_pelaporan'];
$nama_kepala_desa      = $_POST['nama_kepala_desa'];
$nomor_kapolsek        = $_POST['nomor_kapolsek'];
$tanggal_kapolsek      = $_POST['tanggal_kapolsek'];
$diizinkan_kapolsek    = $_POST['diizinkan_kapolsek'];
$catatan_kapolsek      = $_POST['catatan_kapolsek'];
$nama_danramil         = $_POST['nama_danramil'];
$nrp_danramil          = $_POST['nrp_danramil'];
$nama_kapolsek         = $_POST['nama_kapolsek'];
$nrp_kapolsek          = $_POST['nrp_kapolsek'];
$no_rw                 = $_POST['no_rw'];
$nama_rw               = $_POST['nama_rw'];
$no_rt                 = $_POST['no_rt'];
$nama_rt               = $_POST['nama_rt'];
$arr_lingkungan        = json_decode($_POST['arr_lingkungan']);

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
INSERT INTO `surat_pengantar_izin_keramaian` 
(
    warga_id,
    acara,
    tanggal_jam_acara,
    tempat_acara,
    jumlah_peserta,
    hiburan,
    penanggungjawab_acara,
    tanggal_pelaporan,
    nama_kepala_desa,
    nomor_kapolsek,
    tanggal_kapolsek,
    diizinkan_kapolsek,
    catatan_kapolsek,
    nama_danramil,
    nrp_danramil,
    nama_kapolsek,
    nrp_kapolsek,
    no_rw,
    nama_rw,
    no_rt,
    nama_rt,
    nomor_surat
)
VALUES
(
    '$warga_id',
    '$acara',
    '$tanggal_jam_acara',
    '$tempat_acara',
    '$jumlah_peserta',
    '$hiburan',
    '$penanggungjawab_acara',
    '$tanggal_pelaporan',
    '$nama_kepala_desa',
    '$nomor_kapolsek',
    '$tanggal_kapolsek',
    '$diizinkan_kapolsek',
    '$catatan_kapolsek',
    '$nama_danramil',
    '$nrp_danramil',
    '$nama_kapolsek',
    '$nrp_kapolsek',
    '$no_rw',
    '$nama_rw',
    '$no_rt',
    '$nama_rt',
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

    logs($warga_id, "Surat Pengantar Izin Keramaian", $nomor_surat, 'surat_pengantar_izin_keramaian', $id);

    foreach ($arr_lingkungan as $key) {
        $sql_lingkungan = "
            INSERT INTO `izin_lingkungan` 
            (
                surat_pengantar_izin_keramaian_id,
                nama
            )
            VALUES
            (
                '$id',
                '" . $key->name . "'
            )
        ";

        $query_lingkungan = mysqli_query($db, $sql_lingkungan);
    }
}

echo json_encode([
    'code' => $code,
    'msg'  => $msg,
    'id'   => $id,
]);
