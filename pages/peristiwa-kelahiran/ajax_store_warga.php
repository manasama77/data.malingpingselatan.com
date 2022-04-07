<?php
session_start();
require '../../config/koneksi.php';
require '../constant.php';

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

$sql   = "SELECT `kelahiran`.`sequence` FROM `kelahiran` ORDER BY sequence DESC";
$query = mysqli_query($db, $sql);

$sequence = 1;
$no_urut = "001";
if (mysqli_num_rows($query) > 0) {
    $row      = mysqli_fetch_assoc($query);
    $sequence = $row['sequence'] + 1;
    if ($sequence == 100) {
        $no_urut = 100;
    } elseif ($sequence >= 10 && $sequence < 100) {
        $no_urut = '0' . $sequence;
    } elseif ($sequence < 10) {
        $no_urut = '00' . $sequence;
    }
}

$nomor_surat = '140/' . $no_urut . '- ' . KODE_DESA_SURAT . '/' . date('Y');

$sql_warga = "
INSERT INTO
    `warga`
    (
        nik_warga,
        nama_warga,
        tempat_lahir_warga,
        tanggal_lahir_warga,
        jenis_kelamin_warga,
        alamat_ktp_warga,
        alamat_warga,
        desa_kelurahan_warga,
        kecamatan_warga,
        kabupaten_kota_warga,
        provinsi_warga,
        negara_warga,
        dusun_warga,
        rt_warga,
        rw_warga,
        agama_warga,
        pendidikan_terakhir_warga,
        pekerjaan_warga,
        status_warga,
        id_user,
        created_at,
        updated_at
    )
VALUES
    (
        '-',
        '$nama_bayi',
        '$kota_kelahiran',
        '$tanggal_lahir',
        '$jenis_kelamin_warga',
        '-',
        '$alamat',
        '$desa',
        '$kecamatan',
        '$kokab',
        '$kokab',
        '$provinsi',
        'INDONESIA',
        '$rt',
        '$rw',
        '$agama',
        '-',
        '-',
        'Tinggal Tetap',
        '" . $_SESSION['user']['id_user'] . "',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "'
    )
";

$query_warga = mysqli_query($db, $sql_warga);
$warga_id = mysqli_insert_id($db);


$sql_warga_has_kartu_keluarga = "
INSERT INTO 
    `warga_has_kartu_keluarga` 
    (id_warga, id_keluarga)
VALUES
    (
        '$warga_id',
        '$keluarga_id_hidden'
    )
";
$query_warga_has_kartu_keluarga = mysqli_query($db, $sql_warga_has_kartu_keluarga);

$sql = "
INSERT INTO `kelahiran` 
    (
        warga_id, 
        hari, 
        tanggal_kelahiran, 
        jam_kelahiran, 
        tempat_kelahiran, 
        anak_ke, 
        ibu_id, 
        ayah_id, 
        pelapor_id, 
        hubungan_pelapor, 
        tanggal_pembuatan, 
        nomor_surat, 
        sequence, 
        nama_ttd, 
        jabatan_ttd, 
        nomor_induk_ttd
    )
VALUES
    (
        $warga_id, 
        '$hari', 
        '$tanggal_lahir', 
        '$jam_kelahiran', 
        '$tempat_kelahiran', 
        '$anak_ke', 
        $ibu_id_hidden, 
        $ayah_id_hidden, 
        $pelapor_id_hidden, 
        '$hubungan_pelapor', 
        '$tanggal_pembuatan', 
        '$nomor_surat', 
        $sequence,
        '$nama_ttd', 
        '$jabatan_ttd', 
        '$nomor_induk_ttd'
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
