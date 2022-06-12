<?php
session_start();
if (!isset($_SESSION['user'])) {
  // jika user belum login
  header('Location: ../login');
  exit();
}

include('../../config/koneksi.php');

// ambil data dari form
$id_warga              = htmlspecialchars($_POST['id_warga']);
$tanggal_pindah        = htmlspecialchars($_POST['tanggal_pindah']);
$alasan_pindah         = htmlspecialchars($_POST['alasan_pindah']);
$alamat_mutasi         = htmlspecialchars($_POST['alamat_mutasi']);
$rt_mutasi             = htmlspecialchars($_POST['rt_mutasi']);
$rw_mutasi             = htmlspecialchars($_POST['rw_mutasi']);
$desa_kelurahan_mutasi = htmlspecialchars($_POST['desa_kelurahan_mutasi']);
$kecamatan_mutasi      = htmlspecialchars($_POST['kecamatan_mutasi']);
$kabupaten_kota_mutasi = htmlspecialchars($_POST['kabupaten_kota_mutasi']);
$provinsi_mutasi       = htmlspecialchars($_POST['provinsi_mutasi']);
$negara_mutasi         = htmlspecialchars($_POST['negara_mutasi']);
$id_user               = $_SESSION['user']['id_user'];

$sql_has_kk     = "SELECT * FROM warga_has_kartu_keluarga WHERE id_warga = '" . $id_warga . "' LIMIT 1";
$query_has_kk   = mysqli_query($db, $sql_has_kk);
$num_row_has_kk = mysqli_num_rows($query_has_kk);
if ($num_row_has_kk > 0) {
  $sql_has_kk   = "DELETE FROM warga_has_kartu_keluarga WHERE id_warga = '" . $id_warga . "'";
  $query_has_kk = mysqli_query($db, $sql_has_kk);
}

$sql_kk     = "SELECT * FROM kartu_keluarga WHERE id_kepala_keluarga = '" . $id_warga . "'";
$query_kk   = mysqli_query($db, $sql_kk);
$num_row_kk = mysqli_num_rows($query_kk);

if ($num_row_kk > 0) {
  $sql_kk   = "DELETE FROM kartu_keluarga WHERE id_kepala_keluarga = '" . $id_warga . "'";
  $query_kk = mysqli_query($db, $sql_kk);
}

// masukkan ke database
$query = "INSERT INTO mutasi_keluar (id_warga, tanggal_pindah, alasan_pindah, alamat_tujuan, rt_tujuan, rw_tujuan, desa_kelurahan_tujuan, kecamatan_tujuan, kabupaten_kota_tujuan, provinsi_tujuan, negara_tujuan, created_at, updated_at) VALUES ('$id_warga', '$tanggal_pindah', '$alasan_pindah', '$alamat_mutasi', '$rt_mutasi', '$rw_mutasi', '$desa_kelurahan_mutasi', '$kecamatan_mutasi', '$kabupaten_kota_mutasi', '$provinsi_mutasi', '$negara_mutasi', CURRENT_TIMESTAMP, null);";

$query_update = "UPDATE warga SET status_warga ='Pindah keluar' where id_warga = $id_warga";


$hasil = mysqli_query($db, $query);
$hasil_update = mysqli_query($db, $query_update);

// cek keberhasilan pendambahan data
if ($hasil_update == true) {
  $_SESSION['success'] = "Tambah Mutasi Keluar Warga Berhasil!";
  header("Location: index.php");
  exit();
} else {
  $_SESSION['warning'] = "Tambah Mutasi Keluar Warga Gagal!";
  header("Location: index.php");
  exit();
}
