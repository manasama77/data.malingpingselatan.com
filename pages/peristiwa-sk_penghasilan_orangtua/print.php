<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
require '../constant.php';

$id = $_GET['id'];

$sql = "
SELECT  
    sk_penghasilan_orangtua.id,
    sk_penghasilan_orangtua.orangtua_id,
    sk_penghasilan_orangtua.anak_id,
    sk_penghasilan_orangtua.penghasilan_orangtua,
    sk_penghasilan_orangtua.keperluan,
    sk_penghasilan_orangtua.tanggal_pelaporan,
    sk_penghasilan_orangtua.nama_kepala_desa,
    sk_penghasilan_orangtua.nrp,
    sk_penghasilan_orangtua.nomor_surat,
    
    orangtua.nama_warga as nama_orangtua,
    orangtua.nik_warga as nik_orangtua,
    orangtua.tempat_lahir_warga as tempat_lahir_orangtua,
    orangtua.tanggal_lahir_warga as tanggal_lahir_orangtua,
    orangtua.jenis_kelamin_warga as jenis_kelamin_orangtua,
    orangtua.negara_warga as negara_orangtua,
    orangtua.status_perkawinan as status_perkawinan_orangtua,
    orangtua.agama_warga as agama_orangtua,
    orangtua.pekerjaan_warga as pekerjaan_orangtua,
    orangtua.alamat_ktp_warga as alamat_ktp_orangtua,

    anak.nama_warga as nama_anak,
    anak.nik_warga as nik_anak,
    anak.tempat_lahir_warga as tempat_lahir_anak,
    anak.tanggal_lahir_warga as tanggal_lahir_anak,
    anak.jenis_kelamin_warga as jenis_kelamin_anak,
    anak.negara_warga as negara_anak,
    anak.status_perkawinan as status_perkawinan_anak,
    anak.agama_warga as agama_anak,
    anak.pekerjaan_warga as pekerjaan_anak,
    anak.alamat_ktp_warga as alamat_ktp_anak

FROM sk_penghasilan_orangtua 
LEFT JOIN warga as orangtua ON orangtua.id_warga = sk_penghasilan_orangtua.orangtua_id
LEFT JOIN warga AS anak ON anak.id_warga = sk_penghasilan_orangtua.anak_id
WHERE sk_penghasilan_orangtua.id = " . $id . "
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
                            <th colspan="3" class="h5 text-center">SURAT KETERANGAN PENGHASILAN</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="h6 text-center">Nomor : <?= $row_warga['nomor_surat']; ?></th>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Yang bertanda tangan dibawah ini <?= PERWAKILAN; ?> menerangkan dengan sebenarnya bahwa :
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 250px;">Nama Lengkap</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['nama_orangtua']; ?></td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_orangtua']; ?></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_lahir_orangtua']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_orangtua']); ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?= ($row_warga['jenis_kelamin_orangtua'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                        </tr>
                        <tr>
                            <td>Warganegara</td>
                            <td>:</td>
                            <td><?= $row_warga['negara_orangtua']; ?></td>
                        </tr>
                        <tr>
                            <td>Status Perkawinan</td>
                            <td>:</td>
                            <td><?= $row_warga['status_perkawinan_orangtua']; ?></td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td><?= $row_warga['agama_orangtua']; ?></td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan_orangtua']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat KTP</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_ktp_orangtua']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Berdasarkan pengakuan yang bersangkutan serta keterangan dari RT dan RW, yang bersangkutan berprofesi sebagai <?= $row_warga['pekerjaan_orangtua']; ?> dengan Penghasilan Rp. <?= number_format($row_warga['penghasilan_orangtua'], 0, ',', '.'); ?>,-/bulan. Nama tersebut adalah benar Orangtua /Wali dari :
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 250px;">Nama</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['nama_anak']; ?></td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_anak']; ?></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_lahir_anak']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_anak']); ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?= ($row_warga['jenis_kelamin_anak'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                        </tr>
                        <tr>
                            <td>Warganegara</td>
                            <td>:</td>
                            <td><?= $row_warga['negara_anak']; ?></td>
                        </tr>
                        <tr>
                            <td>Status Perkawinan</td>
                            <td>:</td>
                            <td><?= $row_warga['status_perkawinan_anak']; ?></td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td><?= $row_warga['agama_anak']; ?></td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan_anak']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_ktp_anak']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Keterangan ini dibuat untuk : <?= $row_warga['keperluan']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Demikian keterangan ini dibuat dengan sebenarnya dan kepada yang berkepentingan untuk dipergunakan seperlunya.
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
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 100px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-center">
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
                                        a.n Kepala Desa<br />
                                        Kepala Urusan Umum,
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 75px;">&nbsp;</td>
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