<?php
include('../../config/koneksi.php');

$warga_id = $_GET['warga_id'];

$sql = "SELECT * FROM `warga` WHERE `warga`.`id_warga` = '" . $warga_id . "' ORDER BY `warga`.`nama_warga` ASC";
$query = mysqli_query($db, $sql);
$total = mysqli_num_rows($query);

$data = [];

if ($total > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $data['id_warga'] = $row['id_warga'];
        $data['nama_warga'] = $row['nama_warga'];
        $data['nik'] = $row['nik_warga'];

        $data['tempat'] = $row['tempat_lahir_warga'];
        $data['tanggal_lahir'] = $row['tanggal_lahir_warga'];

        $data['jenis_kelamin'] = ($row['jenis_kelamin_warga'] == "L") ? "Laki-laki" : "Perempuan";
        $data['jk'] = $row['jenis_kelamin_warga'];

        $data['warganegara'] = $row['negara_warga'];
        $data['status_perkawinan'] = $row['status_perkawinan'];
        $data['agama'] = $row['agama_warga'];
        $data['pekerjaan'] = $row['pekerjaan_warga'];
        $data['alamat'] = $row['alamat_ktp_warga'];
    }
}

echo json_encode([
    'code'    => 200,
    'msg'     => 'OK',
    'total'   => mysqli_num_rows($query),
    'data'    => $data,
]);
