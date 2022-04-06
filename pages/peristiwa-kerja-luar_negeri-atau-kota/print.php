<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
$id = $_GET['id'];

$sql = "
SELECT
	bekerja_luar_negeri_kota.nomor_surat,
	bekerja_luar_negeri_kota.tanggal_pembuatan,
	warga.nama_warga,
	warga.nik_warga,
	(
	IF
		(
			( SELECT count( * ) FROM kartu_keluarga WHERE kartu_keluarga.id_kepala_keluarga = bekerja_luar_negeri_kota.warga_id ) = 1,
			( SELECT nomor_keluarga FROM kartu_keluarga WHERE kartu_keluarga.id_kepala_keluarga = bekerja_luar_negeri_kota.warga_id ),
			( SELECT kartu_keluarga.nomor_keluarga FROM warga_has_kartu_keluarga LEFT JOIN kartu_keluarga ON kartu_keluarga.id_keluarga = warga_has_kartu_keluarga.id_keluarga WHERE warga_has_kartu_keluarga.id_warga = bekerja_luar_negeri_kota.warga_id ) 
		) 
	) AS nomor_keluarga,
	warga.tempat_lahir_warga,
	warga.tanggal_lahir_warga,
	warga.jenis_kelamin_warga,
	warga.agama_warga,
	warga.pekerjaan_warga,
	warga.alamat_ktp_warga,
    bekerja_luar_negeri_kota.tujuan,
	bekerja_luar_negeri_kota.sejak,
	bekerja_luar_negeri_kota.sampai,
	bekerja_luar_negeri_kota.pekerjaan,
    pelapor.nama_warga as nama_pelapor,
	pelapor.nik_warga as nik_pelapor,
	pelapor.tempat_lahir_warga as tempat_lahir_pelapor,
	pelapor.tanggal_lahir_warga as tanggal_lahir_pelapor,
	pelapor.jenis_kelamin_warga as jenis_kelamin_pelapor,
	pelapor.pekerjaan_warga as pekerjaan_pelapor,
	pelapor.alamat_warga as alamat_pelapor,
	bekerja_luar_negeri_kota.hubungan_pelapor
FROM
	bekerja_luar_negeri_kota
	LEFT JOIN warga ON warga.id_warga = bekerja_luar_negeri_kota.warga_id 
    LEFT JOIN warga as pelapor ON pelapor.id_warga = bekerja_luar_negeri_kota.pelapor_id
WHERE
	bekerja_luar_negeri_kota.id = " . $id . "
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
                            <th colspan="3" class="h5 text-center">SURAT KETERANGAN BEKERJA DILUAR NEGERI/KOTA</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="h6 text-center">Nomor : <?= $row_warga['nomor_surat']; ?></th>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Yang bertanda tangan dibawah ini Kepala Desa Malingping Selatan menerangkan bahwa :
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
                            <td colspan="3">
                                Adalah benar nama yang tercantum diatas sedang bekerja di :
                            </td>
                        </tr>
                        <tr>
                            <td>Negeri / Kota</td>
                            <td>:</td>
                            <td><?= $row_warga['tujuan']; ?></td>
                        </tr>
                        <tr>
                            <td>Sejak</td>
                            <td>:</td>
                            <td>
                                <?php
                                $tgl_obj = new DateTime($row_warga['sejak']);
                                echo $tgl_obj->format('d-m-Y');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Sampai dengan</td>
                            <td>:</td>
                            <td>
                                <?php
                                if ($row_warga['sampai'] == "") {
                                    echo "Sekarang";
                                } else {
                                    $tgl_obj = new DateTime($row_warga['sampai']);
                                    echo $tgl_obj->format('d-m-Y');
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Bidang / Jenis Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Keterangan ini dibuat berdasarkan laporan dari :
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
                            <td>Hubungan</td>
                            <td>:</td>
                            <td><?= ($row_warga['hubungan_pelapor'] != "") ? $row_warga['hubungan_pelapor'] : "Diri Sendiri"; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Demikian keterangan ini dibuat dengan sebenarnya dan kepada yang berkepentingan untuk dipergunakan seperlunya.
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="3">
                                <div class="row">
                                    <div class="col-6 text-center"></div>
                                    <div class="col-6 text-center font-weight-bold">
                                        Malingping Selatan, <?= tanggal_indo_no_dash($row_warga['tanggal_pembuatan']); ?>
                                    </div>
                                    <div class="col-6">
                                        Pelapor,
                                    </div>
                                    <div class="col-6">
                                        a.n. Kepala Desa <br />
                                        Kepala Urusan Umum,
                                    </div>
                                    <div class="col-6" style="height: 100px;"></div>
                                    <div class="col-6" style="height: 100px;"></div>
                                    <div class="col-6 font-weight-bold">
                                        <?= $row_warga['nama_pelapor']; ?>
                                    </div>
                                    <div class="col-6 font-weight-bold">
                                        M. AGUNG TAMARA R.<br />
                                        NRPDes.198610202001062046
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