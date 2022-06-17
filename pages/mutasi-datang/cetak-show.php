<?php
define('FPDF_FONTPATH', '../../assets/lib/fpdf1.84/font/');
require_once("../../assets/lib/fpdf1.84/fpdf.php");
require '../helper_tanggal_indo.php';
require_once("../../config/koneksi.php");
require_once("../constant.php");

class PDF extends FPDF
{
  public function __construct()
  {
    parent::__construct();
  }

  // Page header
  function Header()
  {
    // Logo
    $this->Image('../../assets/img/' . LOGO, 20, 10);

    $this->AddFont('BOOKOS', '', 'BOOKOS.php');
    $this->AddFont('BOOKOS', 'B', 'BOOKOSB.php');
    $this->AddFont('BOOKOS', 'I', 'BOOKOSI.php');

    $this->SetFont('BOOKOS', 'B', 16);
    $this->Cell(200, 8, PRINT_KOKAB, 0, 1, 'C');
    $this->Cell(200, 10, PRINT_KECAMATAN, 0, 1, 'C');
    $this->Cell(200, 10, PRINT_DESA, 0, 1, 'C');

    $this->SetLineWidth(0.5);
    $this->Line(12, 40, 210 - 12, 40);
    $this->SetFont('BOOKOS', 'BU', 12);
    $this->Ln(3);
    $this->Cell(200, 8, 'DATA MUTASI DATANG', 0, 1, 'C');
    $this->Ln(3);
  }

  // Page footer
  function Footer()
  {
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('BOOKOS', 'I', 8);
    // Page number
    $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
  }
}

// ambil dari url
$id_mutasi_masuk = $_GET['id_mutasi_masuk'];
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
    id_mutasi_masuk = " . $id_mutasi_masuk . "
";
$query = mysqli_query($db, $sql);

$pdf = new PDF('P', 'mm', [210, 330]);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('BOOKOS', '', 10);

while ($row = mysqli_fetch_assoc($query)) {

  $pdf->SetFont('BOOKOS', '', 10);
  $pdf->cell(45, 7, 'Jenis Kepindahan', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(80, 7, $row['jenis_kepindahan'], 0, 1, 'L');

  $pdf->Ln(4);
  $pdf->SetFont('BOOKOS', 'B', 12);
  $pdf->cell(45, 7, strtoupper('Data Pribadi'), 0, 0, 'L');
  $pdf->Ln(8);
  $pdf->SetFont('BOOKOS', '', 10);

  if ($row['jenis_kepindahan'] == "Kepala Keluarga") {
    $pdf->cell(45, 7, 'Nomor Kartu Keluarga', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, $row['nomor_keluarga'], 0, 1, 'L');
  } elseif ($row['jenis_kepindahan'] == "Anggota Keluarga") {
    $pdf->cell(45, 7, 'Nomor Kartu Keluarga', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, $row['nomor_keluarga'], 0, 1, 'L');

    $pdf->cell(45, 7, 'Kepala Keluarga', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, "(" . $row['nik_kepala_keluarga'] . ") " . $row['nama_kepala_keluarga'], 0, 1, 'L');
  }

  $pdf->cell(45, 7, 'NIK Warga', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(80, 7, $row['nik_warga'], 0, 1, 'L');

  $pdf->cell(45, 7, 'Nama Warga', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(80, 7, $row['nama_warga'], 0, 1, 'L');

  $pdf->cell(45, 7, 'Tempat Lahir', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(80, 7, $row['tempat_lahir_warga'], 0, 1, 'L');

  $pdf->cell(45, 7, 'Tanggal Lahir', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(80, 7, tanggal_indo_no_dash($row['tanggal_lahir_warga']), 0, 1, 'L');

  $pdf->cell(45, 7, 'Jenis Kelamin', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(80, 7, ($row['jenis_kelamin_warga'] == "P") ? "Perempuan" : "Laki-laki", 0, 1, 'L');

  $pdf->cell(45, 7, 'Agama', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(20, 7, $row['agama_warga'], 0, 1, 'L');

  $pdf->cell(45, 7, 'Pendidikan Terakhir', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(16, 7, $row['pendidikan_terakhir_warga'], 0, 1, 'L');

  $pdf->cell(45, 7, 'Pekerjaan', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(20, 7, $row['pekerjaan_warga'], 0, 1, 'L');

  $pdf->Ln(4);
  $pdf->SetFont('BOOKOS', 'B', 12);
  $pdf->cell(45, 7, strtoupper('Data Daerah Tujuan'), 0, 0, 'L');
  $pdf->Ln(8);
  $pdf->SetFont('BOOKOS', '', 10);

  $pdf->cell(45, 7, 'Alamat Tujuan', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(80, 7, $row['alamat_tujuan'], 0, 1, 'L');

  $pdf->cell(45, 7, 'RT', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(7, 7, $row['rt_warga'], 0, 1, 'L');

  $pdf->cell(45, 7, 'RW', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(7, 7, $row['rw_warga'], 0, 1, 'L');

  $pdf->cell(45, 7, 'Desa/Kelurahan', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(80, 7, $row['desa_kelurahan_warga'], 0, 1, 'L');

  $pdf->cell(45, 7, 'Kecamatan', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(80, 7, $row['kecamatan_warga'], 0, 1, 'L');

  $pdf->cell(45, 7, 'Kabupaten/Kota', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(80, 7, $row['kabupaten_kota_warga'], 0, 1, 'L');

  $pdf->cell(45, 7, 'Provinsi', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(80, 7, $row['provinsi_warga'], 0, 1, 'L');

  $pdf->cell(45, 7, 'Negara', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(80, 7, $row['negara_warga'], 0, 1, 'L');

  $pdf->Ln(4);
  $pdf->SetFont('BOOKOS', 'B', 12);
  $pdf->cell(45, 7, strtoupper('Data Kepindahan'), 0, 0, 'L');
  $pdf->Ln(8);
  $pdf->SetFont('BOOKOS', '', 10);

  $pdf->cell(45, 7, 'Alamat Asal', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->MultiCell(140, 7, $row['alamat_asal'], 0, 'J', false);

  $pdf->cell(45, 7, 'Tanggal Pindah', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(80, 7, tanggal_indo_no_dash($row['tanggal_pindah']), 0, 1, 'L');

  $pdf->cell(45, 7, 'Alasan Pindah', 0, 0, 'L');
  $pdf->cell(2, 7, ':', 0, 0, 'L');
  $pdf->cell(80, 7, $row['alasan_pindah'], 0, 1, 'L');
}

$pdf->Ln(10);

$pdf->Output();
