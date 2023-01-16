<?php
include('../../config/koneksi.php');
require '../constant.php';

$id = $_GET['id'];

// PART NOMOR SURAT
$sql   = "SELECT * FROM `izin_lingkungan` WHERE `surat_pengantar_izin_keramaian_id` = '" . $id . "'";
$query = mysqli_query($db, $sql);
$nr    = mysqli_num_rows($query);

$data = [];
$code = 404;

if ($nr > 0) {
    $code = 200;
    while ($row = mysqli_fetch_assoc($query)) {
        $id = rand(0, 9999);
        $nama = $row['nama'];
        array_push($data, [
            'id'   => $id,
            'nama' => $nama,
        ]);
    }
}

echo json_encode([
    'code' => $code,
    'data' => $data,
]);
