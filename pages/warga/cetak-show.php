<?php
require_once("../../assets/lib/fpdf/fpdf.php");
require_once("../../config/koneksi.php");
require('../constant.php');
require '../helper_tanggal_indo.php';

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('../../assets/img/' . LOGO, 20, 10);

        // Arial bold 15
        $this->SetFont('Times', 'B', 15);
        // Move to the right
        // $this->Cell(60);
        // Title
        $this->Cell(200, 8, PRINT_KOKAB, 0, 1, 'C');
        $this->Cell(200, 8, PRINT_KECAMATAN, 0, 1, 'C');
        $this->Cell(200, 8, PRINT_DESA, 0, 1, 'C');
        // Line break
        $this->Ln(5);

        $this->SetFont('Times', 'BU', 12);
        for ($i = 0; $i < 10; $i++) {
            $this->Cell(308, 0, '', 1, 1, 'C');
        }

        $this->Ln(1);

        $this->Cell(200, 8, 'DATA WARGA', 0, 1, 'C');
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
$get_id_warga = $_GET['id_warga'];
// ambil dari database
$query = "SELECT * FROM warga WHERE id_warga = $get_id_warga";
$hasil = mysqli_query($db, $query);
$data_warga = array();
while ($row = mysqli_fetch_assoc($hasil)) {
    $data_warga[] = $row;
}


$pdf = new PDF('P', 'mm', [210, 330]);
$pdf->AliasNbPages();
$pdf->AddPage();

// set font
$pdf->SetFont('Times', '', 12);

// set penomoran
$nomor = 1;
$pdf->cell(45, 7, 'NIK', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, strtoupper($data_warga[0]['nik_warga']), 0, 1, 'L');

$pdf->cell(45, 7, 'Nama', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_warga[0]['nama_warga']), 0, 17), 0, 1, 'L');

$pdf->cell(45, 7, 'Tempat Lahir', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, strtoupper($data_warga[0]['tempat_lahir_warga']), 0, 1, 'L');

$pdf->cell(45, 7, 'Tanggal Lahir', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, ($data_warga[0]['tanggal_lahir_warga'] != '0000-00-00') ? date('d-m-Y', strtotime($data_warga[0]['tanggal_lahir_warga'])) : '', 0, 1, 'L');

$pdf->cell(45, 7, 'Golongan Darah', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, $data_warga[0]['golongan_darah'], 0, 1, 'L');

$pdf->cell(45, 7, 'Jenis Kelamin', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_warga[0]['jenis_kelamin_warga']), 0, 1), 0, 1, 'L');

$pdf->cell(45, 7, 'Alamat KTP', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_warga[0]['alamat_ktp_warga']), 0, 20), 0, 1, 'L');

$pdf->cell(45, 7, 'Alamat', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_warga[0]['alamat_warga']), 0, 20), 0, 1, 'L');

$pdf->cell(45, 7, 'Desa/Kelurahan', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_warga[0]['desa_kelurahan_warga']), 0, 20), 0, 1, 'L');

$pdf->cell(45, 7, 'Kecamatan', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_warga[0]['kecamatan_warga']), 0, 20), 0, 1, 'L');

$pdf->cell(45, 7, 'Kabupaten/Kota', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_warga[0]['kabupaten_kota_warga']), 0, 20), 0, 1, 'L');

$pdf->cell(45, 7, 'Provinsi', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_warga[0]['provinsi_warga']), 0, 20), 0, 1, 'L');

$pdf->cell(45, 7, 'Negara', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, substr(strtoupper($data_warga[0]['negara_warga']), 0, 20), 0, 1, 'L');

$pdf->cell(45, 7, 'RT', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(7, 7, strtoupper($data_warga[0]['rt_warga']), 0, 1, 'L');

$pdf->cell(45, 7, 'RW', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(7, 7, strtoupper($data_warga[0]['rw_warga']), 0, 1, 'L');

$pdf->cell(45, 7, 'Agama', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(20, 7, strtoupper($data_warga[0]['agama_warga']), 0, 1, 'L');

$pdf->cell(45, 7, 'Pendidikan', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(16, 7, strtoupper($data_warga[0]['pendidikan_terakhir_warga']), 0, 1, 'L');

$pdf->cell(45, 7, 'Pekerjaan', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(20, 7, strtoupper($data_warga[0]['pekerjaan_warga']), 0, 1, 'L');

// $pdf->cell(45, 7, 'Kawin/Tidak Kawin', 0, 0, 'L');
// $pdf->cell(2, 7, ':', 0, 0, 'L');
// $pdf->cell(26, 7, strtoupper($data_warga[0]['status_perkawinan_warga']), 0, 1, 'L');

$pdf->cell(45, 7, 'Status Kependudukan', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(24, 7, strtoupper($data_warga[0]['status_warga']), 0, 1, 'L');

$pdf->cell(45, 7, 'Status Perkawinan', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, $data_warga[0]['status_perkawinan'], 0, 1, 'L');

$pdf->cell(45, 7, 'Tanggal Perkawinan', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, tanggal_indo_no_dash($data_warga[0]['tanggal_perkawinan']), 0, 1, 'L');

$pdf->cell(45, 7, 'Nama Ayah', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, $data_warga[0]['nama_ayah'], 0, 1, 'L');

$pdf->cell(45, 7, 'Nama Ibu', 0, 0, 'L');
$pdf->cell(2, 7, ':', 0, 0, 'L');
$pdf->cell(80, 7, $data_warga[0]['nama_ibu'], 0, 1, 'L');

$pdf->Ln(10);

$pdf->Output();
