<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
require '../constant.php';

$id = $_GET['id'];

$sql = "
SELECT
    sk_domisili_lembaga.id,
    sk_domisili_lembaga.jenis_lembaga,
    sk_domisili_lembaga.nama_lembaga,
    sk_domisili_lembaga.alamat,
    sk_domisili_lembaga.tahun_pendirian,
    sk_domisili_lembaga.sk_pendirian,
    sk_domisili_lembaga.jumlah_pegawai,
    sk_domisili_lembaga.pengurus,
    sk_domisili_lembaga.pimpinan,
    sk_domisili_lembaga.sekertaris,
    sk_domisili_lembaga.bendahara,
    sk_domisili_lembaga.masa_berlaku,
    sk_domisili_lembaga.tanggal_pembuatan,
    sk_domisili_lembaga.nomor_surat,
    sk_domisili_lembaga.nama_kepala_desa,
    sk_domisili_lembaga.nrp
FROM
sk_domisili_lembaga
WHERE
    sk_domisili_lembaga.id = " . $id . "
";
$query_warga = mysqli_query($db, $sql);
if (mysqli_num_rows($query_warga) == 0) {
    die("Data Warga Tidak Ditemukan");
} else {
    $row_warga = mysqli_fetch_assoc($query_warga);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Print</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link href="https://www.dafontfree.net/embed/Ym9va21hbi1vbGQtc3R5bGUtcmVndWxhciZkYXRhLzQ2L2IvNTk0NjEvYm9va21hbiBvbGQgc3R5bGUudHRm" rel="stylesheet" type="text/css" />
    <style>
        @font-face {
            font-family: bookman;
            src: url(../BOOKOS.TTF)
        }

        * {
            font-family: bookman, sans-serif;
        }
    </style>
</head>

<body onload="window.print();">

    <!-- <body> -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php include('../_partials/print_header.php'); ?>
                <hr style="border-top: 5px solid black;" />
                <table class="table table-borderless table-condensed table-sm w-100 p-0">
                    <tbody>
                        <tr>
                            <th colspan="4" class="h5 text-center">SURAT KETERANGAN DOMISILI</th>
                        </tr>
                        <tr>
                            <th colspan="4" class="h6 text-center">Nomor : <?= $row_warga['nomor_surat']; ?></th>
                        </tr>
                        <tr>
                            <td colspan="4"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                Yang bertanda tangan dibawah ini <?= PERWAKILAN; ?> menerangkan bahwa :
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 5px;">1. </td>
                            <td style="width: 220px;">Nama</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['nama_lembaga']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tahun Pendirian</td>
                            <td>:</td>
                            <td><?= $row_warga['tahun_pendirian']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>SK Pendirian</td>
                            <td>:</td>
                            <td><?= $row_warga['sk_pendirian']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Jumlah Pegawai</td>
                            <td>:</td>
                            <td><?= $row_warga['jumlah_pegawai']; ?></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Pengurus</td>
                            <td>:</td>
                            <td><?= $row_warga['pengurus']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pimpinan/Kepala/Ketua</td>
                            <td>:</td>
                            <td><?= $row_warga['pimpinan']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Sekertaris</td>
                            <td>:</td>
                            <td><?= $row_warga['sekertaris']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Bendahara</td>
                            <td>:</td>
                            <td><?= $row_warga['bendahara']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="4">Bahwa <b><?= $row_warga['jenis_lembaga']; ?></b> tersebut benar berada/berdomisili di wilayah Desa <?= DESA; ?> dan beralamat tersebut diatas.</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                Demikian keterangan ini dibuat atas dasar yang sebenarnya dan kepada yang berkepentingan agar dapat dipergunakan sebagaimana mestinya.
                                Keterangan ini berlaku sampai dengan : <b><?= tanggal_indo_no_dash($row_warga['masa_berlaku']); ?></b>.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"><br /></td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <table class="table table-borderless table-condensed table-sm w-100 p-0">
                            <tbody>
                                <tr>
                                    <td class="text-center"><?= DESA; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_pembuatan']); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        a.n. Kepala Desa<br />
                                        Kepala Desa,
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 100px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <?= $row_warga['nama_kepala_desa']; ?><br />
                                        NRPDes. <?= $row_warga['nrp']; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>