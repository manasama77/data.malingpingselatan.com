<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
require '../constant.php';

$id = $_GET['id'];

$sql = "
SELECT
    permohonan_perubahan_data_penduduk.id,
    permohonan_perubahan_data_penduduk.warga_id,
    permohonan_perubahan_data_penduduk.nama_from,
    permohonan_perubahan_data_penduduk.nik_from,
    permohonan_perubahan_data_penduduk.tempat_lahir_from,
    permohonan_perubahan_data_penduduk.tanggal_lahir_from,
    permohonan_perubahan_data_penduduk.jenis_kelamin_from,
    permohonan_perubahan_data_penduduk.warganegara_from,
    permohonan_perubahan_data_penduduk.status_perkawinan_from,
    permohonan_perubahan_data_penduduk.agama_from,
    permohonan_perubahan_data_penduduk.pekerjaan_from,
    permohonan_perubahan_data_penduduk.alamat_from,
    permohonan_perubahan_data_penduduk.nama_to,
    permohonan_perubahan_data_penduduk.nik_to,
    permohonan_perubahan_data_penduduk.tempat_lahir_to,
    permohonan_perubahan_data_penduduk.tanggal_lahir_to,
    permohonan_perubahan_data_penduduk.jenis_kelamin_to,
    permohonan_perubahan_data_penduduk.warganegara_to,
    permohonan_perubahan_data_penduduk.status_perkawinan_to,
    permohonan_perubahan_data_penduduk.agama_to,
    permohonan_perubahan_data_penduduk.pekerjaan_to,
    permohonan_perubahan_data_penduduk.alamat_to,
    permohonan_perubahan_data_penduduk.nama_ttd,
    permohonan_perubahan_data_penduduk.nrpdes,
    permohonan_perubahan_data_penduduk.jabatan,
    permohonan_perubahan_data_penduduk.nomor_surat,
    permohonan_perubahan_data_penduduk.tanggal_pembuatan,
    permohonan_perubahan_data_penduduk.acuan
FROM
    permohonan_perubahan_data_penduduk
WHERE
    permohonan_perubahan_data_penduduk.id = " . $id . "
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
                            <th colspan="3" class="h5 text-center">SURAT PERMOHONAN PERUBAHAN DATA PENDUDUK</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="h6 text-center">Nomor : <?= $row_warga['nomor_surat']; ?></th>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Yang bertanda tangan dibawah ini :
                            </td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?= $row_warga['nama_ttd']; ?></td>
                        </tr>
                        <tr>
                            <td>NRPDes</td>
                            <td>:</td>
                            <td><?= $row_warga['nrpdes']; ?></td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td><?= $row_warga['jabatan']; ?></td>
                        </tr>
                        <tr>
                            <td>Instansi</td>
                            <td>:</td>
                            <td><?= INSTANSI ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Dengan ini mengajukan Permohonan Perubahan Data Penduduk dengan keterangan sebagai berikut :
                            </td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?= $row_warga['nama_from']; ?></td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_from']; ?></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tgl. Lahir </td>
                            <td>:</td>
                            <td>
                                <?= $row_warga['tempat_lahir_from']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_from']); ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>
                                <?= ($row_warga['jenis_kelamin_from'] == "L") ? "Laki-Laki" : "Perempuan"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Warganegara</td>
                            <td>:</td>
                            <td><?= $row_warga['warganegara_from']; ?></td>
                        </tr>
                        <tr>
                            <td>Status Perkawinan</td>
                            <td>:</td>
                            <td><?= $row_warga['status_perkawinan_from']; ?></td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td><?= $row_warga['agama_from']; ?></td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan_from']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_from']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Untuk dilakukan Perubahan Data Penduduk menjadi :
                            </td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?= $row_warga['nama_to']; ?></td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_to']; ?></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tgl. Lahir </td>
                            <td>:</td>
                            <td>
                                <?= $row_warga['tempat_lahir_to']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_to']); ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>
                                <?= ($row_warga['jenis_kelamin_to'] == "L") ? "Laki-Laki" : "Perempuan"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Warganegara</td>
                            <td>:</td>
                            <td><?= $row_warga['warganegara_to']; ?></td>
                        </tr>
                        <tr>
                            <td>Status Perkawinan</td>
                            <td>:</td>
                            <td><?= $row_warga['status_perkawinan_to']; ?></td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td><?= $row_warga['agama_to']; ?></td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan_to']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_to']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Permohonan ini dibuat berdasarkan laporan yang bersangkutan dan mengacu pada dokumen kependudukan : <?= $row_warga['acuan']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Demikian surat permohonan ini dibuat untuk dipergunakan seperlunya.
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
                                    <div class="col-6"></div>
                                    <div class="col-6">
                                        <?= $row_warga['jabatan']; ?>
                                    </div>
                                    <div class="col-6" style="height: 100px;"></div>
                                    <div class="col-6" style="height: 100px;"></div>
                                    <div class="col-6 font-weight-bold"></div>
                                    <div class="col-6 font-weight-bold">
                                        <?= $row_warga['nama_ttd']; ?><br />
                                        <?= $row_warga['nrpdes']; ?>
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