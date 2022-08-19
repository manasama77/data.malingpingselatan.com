<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
require '../constant.php';

$id = $_GET['id'];

$sql = "
SELECT
    sk_hubungan_keluarga.id,
    sk_hubungan_keluarga.warga_id,
    sk_hubungan_keluarga.jenis_relasi,
    sk_hubungan_keluarga.keluarga_id,
    sk_hubungan_keluarga.keperluan,
    sk_hubungan_keluarga.tanggal_pelaporan,
    sk_hubungan_keluarga.nama_kepala_desa,
    sk_hubungan_keluarga.nrp,
    sk_hubungan_keluarga.nomor_surat,
    warga.nama_warga,
    warga.nik_warga,
    warga.tempat_lahir_warga,
    warga.tanggal_lahir_warga,
    warga.jenis_kelamin_warga,
    warga.negara_warga,
    warga.status_perkawinan,
    warga.agama_warga,
    warga.pekerjaan_warga,
    warga.alamat_warga,

    keluarga.nama_warga as nama_keluarga,
    keluarga.nik_warga as nik_keluarga,
    keluarga.tempat_lahir_warga as tempat_lahir_keluarga,
    keluarga.tanggal_lahir_warga as tanggal_lahir_keluarga,
    keluarga.jenis_kelamin_warga as jenis_kelamin_keluarga,
    keluarga.negara_warga as negara_keluarga,
    keluarga.status_perkawinan as status_perkawinan_keluarga,
    keluarga.agama_warga as agama_keluarga,
    keluarga.pekerjaan_warga as pekerjaan_keluarga,
    keluarga.alamat_warga as alamat_keluarga
FROM sk_hubungan_keluarga 
LEFT JOIN warga ON warga.id_warga = sk_hubungan_keluarga.warga_id
LEFT JOIN warga as keluarga ON keluarga.id_warga = sk_hubungan_keluarga.keluarga_id
WHERE
    sk_hubungan_keluarga.id = " . $id . "
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
                            <th colspan="3" class="h5 text-center">SURAT KETERANGAN HUBUNGAN KELUARGA</th>
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
                            <td style="width: 250px;">Nama (Pemohon)</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['nama_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>Nomor Induk Kependudukan</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>Tempat / Tanggal Lahir</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_lahir_warga']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_warga']); ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?= ($row_warga['jenis_kelamin_warga'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                        </tr>
                        <tr>
                            <td>Status Perkawinan</td>
                            <td>:</td>
                            <td><?= $row_warga['status_perkawinan']; ?></td>
                        </tr>
                        <tr>
                            <td>Warga Negara</td>
                            <td>:</td>
                            <td><?= $row_warga['negara_warga']; ?></td>
                        </tr>

                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td><?= $row_warga['agama_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>Pekerjaan Sekarang</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_warga']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="3">Nama tersebut yang tercantum diatas adalah benar penduduk desa kami yang mempunyai Hubungan Keluarga sebagai <?= $row_warga['jenis_relasi']; ?> dari :</td>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
                        </tr>
                        <tr>
                            <td style="width: 220px;">Nama</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['nama_keluarga']; ?></td>
                        </tr>
                        <tr>
                            <td>Nomor Induk Kependudukan</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_keluarga']; ?></td>
                        </tr>
                        <tr>
                            <td>Tempat / Tanggal Lahir</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_lahir_keluarga']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_keluarga']); ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?= ($row_warga['jenis_kelamin_keluarga'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                        </tr>
                        <tr>
                            <td>Status Perkawinan</td>
                            <td>:</td>
                            <td><?= $row_warga['status_perkawinan_keluarga']; ?></td>
                        </tr>
                        <tr>
                            <td>Warga Negara</td>
                            <td>:</td>
                            <td><?= $row_warga['negara_keluarga']; ?></td>
                        </tr>

                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td><?= $row_warga['agama_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>Pekerjaan Sekarang</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_warga']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Surat Keterangan ini diberikan untuk keperluan sebagai syarat untuk : <?= $row_warga['keperluan']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Demikian Surat Keterangan ini kami buat dengan sebenarnya dan dapat dipergunakan sebagaimana mestinya.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
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