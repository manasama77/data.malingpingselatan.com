<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
require '../constant.php';

$id = $_GET['id'];

$sql = "
SELECT
	*
FROM
	domisili
WHERE
	domisili.id = " . $id . "
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
            line-height: 1.5;
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
                <table class="table table-borderless table-condensed table-sm w-100 p-0" style="line-height: 0.9;">
                    <tbody>
                        <tr>
                            <th colspan="3" class="h5 text-center">SURAT KETERANGAN DOMISILI</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="h6 text-center">Nomor : <?= $row_warga['nomor_surat']; ?></th>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Yang bertanda tangan dibawah ini Kepala Desa <?= DESA; ?> menerangkan bahwa :
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>:</td>
                            <td><?= $row_warga['nama']; ?></td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $row_warga['nik']; ?></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td>
                                <?= $row_warga['tempat_lahir']; ?>,
                                <?php
                                $tgl_obj = new DateTime($row_warga['tanggal_lahir']);
                                echo $tgl_obj->format('d-m-Y');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Warga Negara</td>
                            <td>:</td>
                            <td>INDONESIA</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?= ($row_warga['jenis_kelamin'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td><?= $row_warga['agama']; ?></td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat KTP</td>
                            <td>:</td>
                            <td>
                                <?= $row_warga['alamat_ktp']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat Domisili</td>
                            <td>:</td>
                            <td>
                                <?= $row_warga['alamat_domisili']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Lama Domisili</td>
                            <td>:</td>
                            <td>
                                <?php
                                $tgl_obj_a = new DateTime($row_warga['tanggal_pembuatan']);
                                $tgl_obj_b = new DateTime($row_warga['lama_domisili']);
                                $inval = $tgl_obj_a->diff($tgl_obj_b);
                                echo $inval->y . " Tahun";
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-justify">
                                Berdasarkan Surat Pengantar dari Ketua RT dan RW, nama tersebut benar warga Desa <?= DESA; ?> dan Bertempat Tinggal (Berdomisili) di alamat tersebut diatas.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-justify">
                                Demikian keterangan ini dibuat atas dasar yang sebenarnya dan kepada yang berkepentingan agar dipergunakan sebagaimana mestinya. Keterangan ini berlaku sampai dengan : <?= tanggal_indo_no_dash($row_warga['lama_domisili']); ?>.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="3">
                                <div class="row">
                                    <div class="col-6 text-center"></div>
                                    <div class="col-6 text-center">
                                        <?= DESA; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_pembuatan']); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6"></div>
                                    <div class="col-6">
                                        <?= $row_warga['jabatan_ttd']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6" style="height: 100px;"></div>
                                    <div class="col-6" style="height: 100px;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-6"></div>
                                    <div class="col-6 font-weight-bold">
                                        <?= $row_warga['nama_ttd']; ?><br />
                                        <?= $row_warga['nomor_induk_ttd']; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>