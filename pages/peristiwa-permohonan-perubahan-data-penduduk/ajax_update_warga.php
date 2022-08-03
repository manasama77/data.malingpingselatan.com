<?php
include('../../config/koneksi.php');
require '../constant.php';

$id                     = $_POST['id'];
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

$sql = "
UPDATE  
    `permohonan_perubahan_data_penduduk` 
    SET
        warga_id               = '$warga_id',
        nama_from              = '$nama_from',
        nik_from               = '$nik_from',
        tempat_lahir_from      = '$tempat_lahir_from',
        tanggal_lahir_from     = '$tanggal_lahir_from',
        jenis_kelamin_from     = '$jenis_kelamin_from',
        warganegara_from       = '$warganegara_from',
        status_perkawinan_from = '$status_perkawinan_from',
        agama_from             = '$agama_from',
        pekerjaan_from         = '$pekerjaan_from',
        alamat_from            = '$alamat_from',
        nama_to                = '$nama_to',
        nik_to                 = '$nik_to',
        tempat_lahir_to        = '$tempat_lahir_to',
        tanggal_lahir_to       = '$tanggal_lahir_to',
        jenis_kelamin_to       = '$jenis_kelamin_to',
        warganegara_to         = '$warganegara_to',
        status_perkawinan_to   = '$status_perkawinan_to',
        agama_to               = '$agama_to',
        pekerjaan_to           = '$pekerjaan_to',
        alamat_to              = '$alamat_to',
        nama_ttd               = '$nama_ttd',
        nrpdes                 = '$nrpdes',
        jabatan                = '$jabatan',
        tanggal_pembuatan      = '$tanggal_pembuatan',
        acuan                  = '$acuan'
WHERE
    id = $id
";
$query = mysqli_query($db, $sql);

$code = 500;
$msg = "Proses Update Data Gagal";
if ($query) {
    $code = 200;
    $msg  = "Proses Update Data Berhasil, Proses Print Dapat Dilakukan";
}

echo json_encode([
    'code' => $code,
    'msg'  => $msg,
    'id'   => $id,
]);
