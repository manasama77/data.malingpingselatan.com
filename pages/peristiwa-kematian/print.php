<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
require '../constant.php';

$id = $_GET['id'];

$sql = "
SELECT
    kematian.nomor_surat,
    kematian.tanggal_pembuatan,
    warga.nama_warga,
    warga.nik_warga,
(
	IF
		(
			( SELECT count( * ) FROM kartu_keluarga WHERE kartu_keluarga.id_kepala_keluarga = kematian.warga_id ) = 1,
			( SELECT nomor_keluarga FROM kartu_keluarga WHERE kartu_keluarga.id_kepala_keluarga = kematian.warga_id ),
			( SELECT kartu_keluarga.nomor_keluarga FROM warga_has_kartu_keluarga LEFT JOIN kartu_keluarga ON kartu_keluarga.id_keluarga = warga_has_kartu_keluarga.id_keluarga WHERE warga_has_kartu_keluarga.id_warga = kematian.warga_id ) 
		) 
	) AS nomor_keluarga,
	warga.tempat_lahir_warga,
	warga.tanggal_lahir_warga,
	warga.jenis_kelamin_warga,
	warga.agama_warga,
	warga.pekerjaan_warga,
	warga.alamat_ktp_warga,
	warga.alamat_warga,
	kematian.hari,
	kematian.tanggal_kematian,
	kematian.jam_kematian,
	kematian.penyebab_kematian,
	kematian.tempat_kematian,
	pelapor.nama_warga AS nama_pelapor,
	pelapor.nik_warga AS nik_pelapor,
	pelapor.tempat_lahir_warga AS tempat_lahir_pelapor,
	pelapor.tanggal_lahir_warga AS tanggal_lahir_pelapor,
	pelapor.jenis_kelamin_warga AS jenis_kelamin_pelapor,
	pelapor.pekerjaan_warga AS pekerjaan_pelapor,
	pelapor.alamat_warga AS alamat_pelapor,
	kematian.hubungan_pelapor,
	kematian.nama_ttd,
	kematian.jabatan_ttd,
	kematian.nomor_induk_ttd
FROM
	kematian
	LEFT JOIN warga ON warga.id_warga = kematian.warga_id
	LEFT JOIN warga AS pelapor ON pelapor.id_warga = kematian.pelapor_id 
WHERE
	kematian.id = " . $id . "
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
                            <th colspan="3" class="h5 text-center">SURAT KETERANGAN KEMATIAN</th>
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
                        <!-- <tr>
                            <td>Status Perkawinan</td>
                            <td>:</td>
                            <td>Kawin</td>
                        </tr> -->
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
                            <td colspan="3">
                                Telah meninggal dunia pada :
                            </td>
                        </tr>
                        <tr>
                            <td>Hari</td>
                            <td>:</td>
                            <td><?= $row_warga['hari']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>
                                <?php
                                $tgl_obj = new DateTime($row_warga['tanggal_kematian']);
                                echo $tgl_obj->format('d-m-Y');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Pukul</td>
                            <td>:</td>
                            <td>
                                <?php
                                $tgl_obj = new DateTime($row_warga['jam_kematian']);
                                echo $tgl_obj->format('H:i') . " WIB";
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Penyebab Kematian</td>
                            <td>:</td>
                            <td>
                                <?= $row_warga['penyebab_kematian']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Bertempat</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_warga']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Keterangan ini dibuat berdasarkan laporan Ketua RT/RW dan keterangan pelapor :
                            </td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?= $row_warga['nama_pelapor']; ?></td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_pelapor']; ?></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td>
                                <?= $row_warga['tempat_lahir_pelapor']; ?>,
                                <?php
                                $tgl_obj = new DateTime($row_warga['tanggal_lahir_pelapor']);
                                echo $tgl_obj->format('d-m-Y');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?= ($row_warga['jenis_kelamin_pelapor'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                        </tr>
                        <!-- <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>Kawin</td>
                        </tr> -->
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan_pelapor']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>
                                <?= $row_warga['alamat_pelapor']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 425px;">Hubungan Pelapor dengan Almarhum/Almarhumah</td>
                            <td>:</td>
                            <td>
                                <?= $row_warga['hubungan_pelapor']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-justify">
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