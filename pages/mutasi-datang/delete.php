<?php
session_start();
if (!isset($_SESSION['user'])) {
  // jika user belum login
  header('Location: ../login');
  exit();
}

include('../../config/koneksi.php');

// ambil data dari form
$id_mutasi_masuk = htmlspecialchars($_GET['id_mutasi_masuk']);

$sql_check      = "SELECT * FROM mutasi_masuk WHERE id_mutasi_masuk = '" . $id_mutasi_masuk . "'";
$query_check    = mysqli_query($db, $sql_check);
$num_rows_check = mysqli_num_rows($query_check);

if ($num_rows_check == 0) {
  $_SESSION['warning'] = "Data Mutasi Masuk Warga Tidak Ditemukan!";
  header("Location: index.php");
  exit();
}

$row_check        = mysqli_fetch_assoc($query_check);
$id_warga         = $row_check['id_warga'];
$id_keluarga      = $row_check['id_keluarga'];
$jenis_kepindahan = $row_check['jenis_kepindahan'];

if ($jenis_kepindahan == "Kepala Keluarga") {
  $sql_kartu_keluarga   = "DELETE FROM kartu_keluarga WHERE id_keluarga = '" . $id_keluarga . "'";
  $query_kartu_keluarga = mysqli_query($db, $sql_kartu_keluarga);
} else if ($jenis_kepindahan == "Anggota Keluarga") {
  $sql_warga_has_kartu_keluarga   = "DELETE FROM warga_has_kartu_keluarga WHERE id_warga = '" . $id_warga . "'";
  $query_warga_has_kartu_keluarga = mysqli_query($db, $sql_warga_has_kartu_keluarga);
}

// delete database
$sql_warga        = "DELETE FROM warga WHERE id_warga = '" . $id_warga . "'";
$sql_mutasi_masuk = "DELETE FROM mutasi_masuk WHERE id_mutasi_masuk = '" . $id_mutasi_masuk . "'";

$query_warga        = mysqli_query($db, $sql_warga);
$query_mutasi_masuk = mysqli_query($db, $sql_mutasi_masuk);

// cek keberhasilan pendambahan data
if ($query_mutasi_masuk === true) {
  $_SESSION['success'] = "Data Mutasi Masuk Warga Berhasil Dihapus!";
  header("Location: index.php");
  exit();
} else {
  $_SESSION['success'] = "Data Mutasi Masuk Warga Gagal Dihapus!";
  header("Location: index.php");
  exit();
}
