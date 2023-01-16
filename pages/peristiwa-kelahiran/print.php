<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
require '../constant.php';

$id = $_GET['id'];

$sql = "
SELECT
    kelahiran.id,
	kelahiran.hari,
	warga.tempat_lahir_warga,
	kelahiran.tanggal_kelahiran,
	kelahiran.jam_kelahiran,
	kelahiran.tempat_kelahiran,
	warga.jenis_kelamin_warga,
	warga.nama_warga,
	warga.agama_warga,
	warga.alamat_warga,
	kelahiran.anak_ke,
	kartu_keluarga.nomor_keluarga,
	ibu.nama_warga AS nama_ibu,
	ibu.nik_warga AS nik_ibu,
	ibu.tempat_lahir_warga AS tempat_lahir_ibu,
	ibu.tanggal_lahir_warga AS tanggal_lahir_ibu,
	ibu.pekerjaan_warga AS pekerjaan_ibu,
	ibu.alamat_warga AS alamat_ibu,
	ayah.nama_warga AS nama_ayah,
	ayah.nik_warga AS nik_ayah,
	ayah.tempat_lahir_warga AS tempat_lahir_ayah,
	ayah.tanggal_lahir_warga AS tanggal_lahir_ayah,
	ayah.pekerjaan_warga AS pekerjaan_ayah,
	ayah.alamat_warga AS alamat_ayah,
	pelapor.nama_warga AS nama_pelapor,
	pelapor.nik_warga AS nik_pelapor,
	pelapor.tempat_lahir_warga AS tempat_lahir_pelapor,
	pelapor.tanggal_lahir_warga AS tanggal_lahir_pelapor,
	pelapor.pekerjaan_warga AS pekerjaan_pelapor,
	pelapor.alamat_warga AS alamat_pelapor,
    pelapor.jenis_kelamin_warga AS jenis_kelamin_pelapor,
	(
	IF
		(
			( SELECT count( * ) FROM kartu_keluarga WHERE kartu_keluarga.id_kepala_keluarga = kelahiran.pelapor_id ) = 1,
			( SELECT nomor_keluarga FROM kartu_keluarga WHERE kartu_keluarga.id_kepala_keluarga = kelahiran.pelapor_id ),
			( SELECT kartu_keluarga.nomor_keluarga FROM warga_has_kartu_keluarga LEFT JOIN kartu_keluarga ON kartu_keluarga.id_keluarga = warga_has_kartu_keluarga.id_keluarga WHERE warga_has_kartu_keluarga.id_warga = kelahiran.pelapor_id ) 
		) 
	) AS nomor_keluarga_pelapor,
    kelahiran.hubungan_pelapor,
    kelahiran.tanggal_pembuatan,
    kelahiran.nomor_surat,
    kelahiran.nama_ttd,
    kelahiran.jabatan_ttd,
    kelahiran.nomor_induk_ttd
FROM
	kelahiran
	LEFT JOIN warga ON warga.id_warga = kelahiran.warga_id
	LEFT JOIN warga AS ibu ON ibu.id_warga = kelahiran.ibu_id
	LEFT JOIN warga AS ayah ON ayah.id_warga = kelahiran.ayah_id
	LEFT JOIN kartu_keluarga ON kartu_keluarga.id_kepala_keluarga = kelahiran.ayah_id
	LEFT JOIN warga AS pelapor ON pelapor.id_warga = kelahiran.pelapor_id
WHERE
    kelahiran.id = " . $id . "
";
$query_warga = mysqli_query($db, $sql);
if (mysqli_num_rows($query_warga) == 0) {
    die("Data Warga Tidak Ditemukan");
} else {
    $row_warga = mysqli_fetch_assoc($query_warga);
}
$now                       = new DateTime();
$tanggal_lahir_anak_obj    = new DateTime($row_warga['tanggal_kelahiran']);
$tanggal_lahir_ibu_obj     = new DateTime($row_warga['tanggal_lahir_ibu']);
$tanggal_lahir_ayah_obj    = new DateTime($row_warga['tanggal_lahir_ayah']);
$tanggal_lahir_pelapor_obj = new DateTime($row_warga['tanggal_lahir_pelapor']);

