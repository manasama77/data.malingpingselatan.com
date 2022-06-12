<?php
include('../../config/koneksi.php');

// ambil dari database
# $query = "SELECT mutasi_masuk.id_mutasi_masuk,nik_warga,nama_warga,jenis_kelamin_warga,pendidikan_terakhir_warga,pekerjaan_warga,status_perkawinan_warga,status_warga, TIMESTAMPDIFF(YEAR, `tanggal_lahir_warga`, CURDATE()) AS usia_mutasi FROM warga JOIN mutasi_masuk ON warga.nik_warga = mutasi_masuk.id_warga";

$sql_mutasi = "
  SELECT 
    mutasi_masuk.id_mutasi_masuk,
    warga.nik_warga,
    warga.nama_warga,
    warga.jenis_kelamin_warga,
    warga.tanggal_lahir_warga,
    mutasi_masuk.tanggal_pindah,
    mutasi_masuk.jenis_kepindahan,
    mutasi_masuk.alasan_pindah
  FROM warga 
  RIGHT JOIN mutasi_masuk ON mutasi_masuk.id_warga = warga.id_warga
";
$query_mutasi = mysqli_query($db, $sql_mutasi);
$data_mutasi = array();
while ($row = mysqli_fetch_assoc($query_mutasi)) {
  $data_mutasi[] = $row;
}
