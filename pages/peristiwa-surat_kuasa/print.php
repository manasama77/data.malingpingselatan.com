<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
require '../constant.php';

$id = $_GET['id'];

$sql = "
SELECT  
    surat_kuasa.id,
    surat_kuasa.warga_1_id,
    surat_kuasa.warga_2_id,
    surat_kuasa.tanggal_kuasa,
    surat_kuasa.keperluan,
    surat_kuasa.tanggal_pelaporan,
    surat_kuasa.saksi_1,
    surat_kuasa.saksi_2,
    surat_kuasa.saksi_3,
    surat_kuasa.nama_kepala_desa,
    surat_kuasa.nomor_surat,
    
    warga_1.nama_warga as nama_warga_1,
    warga_1.nik_warga as nik_warga_1,
    warga_1.tempat_lahir_warga as tempat_lahir_warga_1,
    warga_1.tanggal_lahir_warga as tanggal_lahir_warga_1,
    warga_1.jenis_kelamin_warga as jenis_kelamin_warga_1,
    warga_1.negara_warga as negara_warga_1,
    warga_1.status_perkawinan as status_perkawinan_warga_1,
    warga_1.agama_warga as agama_warga_1,
    warga_1.pekerjaan_warga as pekerjaan_warga_1,
    warga_1.alamat_ktp_warga as alamat_ktp_warga_1,

    warga_2.nama_warga as nama_warga_2,
    warga_2.nik_warga as nik_warga_2,
    warga_2.tempat_lahir_warga as tempat_lahir_warga_2,
    warga_2.tanggal_lahir_warga as tanggal_lahir_warga_2,
    warga_2.jenis_kelamin_warga as jenis_kelamin_warga_2,
    warga_2.negara_warga as negara_warga_2,
    warga_2.status_perkawinan as status_perkawinan_warga_2,
    warga_2.agama_warga as agama_warga_2,
    warga_2.pekerjaan_warga as pekerjaan_warga_2,
    warga_2.alamat_ktp_warga as alamat_ktp_warga_2

FROM surat_kuasa 
LEFT JOIN warga as warga_1 ON warga_1.id_warga = surat_kuasa.warga_1_id
LEFT JOIN warga AS warga_2 ON warga_2.id_warga = surat_kuasa.warga_2_id
WHERE surat_kuasa.id = " . $id . "
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
                            <th colspan="3" class="h5 text-center">SURAT KUASA</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="h6 text-center">Nomor : <?= $row_warga['nomor_surat']; ?></th>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Saya yang bertanda tangan dibawah ini :
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 250px;">Nama</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['nama_warga_1']; ?></td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_warga_1']; ?></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_lahir_warga_1']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_warga_1']); ?></td>
                        </tr>
                        <tr>
                            <td>Warganegara</td>
                            <td>:</td>
                            <td><?= $row_warga['negara_warga_1']; ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?= ($row_warga['jenis_kelamin_warga_1'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td><?= $row_warga['status_perkawinan_warga_1']; ?></td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan_warga_1']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_ktp_warga_1']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <?php
                                $tgl_obj = new DateTime($row_warga['tanggal_kuasa']);

                                $hari = hari_indo($tgl_obj->format('D'));
                                ?>
                                Pada hari ini <?= $hari; ?> tanggal <?= $tgl_obj->format('d'); ?> bulan <?= bulan_indo($tgl_obj->format('m')); ?> tahun <?= $tgl_obj->format('Y'); ?>, dengan ini menguasakan sepenuhnya kepada :
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 250px;">Nama</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['nama_warga_2']; ?></td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_warga_2']; ?></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_lahir_warga_2']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_warga_2']); ?></td>
                        </tr>
                        <tr>
                            <td>Warganegara</td>
                            <td>:</td>
                            <td><?= $row_warga['negara_warga_2']; ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?= ($row_warga['jenis_kelamin_warga_2'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td><?= $row_warga['status_perkawinan_warga_2']; ?></td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan_warga_2']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_ktp_warga_2']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Untuk maksud / tujuan / keperluan : <?= $row_warga['keperluan']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Demikian Surat Kuasa ini saya buat dalam keadaan sadar, sehat jasmani dan rohani serta tidak ada paksaan dari pihak manapun untuk dipergunakan sebagaimana mestinya. Apabila dikemudian hari Surat Kuasa ini terdapat kekeliruan, saya siap dituntut dimuka hukum atas nama pribadi.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-borderless table-condensed table-sm w-100 p-0">
                            <tbody>
                                <tr>
                                    <td class="text-center">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        Yang diberi kuasa,
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 100px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <?= $row_warga['nama_warga_2']; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-borderless table-condensed table-sm w-100 p-0">
                            <tbody>
                                <tr>
                                    <td class="text-center"><?= DESA; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_pelaporan']); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        Yang Memberi Kuasa
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 100px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <?= $row_warga['nama_warga_1']; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <div class="col-6">
                            <table class="table table-borderless table-condensed table-sm w-100 p-0">
                                <tbody>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>
                                            Saksi-saksi :
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1. </td>
                                        <td>
                                            <?= $row_warga['saksi_1']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2. </td>
                                        <td>
                                            <?= $row_warga['saksi_2']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3. </td>
                                        <td>
                                            <?= $row_warga['saksi_3']; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        Mengetahui :<br />
                        Nomor Register : <?= $row_warga['nomor_surat']; ?><br />
                        Kepala Desa<br />
                        <?= DESA; ?>,<br />
                        <div style="height: 100px;">&nbsp;</div>
                        <?= $row_warga['nama_kepala_desa']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>