$interval_ibu     = $now->diff($tanggal_lahir_ibu_obj);
$interval_ayah    = $now->diff($tanggal_lahir_ayah_obj);
$interval_pelapor = $now->diff($tanggal_lahir_pelapor_obj);
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
                <table class="table table-borderless table-condensed table-sm w-100 p-0" style="line-height: 0.9;">
                    <tbody>
                        <tr>
                            <th colspan="4" class="h5 text-center">SURAT KETERANGAN KELAHIRAN</th>
                        </tr>
                        <tr>
                            <th colspan="4" class="h6 text-center">Nomor : <?= $row_warga['nomor_surat']; ?></th>
                        </tr>
                        <tr>
                            <td colspan="4"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-justify">
                                Yang bertanda tangan dibawah ini <?= PERWAKILAN; ?> menerangkan bahwa :
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Hari</td>
                            <td>:</td>
                            <td><?= $row_warga['hari']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_lahir_warga']; ?>, <?= $tanggal_lahir_anak_obj->format('d-m-Y'); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Pukul</td>
                            <td>:</td>
                            <td>
                                <?php
                                $time_obj = new DateTime($row_warga['jam_kelahiran']);
                                echo $time_obj->format('H:i') . " WIB"
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Di</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_kelahiran']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                Telah lahir seorang bayi <?= ($row_warga['jenis_kelamin_warga'] == "L") ? "Laki-Laki" : "Perempuan"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Bernama</td>
                            <td>:</td>
                            <td><?= $row_warga['nama_warga']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Anak ke</td>
                            <td>:</td>
                            <td><?= $row_warga['anak_ke']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Dari Orang Tua</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1.</td>
                            <td>Nama Ibu</td>
                            <td>:</td>
                            <td><?= $row_warga['nama_ibu']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_ibu']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>No. Kartu Keluarga</td>
                            <td>:</td>
                            <td><?= $row_warga['nomor_keluarga']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tempat, Tgl. Lahir / Umur</td>
                            <td>:</td>
                            <td>
                                <?= $row_warga['tempat_lahir_ibu']; ?>, <?= $tanggal_lahir_ibu_obj->format('d-m-Y'); ?> / <?= $interval_ibu->y; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['nomor_keluarga']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_ibu']; ?></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Nama Ayah</td>
                            <td>:</td>
                            <td><?= $row_warga['nama_ayah']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_ayah']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>No. Kartu Keluarga</td>
                            <td>:</td>
                            <td><?= $row_warga['nomor_keluarga']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tempat, Tgl. Lahir / Umur</td>
                            <td>:</td>
                            <td>
                                <?= $row_warga['tempat_lahir_ayah']; ?>, <?= $tanggal_lahir_ayah_obj->format('d-m-Y'); ?> / <?= $interval_ayah->y; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['nomor_keluarga']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_ayah']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="width: 350px;">Surat keterangan ini dibuat berdasarkan keterangan pelapor</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Nama Pelapor</td>
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
                            <td>No. Kartu Keluarga</td>
                            <td>:</td>
                            <td><?= $row_warga['nomor_keluarga_pelapor']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tempat, Tgl. Lahir / Umur</td>
                            <td>:</td>
                            <td>
                                <?= $row_warga['tempat_lahir_pelapor']; ?>, <?= $tanggal_lahir_pelapor_obj->format('d-m-Y'); ?> / <?= $interval_pelapor->y; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['nomor_keluarga']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_pelapor']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Hubungan Pelapor Dengan Bayi</td>
                            <td>:</td>
                            <td><?= $row_warga['hubungan_pelapor']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                Demikian keterangan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.
                            </td>
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
                                    <div class="col-6" style="height: 80px;"></div>
                                    <div class="col-6" style="height: 80px;"></div>
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