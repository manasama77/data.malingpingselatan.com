<?php
include('../../config/koneksi.php');
require '../constant.php';
require '../../f_logs.php';

$warga_id               = $_POST['warga_id'];
$nama_from              = $_POST['nama_from'];
$nik_from               = $_POST['nik_from'];
$tempat_lahir_from      = $_POST['tempat_lahir_from'];
$tanggal_lahir_from     = $_POST['tanggal_lahir_from'];
$jenis_kelamin_from     = $_POST['jenis_kelamin_from'];
$warganegara_from       = $_POST['warganegara_from'];
$status_perkawinan_from = $_POST['status_perkawinan_from'];
$agama_from             = $_POST['agama_from'];
$pekerjaan_from         = $_POST['pekerjaan_from'];
$alamat_from            = $_POST['alamat_from'];
$nama_to                = $_POST['nama_to'];
$nik_to                 = $_POST['nik_to'];
$tempat_lahir_to        = $_POST['tempat_lahir_to'];
$tanggal_lahir_to       = $_POST['tanggal_lahir_to'];
$jenis_kelamin_to       = $_POST['jenis_kelamin_to'];
$warganegara_to         = $_POST['warganegara_to'];
$status_perkawinan_to   = $_POST['status_perkawinan_to'];
$agama_to               = $_POST['agama_to'];
$pekerjaan_to           = $_POST['pekerjaan_to'];
$alamat_to              = $_POST['alamat_to'];
$nama_ttd               = $_POST['nama_ttd'];
$nrpdes                 = $_POST['nomor_induk_ttd'];
$jabatan                = $_POST['jabatan_ttd'];
$tanggal_pembuatan      = $_POST['tanggal_pembuatan'];
$acuan                  = $_POST['acuan'];

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
INSERT INTO `permohonan_perubahan_data_penduduk` 
(warga_id, nama_from, nik_from, tempat_lahir_from, tanggal_lahir_from, jenis_kelamin_from, warganegara_from, status_perkawinan_from, agama_from, pekerjaan_from, alamat_from, nama_to, nik_to, tempat_lahir_to, tanggal_lahir_to, jenis_kelamin_to, warganegara_to, status_perkawinan_to, agama_to, pekerjaan_to, alamat_to, nama_ttd, nrpdes, jabatan, nomor_surat, tanggal_pembuatan, acuan)
VALUES
('$warga_id', '$nama_from', '$nik_from', '$tempat_lahir_from', '$tanggal_lahir_from', '$jenis_kelamin_from', '$warganegara_from', '$status_perkawinan_from', '$agama_from', '$pekerjaan_from', '$alamat_from', '$nama_to', '$nik_to', '$tempat_lahir_to', '$tanggal_lahir_to', '$jenis_kelamin_to', '$warganegara_to', '$status_perkawinan_to', '$agama_to', '$pekerjaan_to', '$alamat_to', '$nama_ttd', '$nrpdes', '$jabatan', '$nomor_surat', '$tanggal_pembuatan', '$acuan')
";
$query = mysqli_query($db, $sql);

$code = 500;
$msg = "Proses Simpan Data Gagal";
$id = null;
if ($query) {
    $code = 200;
    $msg  = "Proses Simpan Data Berhasil, Proses Print Dapat Dilakukan";
    $id   = mysqli_insert_id($db);

    logs($warga_id, "Permohonan Perubahan Data Penduduk", $nomor_surat, 'permohonan_perubahan_data_penduduk', $id);
}

echo json_encode([
    'code' => $code,
    'msg'  => $msg,
    'id'   => $id,
]);
