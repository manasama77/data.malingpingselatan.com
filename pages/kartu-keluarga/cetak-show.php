<?php
require_once("../../assets/lib/fpdf184/fpdf.php");
require_once("../../config/koneksi.php");

class PDF extends FPDF
{
  // Page header
  function Header()
  {
    // Logo
    $this->Image('../../assets/img/logo.png', 20, 10);

    // Arial bold 15
    $this->SetFont('Times', 'B', 15);
    // Move to the right
    // $this->Cell(60);
    // Title
    $this->Cell(308, 8, 'Pemerintah Kabupaten Lebak', 0, 1, 'C');
    $this->Cell(308, 8, 'Kecamatan Malingping', 0, 1, 'C');
    $this->Cell(308, 8, 'Kelurahan Malingping Selatan', 0, 1, 'C');
    // Line break
    $this->Ln(5);

    $this->SetFont('Times', 'BU', 12);
    for ($i = 0; $i < 10; $i++) {
      $this->Cell(308, 0, '', 1, 1, 'C');
    }

    $this->Ln(1);

    $this->Cell(308, 8, 'DATA KARTU KELUARGA', 0, 1, 'C');
    $this->Ln(2);

    $this->SetFont('Times', 'B', 9.5);
  }

  // Page footer
  function Footer()
  {
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial', 'I', 8);
    // Page number
    $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
  }

  //wordwrap
  function WordWrap(&$text, $maxwidth)
  {
    $text = trim($text);
    if ($text === '')
      return 0;
    $space = $this->GetStringWidth(' ');
    $lines = explode("\n", $text);
    $text = '';
    $count = 0;

    foreach ($lines as $line) {
      $words = preg_split('/ +/', $line);
      $width = 0;

      foreach ($words as $word) {
        $wordwidth = $this->GetStringWidth($word);
        if ($wordwidth > $maxwidth) {
          // Word is too long, we cut it
          for ($i = 0; $i < strlen($word); $i++) {
            $wordwidth = $this->GetStringWidth(substr($word, $i, 1));
            if ($width + $wordwidth <= $maxwidth) {
              $width += $wordwidth;
              $text .= substr($word, $i, 1);
            } else {
              $width = $wordwidth;
              $text = rtrim($text) . "\n" . substr($word, $i, 1);
              $count++;
            }
          }
        } elseif ($width + $wordwidth <= $maxwidth) {
          $width += $wordwidth + $space;
          $text .= $word . ' ';
        } else {
          $width = $wordwidth + $space;
          $text = rtrim($text) . "\n" . $word . ' ';
          $count++;
        }
      }
      $text = rtrim($text) . "\n";
      $count++;
    }
    $text = rtrim($text);
    return $count;
  }
}

// ambil dari url
$get_id_keluarga = $_GET['id_keluarga'];

// ambil dari database
$query = "SELECT * FROM kartu_keluarga LEFT JOIN warga ON kartu_keluarga.id_kepala_keluarga = warga.id_warga WHERE id_keluarga = $get_id_keluarga";

$hasil = mysqli_query($db, $query);

$data_keluarga = array();

while ($row = mysqli_fetch_assoc($hasil)) {
  $data_keluarga[] = $row;
}

// ambil data anggota keluarga
$query_anggota = "SELECT *
from warga INNER JOIN warga_has_kartu_keluarga
ON warga_has_kartu_keluarga.id_warga = warga.id_warga
WHERE warga_has_kartu_keluarga.id_keluarga = $get_id_keluarga";

$hasil_anggota = mysqli_query($db, $query_anggota);

$data_anggota_keluarga = array();

while ($row_anggota = mysqli_fetch_assoc($hasil_anggota)) {
  $data_anggota_keluarga[] = $row_anggota;
}

// data warga
// ambil dari database
$query_warga = "SELECT * FROM warga";
$hasil_warga = mysqli_query($db, $query_warga);

$data_warga = array();

while ($row_warga = mysqli_fetch_assoc($hasil_warga)) {
  $data_warga[] = $row_warga;
}

$pdf = new PDF('L', 'mm', [210, 330]);
$pdf->AliasNbPages();
$pdf->AddPage();

// set font
$pdf->SetFont('Times', '', 12);


// set penomoran
$nomor = 1;
$pdf->cell(45, 7, 'Nomor Kartu Keluarga', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, strtoupper($data_keluarga[0]['nomor_keluarga']), 0, 1, 'L');

$pdf->cell(45, 7, 'Kepala Keluarga', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_keluarga[0]['nama_warga']), 0, 17), 0, 1, 'L');

$pdf->cell(45, 7, 'NIK Kepala Keluarga', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, strtoupper($data_keluarga[0]['nik_warga']), 0, 1, 'L');


$pdf->cell(45, 7, 'Alamat', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_keluarga[0]['alamat_keluarga']), 0, 20), 0, 1, 'L');

