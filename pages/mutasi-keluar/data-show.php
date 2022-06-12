<?php
include('../../config/koneksi.php');

// ambil dari url
$id_mutasi_keluar = $_GET['id_mutasi_keluar'];

// ambil dari database
$sql     = "SELECT * FROM mutasi_keluar LEFT JOIN warga ON warga.id_warga = mutasi_keluar.id_warga WHERE id_mutasi_keluar = '" . $id_mutasi_keluar . "'";
$query   = mysqli_query($db, $sql);
$num_row = mysqli_num_rows($query);
$row     = mysqli_fetch_assoc($query);

if ($num_row == 0) {
  echo json_encode([
    'code'    => 404,
    'message' => 'Data Not Found',
    'data'    => []
  ]);
  exit();
}

echo json_encode([
  'code'    => 200,
  'message' => 'Data Found',
  'data'    => $row
]);
exit();
