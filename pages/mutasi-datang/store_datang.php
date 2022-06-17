<?php
session_start();
if (!isset($_SESSION['user'])) {
	// jika user belum login
	header('Location: ../login');
	exit();
}

include('../../config/koneksi.php');
include('./_partials/Helper.php');

// CATCH POST REQUEST
set_session_from_post();

if ($_SESSION['jenis_kepindahan'] == "Kepala Keluarga") {
	$sql_cek_kk      = "SELECT nomor_keluarga from kartu_keluarga where nomor_keluarga = '" . $_SESSION['nomor_keluarga'] . "'";
	$query_cek_kk    = mysqli_query($db, $sql_cek_kk);
	$num_rows_cek_kk = mysqli_num_rows($query_cek_kk);
	if ($num_rows_cek_kk > 0) {
		$_SESSION['warning'] = "Tambah warga gagal!, No. KK " . $_SESSION['nomor_keluarga'] . " sudah digunakan !";
		header('location: pindah_masuk.php');
		exit();
	}
}

$sql_cek_nik      = "SELECT nik_warga from warga where nik_warga = '" . $_SESSION['nik_warga'] . "'";
$query_cek_nik    = mysqli_query($db, $sql_cek_nik);
$num_rows_cek_nik = mysqli_num_rows($query_cek_nik);
if ($num_rows_cek_nik > 0) {
	$_SESSION['warning'] = "Tambah warga gagal!, NIK " . $_SESSION['nik_warga'] . " sudah digunakan !";
	header('location: pindah_masuk.php');
	exit();
}

$id_user      = $_SESSION['user']['id_user'];
$status_warga = 'Pindah Datang';


$sql_warga = "
	INSERT INTO warga 
	(
		nik_warga, nama_warga, tempat_lahir_warga, tanggal_lahir_warga, jenis_kelamin_warga, alamat_ktp_warga, alamat_warga, desa_kelurahan_warga, kecamatan_warga, kabupaten_kota_warga, provinsi_warga, negara_warga, dusun_warga, rt_warga, rw_warga, agama_warga, pendidikan_terakhir_warga, pekerjaan_warga, status_warga, id_user, 
		created_at, updated_at
	) 
	VALUES 
	(
		'" . $_SESSION['nik_warga'] . "', '" . $_SESSION['nama_warga'] . "', '" . $_SESSION['tempat_lahir_warga'] . "', '" . $_SESSION['tanggal_lahir_warga'] . "', '" . $_SESSION['jenis_kelamin_warga'] . "', '" . $_SESSION['alamat_asal'] . "', '" . $_SESSION['alamat_tujuan'] . "', '" . $_SESSION['kelurahan'] . "', '" . $_SESSION['kecamatan'] . "', '" . $_SESSION['kokab'] . "', '" . $_SESSION['provinsi'] . "', '" . $_SESSION['negara'] . "', null, '" . $_SESSION['rt_warga'] . "', '" . $_SESSION['rw_warga'] . "', '" . $_SESSION['agama_warga'] . "', '" . $_SESSION['pendidikan_terakhir_warga'] . "', '" . $_SESSION['pekerjaan_warga'] . "', '" . $status_warga . "',  '" . $id_user . "', CURRENT_TIMESTAMP,  null
	)
";
$query_warga = mysqli_query($db, $sql_warga);
$id_warga    = mysqli_insert_id($db);

if ($_SESSION['jenis_kepindahan'] == "Kepala Keluarga") {
	$sql_kk = "INSERT INTO kartu_keluarga 
		(nomor_keluarga, id_kepala_keluarga, alamat_keluarga, desa_kelurahan_keluarga, kecamatan_keluarga, kabupaten_kota_keluarga, provinsi_keluarga, negara_keluarga, rt_keluarga, rw_keluarga, kode_pos_keluarga, id_user, created_at, updated_at) 
		VALUES ('" . $_SESSION['nomor_keluarga'] . "', '" . $id_warga . "', '" . $_SESSION['alamat_asal'] . "', '" . $_SESSION['kelurahan'] . "', '" . $_SESSION['kecamatan'] . "', '" . $_SESSION['kokab'] . "', '" . $_SESSION['provinsi'] . "', '" . $_SESSION['negara'] . "', '" . $_SESSION['rt_warga'] . "', '" . $_SESSION['rw_warga'] . "', '-', '" . $id_user . "', CURRENT_TIMESTAMP, null);";
	$query_kk = mysqli_query($db, $sql_kk);
	$id_keluarga = mysqli_insert_id($db);
	$_SESSION['id_keluarga'] = $id_keluarga;
} elseif ($_SESSION['jenis_kepindahan'] == "Anggota Keluarga") {
	$sql_warga_has_kartu_keluarga   = "INSERT INTO warga_has_kartu_keluarga (id_warga, id_keluarga) VALUES (" . $id_warga . ", " . $_SESSION['id_keluarga'] . ")";
	$query_warga_has_kartu_keluarga = mysqli_query($db, $sql_warga_has_kartu_keluarga);
}

$sql_mutasi = "INSERT INTO mutasi_masuk 
	(id_warga, id_keluarga, alamat_asal, alamat_tujuan, tanggal_pindah, alasan_pindah, jenis_kepindahan, agama_warga, pendidikan_terakhir_warga, pekerjaan_warga, rt_warga, rw_warga, desa_kelurahan_warga, kecamatan_warga, kabupaten_kota_warga, provinsi_warga) 
	VALUES
	('" . $id_warga . "', '" . $_SESSION['id_keluarga'] . "', '" . $_SESSION['alamat_asal'] . "', '" . $_SESSION['alamat_tujuan'] . "', '" . $_SESSION['tanggal_pindah'] . "', '" . $_SESSION['alasan_pindah'] . "', '" . $_SESSION['jenis_kepindahan'] . "', '" . $_SESSION['agama_warga'] . "', '" . $_SESSION['pendidikan_terakhir_warga'] . "', '" . $_SESSION['pekerjaan_warga'] . "', '" . $_SESSION['rt_warga'] . "', '" . $_SESSION['rw_warga'] . "', '" . $_SESSION['kelurahan'] . "', '" . $_SESSION['kecamatan'] . "', '" . $_SESSION['kokab'] . "', '" . $_SESSION['provinsi'] . "' );";
$query_mutasi = mysqli_query($db, $sql_mutasi);

//cek keberhasilan pendambahan data
if ($query_warga === TRUE && $query_mutasi === TRUE) {
	unset_session_form();
	$_SESSION['success'] = "Tambah Mutasi Masuk Warga Berhasil!";
	header("Location: index.php");
	exit();
} else {
	unset_session_form();
	$_SESSION['warning'] = "Tambah Mutasi Masuk Warga Gagal!";
	header("Location: index.php");
	exit();
}