$pdf->cell(45, 7, 'Desa/Kelurahan', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_keluarga[0]['desa_kelurahan_keluarga']), 0, 20), 0, 1, 'L');

$pdf->cell(45, 7, 'Kecamatan', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_keluarga[0]['kecamatan_keluarga']), 0, 20), 0, 1, 'L');

$pdf->cell(45, 7, 'Kabupaten/Kota', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_keluarga[0]['kabupaten_kota_keluarga']), 0, 20), 0, 1, 'L');

$pdf->cell(45, 7, 'Provinsi', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_keluarga[0]['provinsi_keluarga']), 0, 20), 0, 1, 'L');

$pdf->cell(45, 7, 'Negara', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_keluarga[0]['negara_keluarga']), 0, 20), 0, 1, 'L');

$pdf->cell(45, 7, 'RT', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(7, 7, strtoupper($data_keluarga[0]['rt_keluarga']), 0, 1, 'L');

$pdf->cell(45, 7, 'RW', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(7, 7, strtoupper($data_keluarga[0]['rw_keluarga']), 0, 1, 'L');

$pdf->Ln(10);

$pdf->Cell(308, 8, 'DATA ANGGOTA', 0, 1, 'L');

$pdf->SetFont('Times', 'B', 9.5);

// header tabel
$pdf->cell(8, 7, 'NO.', 1, 0, 'C');
$pdf->cell(27, 7, 'NIK', 1, 0, 'C');
$pdf->cell(44, 7, 'NAMA', 1, 0, 'C');
$pdf->cell(30, 7, 'TEMPAT LHR', 1, 0, 'C');
$pdf->cell(20, 7, 'TGL. LHR', 1, 0, 'C');
$pdf->cell(8, 7, 'JK', 1, 0, 'C');
$pdf->cell(50, 7, 'ALAMAT', 1, 0, 'C');
$pdf->cell(7, 7, 'RT', 1, 0, 'C');
$pdf->cell(7, 7, 'RW', 1, 0, 'C');
$pdf->cell(20, 7, 'AGAMA', 1, 0, 'C');
// $pdf->cell(26, 7, 'PERNIKAHAN', 1, 0, 'C');
$pdf->cell(28, 7, 'PDDKN', 1, 0, 'C');
$pdf->cell(28, 7, 'KERJA', 1, 0, 'C');
$pdf->cell(24, 7, 'STATUS', 1, 1, 'C');

// set font
$pdf->SetFont('Times', '', 9);

// set penomoran
$nomor = 1;

foreach ($data_anggota_keluarga as $anggota_keluarga) {
  $pdf->cell(8, 14, $nomor++ . '.', 1, 0, 'C');
  $pdf->cell(27, 14, strtoupper($anggota_keluarga['nik_warga']), 1, 0, 'C');
  $pdf->cell(44, 14, substr(strtoupper($anggota_keluarga['nama_warga']), 0, 17), 1, 0, 'L');
  $pdf->cell(30, 14, strtoupper($anggota_keluarga['tempat_lahir_warga']), 1, 0, 'L');
  $pdf->cell(20, 14, ($anggota_keluarga['tanggal_lahir_warga'] != '0000-00-00') ? date('d-m-Y', strtotime($anggota_keluarga['tanggal_lahir_warga'])) : '', 1, 0, 'C');
  $pdf->cell(8, 14, substr(strtoupper($anggota_keluarga['jenis_kelamin_warga']), 0, 1), 1, 0, 'C');
  $pdf->cell(50, 14, substr(strtoupper($anggota_keluarga['alamat_warga']), 0, 20), 1, 0, 'L');
  $pdf->cell(7, 14, strtoupper($anggota_keluarga['rt_warga']), 1, 0, 'C');
  $pdf->cell(7, 14, strtoupper($anggota_keluarga['rw_warga']), 1, 0, 'C');
  $pdf->cell(20, 14, strtoupper($anggota_keluarga['agama_warga']), 1, 0, 'C');
  // $pdf->cell(26, 7, strtoupper($anggota_keluarga['status_perkawinan_warga']), 1, 0, 'C');
  $pdf->cell(28, 14, strtoupper($anggota_keluarga['pendidikan_terakhir_warga']), 1, 0, 'C');
  $pdf->MultiCell(28, 7, strtoupper($anggota_keluarga['pekerjaan_warga']), 1, 'J', false);
  // $pdf->cell(24, 7, strtoupper($anggota_keluarga['status_warga']), 1, 1, 'C');
  // $pdf->cell(24, 7, strtoupper($anggota_keluarga['status_warga']), 1, 1, 'C');
  $pdf->MultiCell(15, 7, strtoupper($anggota_keluarga['status_warga']), 1, 'J', false);
}

$pdf->Output();
