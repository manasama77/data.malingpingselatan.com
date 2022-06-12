<?php
define('FPDF_FONTPATH', '../../assets/lib/fpdf1.84/font/');
require_once("../../assets/lib/fpdf1.84/fpdf.php");
require '../helper_tanggal_indo.php';
require_once("../../config/koneksi.php");

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
        $this->Image('../../assets/img/kng.jpg', 20, 10);

        $this->AddFont('BOOKOS', '', 'BOOKOS.php');
        $this->AddFont('BOOKOS', 'B', 'BOOKOSB.php');
        $this->AddFont('BOOKOS', 'I', 'BOOKOSI.php');

        $this->SetFont('BOOKOS', 'B', 16);
        $this->Cell(200, 8, 'PEMERINTAH KOTA TANGERANG', 0, 1, 'C');
        $this->Cell(200, 10, 'KECAMATAN GEBANG RAYA', 0, 1, 'C');
        $this->Cell(200, 10, 'KELURAHAN PERIUK', 0, 1, 'C');

        $this->SetLineWidth(0.5);
        $this->Line(12, 40, 210 - 12, 40);
        $this->SetFont('BOOKOS', 'BU', 12);
        $this->Ln(3);
        $this->Cell(200, 8, 'DATA MUTASI KELUAR', 0, 1, 'C');
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
$id_mutasi_keluar = $_GET['id_mutasi_keluar'];
// ambil dari database
$sql   = "SELECT * FROM mutasi_keluar LEFT JOIN warga ON warga.id_warga = mutasi_keluar.id_warga WHERE id_mutasi_keluar = '" . $id_mutasi_keluar . "'";
$query = mysqli_query($db, $sql);

$pdf = new PDF('P', 'mm', [210, 330]);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('BOOKOS', '', 10);

while ($row = mysqli_fetch_assoc($query)) {

    $pdf->Ln(4);
    $pdf->SetFont('BOOKOS', 'B', 12);
    $pdf->cell(45, 7, strtoupper('Data Kepindahan'), 0, 0, 'L');
    $pdf->Ln(8);
    $pdf->SetFont('BOOKOS', '', 10);

    $pdf->cell(45, 7, 'NIK / Nama Pemohon', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, $row['nik_warga'], 0, 1, 'L');

    $pdf->cell(45, 7, 'Tanggal Pindah', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, tanggal_indo_no_dash($row['tanggal_pindah']), 0, 1, 'L');

    $pdf->cell(45, 7, 'alasan_pindah', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(20, 7, $row['alasan_pindah'], 0, 1, 'L');

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
    $pdf->cell(7, 7, $row['rt_tujuan'], 0, 1, 'L');

    $pdf->cell(45, 7, 'RW', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(7, 7, $row['rw_tujuan'], 0, 1, 'L');

    $pdf->cell(45, 7, 'Desa/Kelurahan', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, $row['desa_kelurahan_tujuan'], 0, 1, 'L');

    $pdf->cell(45, 7, 'Kecamatan', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, $row['kecamatan_tujuan'], 0, 1, 'L');

    $pdf->cell(45, 7, 'Kabupaten/Kota', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, $row['kabupaten_kota_tujuan'], 0, 1, 'L');

    $pdf->cell(45, 7, 'Provinsi', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, $row['provinsi_tujuan'], 0, 1, 'L');

    $pdf->cell(45, 7, 'Negara', 0, 0, 'L');
    $pdf->cell(2, 7, ':', 0, 0, 'L');
    $pdf->cell(80, 7, $row['negara_tujuan'], 0, 1, 'L');
}

$pdf->Ln(10);

$pdf->Output();
