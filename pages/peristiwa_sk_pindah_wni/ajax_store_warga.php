<?php
include('../../config/koneksi.php');
require '../constant.php';
require '../../f_logs.php';

$no_kk                     = $_POST['no_kk'];
$nama_kepala_keluarga      = $_POST['nama_kepala_keluarga'];
$f_kampung                 = $_POST['f_kampung'];
$f_rt                      = $_POST['f_rt'];
$f_rw                      = $_POST['f_rw'];
$f_kodepos                 = $_POST['f_kodepos'];
$f_desa                    = $_POST['f_desa'];
$f_kecamatan               = $_POST['f_kecamatan'];
$f_kabupaten               = $_POST['f_kabupaten'];
$f_provinsi                = $_POST['f_provinsi'];
$tanggal_kepindahan        = $_POST['tanggal_kepindahan'];
$alasan_pindah             = $_POST['alasan_pindah'];
$alasan_pindah_lainnya     = $_POST['alasan_pindah_lainnya'];
$klasifikasi_pindah        = $_POST['klasifikasi_pindah'];
$jenis_kepindahan          = $_POST['jenis_kepindahan'];
$status_no_kk_tidak_pindah = $_POST['status_no_kk_tidak_pindah'];
$status_no_kk_pindah       = $_POST['status_no_kk_pindah'];
$t_kampung                 = $_POST['t_kampung'];
$t_rt                      = $_POST['t_rt'];
$t_rw                      = $_POST['t_rw'];
$t_desa                    = $_POST['t_desa'];
$t_kecamatan               = $_POST['t_kecamatan'];
$t_kabupaten               = $_POST['t_kabupaten'];
$t_provinsi                = $_POST['t_provinsi'];
$t_kodepos                 = $_POST['t_kodepos'];
$no_camat                  = $_POST['no_camat'];
$nama_camat                = $_POST['nama_camat'];
$nip_camat                 = $_POST['nip_camat'];
$nama_pemohon              = $_POST['nama_pemohon'];
$nama_kepala_desa          = $_POST['nama_kepala_desa'];
$nrp                       = $_POST['nrp'];
$tanggal_pembuatan         = $_POST['tanggal_pembuatan'];
$arr_pendatang             = json_decode($_POST['arr_pendatang']);

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
INSERT INTO `sk_pergi_wni` 
(
    no_kk,
    nama_kepala_keluarga,
    f_kampung,
    f_rt,
    f_rw,
    f_desa,
    f_kecamatan,
    f_kodepos,
    f_kabupaten,
    f_provinsi,
    alasan_pindah,
    alasan_pindah_lainnya,
    t_kampung,
    t_rt,
    t_rw,
    t_desa,
    t_kecamatan,
    t_kodepos,
    t_kabupaten,
    t_provinsi,
    klasifikasi_pindah,
    jenis_kepindahan,
    status_no_kk_tidak_pindah,
    status_no_kk_pindah,
    tanggal_kepindahan,
    no_camat,
    nama_camat,
    nip_camat,
    nama_pemohon,
    nama_kepala_desa,
    nrp,
    nomor_surat,
    tanggal_pembuatan
)
VALUES
(
    '$no_kk',
    '$nama_kepala_keluarga',
    '$f_kampung',
    '$f_rt',
    '$f_rw',
    '$f_desa',
    '$f_kecamatan',
    '$f_kodepos',
    '$f_kabupaten',
    '$f_provinsi',
    '$alasan_pindah',
    '$alasan_pindah_lainnya',
    '$t_kampung',
    '$t_rt',
    '$t_rw',
    '$t_desa',
    '$t_kecamatan',
    '$t_kodepos',
    '$t_kabupaten',
    '$t_provinsi',
    '$klasifikasi_pindah',
    '$jenis_kepindahan',
    '$status_no_kk_tidak_pindah',
    '$status_no_kk_pindah',
    '$tanggal_kepindahan',
    '$no_camat',
    '$nama_camat',
    '$nip_camat',
    '$nama_pemohon',
    '$nama_kepala_desa',
    '$nrp',
    '$nomor_surat',
    '$tanggal_pembuatan'
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

    logs($warga_id, "Surat Keterangan Pergi WNI", $nomor_surat, 'sk_pergi_wni', $id);

    foreach ($arr_pendatang as $key) {
        $sqlnya = "
            INSERT INTO `sk_pergi_wni_warga` 
            (
                sk_pergi_wni_id,
                nik,
                nama,
                tempat_lahir,
                tanggal_lahir,
                shdk
            )
            VALUES
            (
                '$id',
                '" . $key->nik_pendatang . "',
                '" . $key->nama_pendatang . "',
                '" . $key->tempat_lahir_pendatang . "',
                '" . $key->tanggal_lahir_pendatang . "',
                '" . $key->shdk_pendatang . "'
            )
        ";

        $query_lingkungan = mysqli_query($db, $sqlnya);
    }
}

echo json_encode([
    'code' => $code,
    'msg'  => $msg,
    'id'   => $id,
]);
