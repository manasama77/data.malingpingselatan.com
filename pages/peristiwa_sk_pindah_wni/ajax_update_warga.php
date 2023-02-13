<?php
include('../../config/koneksi.php');
require '../constant.php';

$id_edit               = $_POST['id_edit'];
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

$sql = "
UPDATE  
    `surat_pengantar_izin_keramaian` 
    SET
        warga_id              = '$warga_id',
        acara                 = '$acara',
        tanggal_jam_acara     = '$tanggal_jam_acara',
        tempat_acara          = '$tempat_acara',
        jumlah_peserta        = '$jumlah_peserta',
        hiburan               = '$hiburan',
        penanggungjawab_acara = '$penanggungjawab_acara',
        tanggal_pelaporan     = '$tanggal_pelaporan',
        nama_kepala_desa      = '$nama_kepala_desa',
        nomor_kapolsek        = '$nomor_kapolsek',
        tanggal_kapolsek      = '$tanggal_kapolsek',
        diizinkan_kapolsek    = '$diizinkan_kapolsek',
        catatan_kapolsek      = '$catatan_kapolsek',
        nama_danramil         = '$nama_danramil',
        nrp_danramil          = '$nrp_danramil',
        nama_kapolsek         = '$nama_kapolsek',
        nrp_kapolsek          = '$nrp_kapolsek',
        no_rw                 = '$no_rw',
        nama_rw               = '$nama_rw',
        no_rt                 = '$no_rt',
        nama_rt               = '$nama_rt'
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

    $sql_delete = "delete from izin_lingkungan where surat_pengantar_izin_keramaian_id = '" . $id . "'";
    $query_delete = mysqli_query($db, $sql_delete);

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
