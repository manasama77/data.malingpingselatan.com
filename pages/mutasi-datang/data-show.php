<?php
include('../../config/koneksi.php');

// ambil dari url
$get_id_mutasi = $_GET['id_mutasi_masuk'];

if (!$get_id_mutasi) {
  echo json_encode([
    'code'    => 400,
    'message' => "Data mutasi tidak ditemukan",
    'data'    => []
  ]);
  exit();
}

// ambil dari database
$sql   = "
  SELECT
    mutasi_masuk.jenis_kepindahan,
    kartu_keluarga.nomor_keluarga,
    warga.nik_warga,
    warga.nama_warga,
    warga.tempat_lahir_warga,
    warga.tanggal_lahir_warga,
    warga.jenis_kelamin_warga,
    mutasi_masuk.agama_warga,
    mutasi_masuk.pendidikan_terakhir_warga,
    mutasi_masuk.pekerjaan_warga,
    mutasi_masuk.alamat_tujuan,
    mutasi_masuk.rt_warga,
    mutasi_masuk.rw_warga,
    mutasi_masuk.desa_kelurahan_warga,
    mutasi_masuk.kecamatan_warga,
    mutasi_masuk.kabupaten_kota_warga,
    mutasi_masuk.provinsi_warga,
    warga.negara_warga,
    mutasi_masuk.alamat_asal,
    mutasi_masuk.tanggal_pindah,
    mutasi_masuk.alasan_pindah,
    kepala_keluarga.nik_warga AS nik_kepala_keluarga,
    kepala_keluarga.nama_warga AS nama_kepala_keluarga 
  FROM
    mutasi_masuk
  LEFT JOIN warga ON warga.id_warga = mutasi_masuk.id_warga
  LEFT JOIN kartu_keluarga ON kartu_keluarga.id_keluarga = mutasi_masuk.id_keluarga
  LEFT JOIN warga AS kepala_keluarga ON kepala_keluarga.id_warga = kartu_keluarga.id_kepala_keluarga 
  WHERE
    id_mutasi_masuk = " . $get_id_mutasi . "
";
$query = mysqli_query($db, $sql);

$data = [];

echo json_encode([
  'code'    => 200,
  'message' => "Data mutasi ditemukan",
  'data'    => mysqli_fetch_assoc($query)
]);
exit();
