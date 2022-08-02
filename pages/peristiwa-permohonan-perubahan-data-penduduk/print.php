<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
require '../constant.php';

$id = $_GET['id'];

$sql = "
SELECT
	cerai.nomor_surat,
	cerai.tanggal_pembuatan,
    pelapor.nama_warga as nama_pelapor,
	pelapor.nik_warga as nik_pelapor,
	pelapor.tempat_lahir_warga as tempat_lahir_pelapor,
	pelapor.tanggal_lahir_warga as tanggal_lahir_pelapor,
	pelapor.jenis_kelamin_warga as jenis_kelamin_pelapor,
	pelapor.agama_warga as agama_pelapor,
	pelapor.pekerjaan_warga as pekerjaan_pelapor,
	pelapor.alamat_ktp_warga as alamat_ktp_pelapor,
    pasangan.nama_warga as nama_pasangan,
	pasangan.nik_warga as nik_pasangan,
	pasangan.tempat_lahir_warga as tempat_lahir_pasangan,
	pasangan.tanggal_lahir_warga as tanggal_lahir_pasangan,
	pasangan.jenis_kelamin_warga as jenis_kelamin_pasangan,
    pasangan.agama_warga as agama_pasangan,
	pasangan.pekerjaan_warga as pekerjaan_pasangan,
	pasangan.alamat_ktp_warga as alamat_ktp_pasangan,
    cerai.tanggal_cerai,
	cerai.alasan_cerai,
	cerai.status_pelapor,
    cerai.nama_ttd,
	cerai.jabatan_ttd,
	cerai.nomor_induk_ttd,
	cerai.saksi_1,
	cerai.saksi_2,
	cerai.saksi_3
FROM
	cerai
	LEFT JOIN warga AS pelapor ON pelapor.id_warga = cerai.pelapor_id
	LEFT JOIN warga AS pasangan ON pasangan.id_warga = cerai.warga_id 
WHERE
	cerai.id = " . $id . "
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
                            <th colspan="4" class="h5 text-center">SURAT KETERANGAN CERAI</th>
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
                            <td>Nama Lengkap (Pelapor)</td>
                            <td>:</td>
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
                            <td><?= $row_warga['tempat_lahir_pelapor']; ?>,
                                <?php
                                $tgl_obj = new DateTime($row_warga['tanggal_lahir_pelapor']);
                                echo $tgl_obj->format('d-m-Y');
                                ?>
                            </td>
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
                            <td>Indonesia</td>
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
                            <td>
                                <?= $row_warga['alamat_ktp_pelapor']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Nama Lengkap</td>
                            <td>:</td>
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
                            <td><?= $row_warga['tempat_lahir_pasangan']; ?>,
                                <?php
                                $tgl_obj = new DateTime($row_warga['tanggal_lahir_pasangan']);
                                echo $tgl_obj->format('d-m-Y');
                                ?>
                            </td>
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
                            <td>Indonesia</td>
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
                            <td>
                                <?= $row_warga['alamat_ktp_pasangan']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                Kedua nama tersebut diatas adalah benar Pasangan Suami Istri yang telah <u><b>bercerai</b></u> pada :
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Hari, Tanggal, Tahun</td>
                            <td>:</td>
                            <td><?= full_tanggal_indo_no_dash($row_warga['tanggal_cerai']); ?> </td>
                        </tr>
                        <tr>
                            <td colspan="2">Alasan Cerai</td>
                            <td>:</td>
                            <td><?= $row_warga['alasan_cerai']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                Surat Keterangan ini dibuat berdasarkan laporan yang bersangkutan (Pelapor) dan Surat Pengantar dari Ketua RT/RW. Demikian keterangan ini dibuat dengan sebenarnya untuk dipergunakan seperlunya, dan yang bersangkutan (Pelapor) saat ini berstatus : <?= $row_warga['status_pelapor']; ?>.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"><br /></td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="4">
                                <div class="row">
                                    <div class="col-6 text-center"></div>
                                    <div class="col-6 text-center">
                                        <?= DESA; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_pembuatan']); ?>
                                    </div>
                                    <div class="col-6">
                                        Pelapor,
                                    </div>
                                    <div class="col-6">
                                        <?= $row_warga['jabatan_ttd']; ?>
                                    </div>
                                    <div class="col-6" style="height: 100px;"></div>
                                    <div class="col-6" style="height: 100px;"></div>
                                    <div class="col-6 font-weight-bold">
                                        <?= $row_warga['nama_pelapor']; ?>
                                    </div>
                                    <div class="col-6 font-weight-bold">
                                        <?= $row_warga['nama_ttd']; ?><br />
                                        <?= $row_warga['nomor_induk_ttd']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-left">
                                        Saksi-saksi:<br />
                                        1. <?= $row_warga['saksi_1']; ?><br />
                                        2. <?= $row_warga['saksi_2']; ?><br />
                                        3. <?= $row_warga['saksi_3']; ?><br />
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