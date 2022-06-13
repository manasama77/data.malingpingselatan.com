<?php
include('../../config/koneksi.php');

$id_kepala_keluarga = $_GET['id_kepala_keluarga'];
if (!$id_kepala_keluarga) {
    echo json_encode([
        'code' => 404,
        'msg'  => 'Kepala keluarga Tidak Ditemukan',
    ]);
    exit;
}

$sql   = "SELECT * FROM warga where id_warga = $id_kepala_keluarga";
$query = mysqli_query($db, $sql);
$num_rows = mysqli_num_rows($query);

if ($num_rows == 0) {
    echo json_encode([
        'code' => 404,
        'msg'  => 'Kepala keluarga Tidak Ditemukan',
    ]);
    exit;
}

$result = [];
while ($row = mysqli_fetch_array($query)) {
    $result['alamat_warga']         = $row['alamat_warga'];
    $result['rt_warga']             = $row['rt_warga'];
    $result['rw_warga']             = $row['rw_warga'];
    $result['desa_kelurahan_warga'] = $row['desa_kelurahan_warga'];
    $result['kecamatan_warga']      = $row['kecamatan_warga'];
    $result['kabupaten_kota_warga'] = $row['kabupaten_kota_warga'];
    $result['provinsi_warga']       = $row['provinsi_warga'];
}

echo json_encode([
    'code' => 200,
    'msg'  => 'Kepala keluarga Ditemukan',
    'data' => $result,
]);
