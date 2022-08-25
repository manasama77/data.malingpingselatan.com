<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
require '../constant.php';

$id = $_GET['id'];

$sql = "
SELECT  
    sk_telah_menikah.id,
    sk_telah_menikah.pelapor_id,
    sk_telah_menikah.pasangan_id,
    sk_telah_menikah.tanggal_menikah,
    sk_telah_menikah.tempat_menikah,
    sk_telah_menikah.nama_wali_nikah,
    sk_telah_menikah.nama_penghulu_nikah,
    sk_telah_menikah.tanggal_pelaporan,
    sk_telah_menikah.nama_kepala_desa,
    sk_telah_menikah.nrp,
    sk_telah_menikah.saksi_1,
    sk_telah_menikah.saksi_2,
    sk_telah_menikah.saksi_3,
    sk_telah_menikah.nomor_surat,
    
    pelapor.nama_warga as nama_pelapor,
    pelapor.nik_warga as nik_pelapor,
    pelapor.tempat_lahir_warga as tempat_lahir_pelapor,
    pelapor.tanggal_lahir_warga as tanggal_lahir_pelapor,
    pelapor.jenis_kelamin_warga as jenis_kelamin_pelapor,
    pelapor.negara_warga as negara_pelapor,
    pelapor.status_perkawinan as status_perkawinan_pelapor,
    pelapor.agama_warga as agama_pelapor,
    pelapor.pekerjaan_warga as pekerjaan_pelapor,
    pelapor.alamat_ktp_warga as alamat_ktp_pelapor,

    pasangan.nama_warga as nama_pasangan,
    pasangan.nik_warga as nik_pasangan,
    pasangan.tempat_lahir_warga as tempat_lahir_pasangan,
    pasangan.tanggal_lahir_warga as tanggal_lahir_pasangan,
    pasangan.jenis_kelamin_warga as jenis_kelamin_pasangan,
    pasangan.negara_warga as negara_pasangan,
    pasangan.status_perkawinan as status_perkawinan_pasangan,
    pasangan.agama_warga as agama_pasangan,
    pasangan.pekerjaan_warga as pekerjaan_pasangan,
    pasangan.alamat_ktp_warga as alamat_ktp_pasangan
FROM sk_telah_menikah 
LEFT JOIN warga as pelapor ON pelapor.id_warga = sk_telah_menikah.pelapor_id
LEFT JOIN warga as pasangan ON pasangan.id_warga = sk_telah_menikah.pasangan_id
WHERE sk_telah_menikah.id = " . $id . "
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
                            <th colspan="4" class="h5 text-center">SURAT KETERANGAN TELAH MENIKAH</th>
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
                            <td>1.</td>
                            <td style="width: 250px;">Nama Lengkap (Pelapor)</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['nama_pelapor']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_pelapor']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_lahir_pelapor']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_pelapor']); ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?= ($row_warga['jenis_kelamin_pelapor'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Warganegara</td>
                            <td>:</td>
                            <td><?= $row_warga['negara_pelapor']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Agama</td>
                            <td>:</td>
                            <td><?= $row_warga['agama_pelapor']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan_pelapor']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Alamat KTP</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_ktp_pelapor']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td style="width: 220px;">Nama Lengkap</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['nama_pasangan']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_pasangan']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_lahir_pasangan']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_pasangan']); ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?= ($row_warga['jenis_kelamin_pasangan'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Warganegara</td>
                            <td>:</td>
                            <td><?= $row_warga['negara_pasangan']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Agama</td>
                            <td>:</td>
                            <td><?= $row_warga['agama_pasangan']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan_pasangan']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Alamat KTP</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_ktp_pasangan']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                Kedua nama tersebut diatas adalah benar Pasangan Suami Istri yang telah <b><u>Menikah</u></b> pada :
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Hari, Tanggal, Tahun</td>
                            <td>:</td>
                            <td><?= tanggal_indo_no_dash($row_warga['tanggal_menikah']); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Tempat</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_menikah']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Nama Wali Nikah</td>
                            <td>:</td>
                            <td><?= $row_warga['nama_wali_nikah']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Nama Penghulu Pernikahan</td>
                            <td>:</td>
                            <td><?= $row_warga['nama_penghulu_nikah']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                Surat Keterangan ini dibuat berdasarkan laporan yang bersangkutan (Pelapor) dan Surat Pengantar dari Ketua RT/RW. Demikian keterangan ini dibuat dengan sebenarnya untuk dipergunakan seperlunya.
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
                                        Pelapor,
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 100px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <?= $row_warga['nama_pelapor']; ?>
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
                    <div class="col-6">
                        <table class="table table-borderless table-condensed table-sm w-100 p-0">
                            <tbody>
                                <tr>
                                    <td class="text-left">Saksi-saksi :</td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        1. <?= $row_warga['saksi_1']; ?><br />
                                        2. <?= $row_warga['saksi_2']; ?><br />
                                        3. <?= $row_warga['saksi_3']; ?>
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