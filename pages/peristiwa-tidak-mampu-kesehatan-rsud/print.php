<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
require '../constant.php';

$id = $_GET['id'];

$sql = "
SELECT
	tidak_mampu_kesehatan_rsud.warga_id,
	tidak_mampu_kesehatan_rsud.tanggal_pembuatan,
	tidak_mampu_kesehatan_rsud.nomor_surat,
	warga.nama_warga,
	warga.nik_warga,
    (
        IF
        (
            ( SELECT count( * ) FROM kartu_keluarga WHERE kartu_keluarga.id_kepala_keluarga = tidak_mampu_kesehatan_rsud.warga_id ) = 1,
            ( SELECT nomor_keluarga FROM kartu_keluarga WHERE kartu_keluarga.id_kepala_keluarga = tidak_mampu_kesehatan_rsud.warga_id ),
            ( SELECT kartu_keluarga.nomor_keluarga FROM warga_has_kartu_keluarga LEFT JOIN kartu_keluarga ON kartu_keluarga.id_keluarga = warga_has_kartu_keluarga.id_keluarga WHERE warga_has_kartu_keluarga.id_warga = tidak_mampu_kesehatan_rsud.warga_id ) 
        ) 
    ) AS nomor_keluarga,
	warga.tempat_lahir_warga,
	warga.tanggal_lahir_warga,
	warga.jenis_kelamin_warga,
	warga.agama_warga,
	warga.pekerjaan_warga,
	warga.alamat_ktp_warga,
	tidak_mampu_kesehatan_rsud.jabatan_ttd,
    tidak_mampu_kesehatan_rsud.nama_ttd,
	tidak_mampu_kesehatan_rsud.nomor_induk_ttd,
	tidak_mampu_kesehatan_rsud.no_register_camat,
	tidak_mampu_kesehatan_rsud.nama_camat,
	tidak_mampu_kesehatan_rsud.nip_camat
FROM
	tidak_mampu_kesehatan_rsud
	LEFT JOIN warga ON warga.id_warga = tidak_mampu_kesehatan_rsud.warga_id 
WHERE
	tidak_mampu_kesehatan_rsud.id = " . $id . "
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
    <meta charset="utf-8" />
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Print</title>

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" integrity="sha512-rt/SrQ4UNIaGfDyEXZtNcyWvQeOq0QLygHluFQcSjaGB04IxWhal71tKuzP6K8eYXYB6vJV4pHkXcmFGGQ1/0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://www.dafontfree.net/embed/Ym9va21hbi1vbGQtc3R5bGUtcmVndWxhciZkYXRhLzQ2L2IvNTk0NjEvYm9va21hbiBvbGQgc3R5bGUudHRm" rel="stylesheet" type="text/css" />

    <style>
        @font-face {
            font-family: bookman;
            src: url(../BOOKOS.TTF)
        }

        * {
            font-family: bookman, sans-serif;
            line-height: 1.5;
            /* border: 1px solid red; */
        }
    </style>
</head>

<!-- <body onload="window.print();"> -->

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php require('../_partials/print_header.php'); ?>
                <hr style="border-top: 5px solid black;" />
                <table class="table table-borderless table-condensed table-sm w-100 p-0" style="line-height: 0.9;">
                    <tbody>
                        <tr>
                            <th colspan="3" class="h5 text-center">SURAT KETERANGAN TIDAK MAMPU</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="h6 text-center">Nomor : <?= $row_warga['nomor_surat']; ?></th>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Yang bertanda tangan dibawah ini <?= PERWAKILAN; ?> menerangkan bahwa :
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>:</td>
                            <td><?= $row_warga['nama_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>No. Kartu Keluarga</td>
                            <td>:</td>
                            <td><?= $row_warga['nomor_keluarga']; ?></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_lahir_warga']; ?>,
                                <?php
                                $tgl_obj = new DateTime($row_warga['tanggal_lahir_warga']);
                                echo $tgl_obj->format('d-m-Y');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?= ($row_warga['jenis_kelamin_warga'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                        </tr>
                        <tr>
                            <td>Warganegara</td>
                            <td>:</td>
                            <td>Indonesia</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td><?= $row_warga['agama_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat KTP</td>
                            <td>:</td>
                            <td>
                                <?= $row_warga['alamat_ktp_warga']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-justify">
                                Nama tersebut adalah warga Desa <?= DESA; ?> dan menurut laporan dari Ketua RT dan RW nama tersebut benar termasuk dalam Keluarga Tidak Mampu.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Demikian keterangan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.
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
                                    <div class="col-6 text-center">Mengetahui :</div>
                                    <div class="col-6 text-center font-weight-bold"></div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        Camat <?= KECAMATAN; ?>
                                    </div>
                                    <div class="col-6">
                                        <?= $row_warga['jabatan_ttd']; ?>
                                    </div>
                                    <div class="col-6" style="height: 100px;"></div>
                                    <div class="col-6" style="height: 100px;"></div>
                                    <div class="col-6 font-weight-bold">
                                        <?= $row_warga['nama_camat']; ?><br />
                                        <?= $row_warga['nip_camat']; ?>
                                    </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js" integrity="sha512-7rusk8kGPFynZWu26OKbTeI+QPoYchtxsmPeBqkHIEXJxeun4yJ4ISYe7C6sz9wdxeE1Gk3VxsIWgCZTc+vX3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>