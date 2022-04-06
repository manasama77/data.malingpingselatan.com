<?php
include('../../config/koneksi.php');

$keyword = $_GET['keyword'];

$sql = "
SELECT
	`kartu_keluarga`.id_keluarga,
	`kartu_keluarga`.alamat_keluarga,
	`warga`.id_warga,
	`warga`.nik_warga,
	`warga`.nama_warga, 
	`warga`.rt_warga, 
	`warga`.rw_warga 
FROM
	`kartu_keluarga`
	LEFT JOIN `warga` ON `warga`.id_warga = `kartu_keluarga`.id_kepala_keluarga
    WHERE
        `warga`.`nama_warga` LIKE '%" . $keyword . "%' 
    OR 
        `warga`.`nik_warga` LIKE '%" . $keyword . "%'
    ORDER BY 
        `warga`.`nama_warga` ASC
";
$query = mysqli_query($db, $sql);

$total = mysqli_num_rows($query);

$data = [];

if ($total > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        array_push($data, [
            'id_warga'        => $row['id_warga'],
            'nik_warga'       => $row['nik_warga'],
            'nama_warga'      => $row['nama_warga'],
            'id_keluarga'     => $row['id_keluarga'],
            'alamat_keluarga' => $row['alamat_keluarga'],
            'rt_warga'        => $row['rt_warga'],
            'rw_warga'        => $row['rw_warga'],
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
