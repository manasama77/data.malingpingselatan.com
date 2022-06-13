<?php
include('../../config/koneksi.php');

$keyword = $_GET['keyword'];

$sql = "
SELECT
	`warga`.id_warga,
	`warga`.nik_warga,
	`warga`.nama_warga, 
	`warga`.rt_warga, 
	`warga`.rw_warga 
FROM
    `warga`
    WHERE
        `warga`.jenis_kelamin_warga = 'P'
    AND
        (
            `warga`.`nama_warga` LIKE '%" . $keyword . "%' 
            OR 
            `warga`.`nik_warga` LIKE '%" . $keyword . "%'
        )
    ORDER BY 
        `warga`.`nama_warga` ASC
";
$query = mysqli_query($db, $sql);

$total = mysqli_num_rows($query);

$data = [];

if ($total > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        array_push($data, [
            'id_warga'   => $row['id_warga'],
            'nik_warga'  => $row['nik_warga'],
            'nama_warga' => $row['nama_warga'],
            'rt_warga'   => $row['rt_warga'],
            'rw_warga'   => $row['rw_warga'],
        ]);
    }
}

echo json_encode([
    'code'    => 200,
    'msg'     => 'OK',
    'keyword' => $keyword,
    'total'   => mysqli_num_rows($query),
    'data'    => $data,
    'sql'    => $sql,
]);
