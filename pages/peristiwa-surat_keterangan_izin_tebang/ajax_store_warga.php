<?php
include('../../config/koneksi.php');
require '../constant.php';
require '../../f_logs.php';

$tanggal_pembuatan = $_POST['tanggal_pembuatan'];
$warga_id          = $_POST['warga_id'];
$luas_lahan        = $_POST['luas_lahan'];
$status_lahan      = $_POST['status_lahan'];
$persil_girik_sppt = $_POST['persil_girik_sppt'];
$lokasi_blok       = $_POST['lokasi_blok'];
$nama_kepala_desa  = $_POST['nama_kepala_desa'];
$no_rt             = $_POST['no_rt'];
$nama_rt           = $_POST['nama_rt'];
$arr_pohon         = json_decode($_POST['arr_pohon']);

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
INSERT INTO `sk_izin_tebang` 
(
    warga_id,
    luas_lahan,
    status_lahan,
    persil_girik_sppt,
    lokasi_blok,
    tanggal_pembuatan,
    no_rt,
    nama_rt,
    nama_kepala_desa,
    nomor_surat
)
VALUES
(
    '$warga_id',
    '$luas_lahan',
    '$status_lahan',
    '$persil_girik_sppt',
    '$lokasi_blok',
    '$tanggal_pembuatan',
    '$no_rt',
    '$nama_rt',
    '$nama_kepala_desa',
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

    logs($warga_id, "Surat Keterangan Izin Tebang", $nomor_surat, 'sk_izin_tebang', $id);

    foreach ($arr_pohon as $key) {
        $sql_lingkungan = "
            INSERT INTO `sk_izin_tebang_item` 
            (
                sk_izin_tebang_id,
                jenis_kayu,
                jumlah_batang,
                hasil_klem,
                keterangan
            )
            VALUES
            (
                '$id',
                '" . $key->nama_kayu . "',
                '" . $key->jumlah_batang . "',
                '" . $key->hasil_klem . "',
                '" . $key->keterangan . "'
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
