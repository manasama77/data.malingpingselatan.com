<?php

use Mpdf\Mpdf;

require_once '../../vendor/autoload.php';
require_once "../../config/koneksi.php";

if (!$_GET['id_keluarga']) {
    die("[400] Bad Request - ID Keluarga");
}

$id_keluarga = $_GET['id_keluarga'];


$mpdf = new Mpdf([
    'mode'              => 'c',
    'format'            => 'A4',
    'orientation'       => 'L',
    'default_font_size' => '6',
    'default_font'      => 'Helvetica',
    'margin_top'        => 44,
]);

// HEADER
$header = '
<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: top; font-family: Helvetica; font-size: 18pt;">
    <tr>
        <td width="33%">
            <img src="../../assets/img/logo.png" style="position: fixed; left: 10;" />
        </td>
        <td width="33%" align="center">
        <p style="line-height: 28pt;">
            Pemerintah Kabupaten Lebak<br />
            Kecamatan Malingping<br />
            Desa Malingping Selatan
        </p>
        </td>
        <td width="33%" style="text-align: right;"></td>
    </tr>
</table>
';
$mpdf->SetHTMLHeader($header);

// FOOTER
$footer = '<div align="center">Page{nb} / {nbpg}</div>';
$mpdf->SetHTMLFooter($footer);

// CONTENT 1
$query = "SELECT * FROM kartu_keluarga LEFT JOIN warga ON kartu_keluarga.id_kepala_keluarga = warga.id_warga WHERE id_keluarga = $id_keluarga";
$hasil = mysqli_query($db, $query);
$data_keluarga = array();

$content1 = '<table border="0" style="font-size: 10pt; width: 100%; vertical-align: top;"><tbody>';
$no_kk = '';
while ($row = mysqli_fetch_assoc($hasil)) {
    $no_kk = $row['nomor_keluarga'];
    $content1 .= '<tr>';
    $content1 .= '<td style="width: 14%;">Nomor Kartu Keluarga</td>';
    $content1 .= '<td style="width: 3%; text-align: center;">:</td>';
    $content1 .= '<td style="width: 25%;">' . $row['nomor_keluarga'] . '</td>';
    $content1 .= '<td style="width: 27%;">&nbsp;&nbsp;</td>';
    $content1 .= '<td style="width: 12%;">Kabupaten/Kota</td>';
    $content1 .= '<td style="width: 3%; text-align: center;">:</td>';
    $content1 .= '<td style="width: 15%;">' . $row['kabupaten_kota_keluarga'] . '</td>';
    $content1 .= '</tr>';

    $content1 .= '<tr>';
    $content1 .= '<td>Kepala Keluarga</td>';
    $content1 .= '<td style="text-align: center;">:</td>';
    $content1 .= '<td>' . $row['nama_warga'] . '</td>';
    $content1 .= '<td>&nbsp;&nbsp;</td>';
    $content1 .= '<td>Provinsi</td>';
    $content1 .= '<td style="text-align: center;">:</td>';
    $content1 .= '<td>' . $row['provinsi_keluarga'] . '</td>';
    $content1 .= '</tr>';

    $content1 .= '<tr>';
    $content1 .= '<td>NIK Kepala Keluarga</td>';
    $content1 .= '<td style="text-align: center;">:</td>';
    $content1 .= '<td>' . $row['nik_warga'] . '</td>';
    $content1 .= '<td>&nbsp;&nbsp;</td>';
    $content1 .= '<td>Negara</td>';
    $content1 .= '<td style="text-align: center;">:</td>';
    $content1 .= '<td>' . $row['negara_keluarga'] . '</td>';
    $content1 .= '</tr>';

    $content1 .= '<tr>';
    $content1 .= '<td>Alamat</td>';
    $content1 .= '<td style="text-align: center;">:</td>';
    $content1 .= '<td>' . $row['alamat_keluarga'] . '</td>';
    $content1 .= '<td>&nbsp;&nbsp;</td>';
    $content1 .= '<td>Desa/Kelurahan</td>';
    $content1 .= '<td style="text-align: center;">:</td>';
    $content1 .= '<td>' . $row['desa_kelurahan_keluarga'] . '</td>';
    $content1 .= '</tr>';

    $content1 .= '<tr>';
    $content1 .= '<td>RT</td>';
    $content1 .= '<td style="text-align: center;">:</td>';
    $content1 .= '<td>' . $row['rt_keluarga'] . '</td>';
    $content1 .= '<td>&nbsp;&nbsp;</td>';
    $content1 .= '<td>Kecamatan</td>';
    $content1 .= '<td style="text-align: center;">:</td>';
    $content1 .= '<td>' . $row['kecamatan_keluarga'] . '</td>';
    $content1 .= '</tr>';

    $content1 .= '<tr>';
    $content1 .= '<td>RW</td>';
    $content1 .= '<td style="text-align: center;">:</td>';
    $content1 .= '<td>' . $row['rw_keluarga'] . '</td>';
    $content1 .= '<td>&nbsp;&nbsp;</td>';
    $content1 .= '<td></td>';
    $content1 .= '<td style="text-align: center;"></td>';
    $content1 .= '<td></td>';
    $content1 .= '</tr>';
}
$content1 .= '</tbody></table>';
$mpdf->WriteHTML($content1);

