<?php
session_start();
require '../../config/koneksi.php';
require '../constant.php';

$id_edit             = $_POST['id_edit'];
$warga_id            = $_POST['warga_id'];
$tanggal_pembuatan   = $_POST['tanggal_pembuatan'];
$nama_bayi           = $_POST['nama_bayi'];
$anak_ke             = $_POST['anak_ke'];
$kota_kelahiran      = $_POST['kota_kelahiran'];
$tempat_kelahiran    = $_POST['tempat_kelahiran'];
$tanggal_lahir       = $_POST['tanggal_lahir'];
$jam_kelahiran       = $_POST['jam_kelahiran'];
$jenis_kelamin_warga = $_POST['jenis_kelamin_warga'];
$agama               = $_POST['agama'];
$ayah_id             = $_POST['ayah_id'];
$ibu_id              = $_POST['ibu_id'];
$alamat              = $_POST['alamat'];
$rt                  = $_POST['rt'];
$rw                  = $_POST['rw'];
$desa                = $_POST['desa'];
$kecamatan           = $_POST['kecamatan'];
$kokab               = $_POST['kokab'];
$provinsi            = $_POST['provinsi'];
$pelapor_id          = $_POST['pelapor_id'];
$hubungan_pelapor    = $_POST['hubungan_pelapor'];
$ayah_id_hidden      = $_POST['ayah_id_hidden'];
$keluarga_id_hidden  = $_POST['keluarga_id_hidden'];
$ibu_id_hidden       = $_POST['ibu_id_hidden'];
$pelapor_id_hidden   = $_POST['pelapor_id_hidden'];
$nama_ttd            = $_POST['nama_ttd'];
$jabatan_ttd         = $_POST['jabatan_ttd'];
$nomor_induk_ttd     = $_POST['nomor_induk_ttd'];
$hari                = day_name_indo($_POST['tanggal_lahir']);

$sql_warga = "
UPDATE  
    `warga` 
    SET
        nama_warga           = '$nama_bayi',
        tempat_lahir_warga   = '$kota_kelahiran',
        tanggal_lahir_warga  = '$tanggal_lahir',
        jenis_kelamin_warga  = '$jenis_kelamin_warga',
        alamat_warga         = '$alamat',
        desa_kelurahan_warga = '$desa',
        kecamatan_warga      = '$kecamatan',
        kabupaten_kota_warga = '$kokab',
        provinsi_warga       = '$provinsi',
        rt_warga             = '$rt',
        rw_warga             = '$rw',
        agama_warga          = '$agama'
WHERE
    id = $warga_id
";

$query_warga = mysqli_query($db, $sql_warga);


$sql_warga_has_kartu_keluarga = "
UPDATE `warga_has_kartu_keluarga`
SET id_keluarga = '$keluarga_id_hidden'
WHERE warga_id = '$warga_id'
";

$query_warga_has_kartu_keluarga = mysqli_query($db, $sql_warga_has_kartu_keluarga);

$sql = "
UPDATE  
    `kelahiran` 
    SET
        hari              = '$hari',
        tanggal_kelahiran = '$tanggal_lahir',
        jam_kelahiran     = '$jam_kelahiran',
        tempat_kelahiran  = '$tempat_kelahiran',
        anak_ke           = '$anak_ke',
        ibu_id            = '$ibu_id_hidden',
        ayah_id           = '$ayah_id_hidden',
        pelapor_id        = '$pelapor_id_hidden',
        hubungan_pelapor  = '$hubungan_pelapor',
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
