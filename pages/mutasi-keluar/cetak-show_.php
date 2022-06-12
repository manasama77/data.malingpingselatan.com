<?php
define('FPDF_FONTPATH', '../../assets/lib/fpdf1.84/font/');
require_once("../../assets/lib/fpdf1.84/fpdf.php");
require '../helper_tanggal_indo.php';
require_once("../../config/koneksi.php");
echo "a";
exit;

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
echo $sql;
exit;
$query = mysqli_query($db, $sql);

$pdf = new PDF('P', 'mm', [210, 330]);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('BOOKOS', '', 10);



$pdf->Ln(10);

$pdf->Output();
