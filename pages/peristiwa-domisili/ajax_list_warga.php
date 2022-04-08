<?php
include('../../config/koneksi.php');

$keyword = $_GET['keyword'];

$sql = "SELECT * FROM `warga` WHERE `warga`.`nama_warga` LIKE '%" . $keyword . "%' ORDER BY `warga`.`nama_warga` ASC";
$query = mysqli_query($db, $sql);

$total = mysqli_num_rows($query);

$data = [];

if ($total > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        array_push($data, [
            'id_warga'   => $row['id_warga'],
            'nama_warga' => $row['nama_warga'],
        ]);
    }
}

echo json_encode([
    'code'    => 200,
    'msg'     => 'OK',
    'keyword' => $keyword,
    'total'   => mysqli_num_rows($query),
    'data'    => $data,
]);