// CONTENT 2
$content2 = '<h2>DATA ANGGOTA</h2>';
$mpdf->WriteHTML($content2);

// CONTENT 3
$content3 = '
<table border="1" cellpadding="5" style="font-size: 8pt;width: 100%; vertical-align: top; border-collapse: collapse;">
    <thead>
        <tr>
            <th>NO</th>
            <th>NIK</th>
            <th>NAMA</th>
            <th>TEMPAT LAHIR</th>
            <th>TGL LHR</th>
            <th>JK</th>
            <th>ALAMAT</th>
            <th>RT</th>
            <th>AGAMA</th>
            <th>PENDIDIKAN</th>
            <th>PEKERJAAN</th>
            <th>STATUS</th>
        </tr>
    </thead>
    <tbody>
';

$query_anggota = "SELECT *
from warga INNER JOIN warga_has_kartu_keluarga
ON warga_has_kartu_keluarga.id_warga = warga.id_warga
WHERE warga_has_kartu_keluarga.id_keluarga = $id_keluarga";

$hasil_anggota = mysqli_query($db, $query_anggota);

$no = 1;
while ($row_anggota = mysqli_fetch_assoc($hasil_anggota)) {
    $tgl_lahir_warga = '';
    if ($row_anggota['tanggal_lahir_warga'] != '0000-00-00' || $row_anggota['tanggal_lahir_warga'] != '') {
        $tgl_obj = new DateTime($row_anggota['tanggal_lahir_warga']);
        $tgl_lahir_warga = $tgl_obj->format('d-m-Y');
    }
    $content3 .= '
    <tr>
        <td>' . $no++ . '</td>
        <td>' . $row_anggota['nik_warga'] . '</td>
        <td>' . $row_anggota['nama_warga'] . '</td>
        <td>' . $row_anggota['tempat_lahir_warga'] . '</td>
        <td>' . $tgl_lahir_warga . '</td>
        <td>' . strtoupper($row_anggota['jenis_kelamin_warga']) . '</td>
        <td>' . $row_anggota['alamat_warga'] . '</td>
        <td>' . $row_anggota['rt_warga'] . '</td>
        <td>' . $row_anggota['rw_warga'] . '</td>
        <td>' . $row_anggota['pendidikan_terakhir_warga'] . '</td>
        <td>' . $row_anggota['pekerjaan_warga'] . '</td>
        <td>' . $row_anggota['status_warga'] . '</td>
    </tr>
    ';
}

$content3 .= '</tbody></table>';
$mpdf->WriteHTML($content3);

$mpdf->Output('KK-' . $no_kk . '.pdf', "I");
