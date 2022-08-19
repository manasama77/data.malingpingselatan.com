<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
require '../constant.php';

$id = $_GET['id'];

$sql = "
SELECT
    sk_izin_keluarga.id,
    sk_izin_keluarga.warga_id,
    sk_izin_keluarga.jenis_relasi,
    sk_izin_keluarga.keluarga_id,
    sk_izin_keluarga.keperluan,
    sk_izin_keluarga.tanggal_pelaporan,
    sk_izin_keluarga.nama_kepala_desa,
    sk_izin_keluarga.nrp,
    sk_izin_keluarga.nomor_surat,
    warga.nama_warga,
    warga.nik_warga,
    warga.tempat_lahir_warga,
    warga.tanggal_lahir_warga,
    warga.jenis_kelamin_warga,
    warga.negara_warga,
    warga.status_perkawinan,
    warga.agama_warga,
    warga.pekerjaan_warga,
    warga.alamat_ktp_warga,

    keluarga.nama_warga as nama_keluarga,
    keluarga.nik_warga as nik_keluarga,
    keluarga.tempat_lahir_warga as tempat_lahir_keluarga,
    keluarga.tanggal_lahir_warga as tanggal_lahir_keluarga,
    keluarga.jenis_kelamin_warga as jenis_kelamin_keluarga,
    keluarga.negara_warga as negara_keluarga,
    keluarga.status_perkawinan as status_perkawinan_keluarga,
    keluarga.agama_warga as agama_keluarga,
    keluarga.pekerjaan_warga as pekerjaan_keluarga,
    keluarga.alamat_ktp_warga as alamat_ktp_keluarga
FROM sk_izin_keluarga 
LEFT JOIN warga ON warga.id_warga = sk_izin_keluarga.warga_id
LEFT JOIN warga as keluarga ON keluarga.id_warga = sk_izin_keluarga.keluarga_id
WHERE
    sk_izin_keluarga.id = " . $id . "
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
                            <th colspan="4" class="h5 text-center">SURAT KETERANGAN IZIN <?= strtoupper($row_warga['jenis_relasi']); ?></th>
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
                            <td style="width: 10px;">1.</td>
                            <td style="width: 250px;">Nama Lengkap (Pemohon)</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['nama_warga']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_warga']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_lahir_warga']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_warga']); ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?= ($row_warga['jenis_kelamin_warga'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Warganegara</td>
                            <td>:</td>
                            <td><?= $row_warga['negara_warga']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Status Perkawinan</td>
                            <td>:</td>
                            <td><?= $row_warga['status_perkawinan']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Agama</td>
                            <td>:</td>
                            <td><?= $row_warga['agama_warga']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan_warga']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Alamat KTP</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_ktp_warga']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="4">Nama tersebut diatas benar telah memberikan izin kepada <?= $row_warga['jenis_relasi']; ?> :</td>
                        </tr>
                        <tr>
                            <td colspan="4"><br /></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td style="width: 220px;">Nama Lengkap</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['nama_keluarga']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_keluarga']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_lahir_keluarga']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_keluarga']); ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?= ($row_warga['jenis_kelamin_keluarga'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Warganegara</td>
                            <td>:</td>
                            <td><?= $row_warga['negara_keluarga']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Status Perkawinan</td>
                            <td>:</td>
                            <td><?= $row_warga['status_perkawinan_keluarga']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Agama</td>
                            <td>:</td>
                            <td><?= $row_warga['agama_keluarga']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan_keluarga']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Alamat KTP</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_ktp_keluarga']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                Untuk : <?= $row_warga['keperluan']; ?>.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                Keterangan ini dibuat berdasarkan surat pernyataan Pemohon dan segala akibat yang timbul dikemudian hari dari pembuatan dan penggunaan surat keterangan ini, sepenuhnya menjadi tanggung jawab Pemohon, baik secara hukum ataupun secara moril dan materil tanpa melibatkan pihak lainnya.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                Demikian keterangan ini dibuat dengan sebenarnya untuk dipergunakan seperlunya.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"><br /></td>
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
                                        Pemohon,
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 100px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <?= $row_warga['nama_warga']; ?>
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