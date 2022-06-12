<?php
session_start();
if (!isset($_SESSION['user'])) {
  // jika user belum login
  header('Location: ../login');
  exit();
}

include('../../config/koneksi.php');

// ambil data dari form
$id_mutasi_keluar = htmlspecialchars($_GET['id_mutasi_keluar']);

// delete database
$sql   = "DELETE FROM mutasi_keluar WHERE id_mutasi_keluar = $id_mutasi_keluar";
$query = mysqli_query($db, $sql);

// cek keberhasilan pendambahan data
if ($query == true) {
  $_SESSION['success'] = "Delete Mutasi Keluar Warga Berhasil!";
  header("Location: index.php");
  exit();
} else {
  $_SESSION['warning'] = "Delete Mutasi Keluar Warga Gagal!";
  header("Location: index.php");
  exit();
}
