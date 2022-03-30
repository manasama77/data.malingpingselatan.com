<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
$id = $_GET['id'];

$sql = "
SELECT
	belum_bekerja.nomor_surat,
	belum_bekerja.tanggal_pembuatan,
	warga.nama_warga,
	warga.nik_warga,
	warga.tempat_lahir_warga,
	warga.tanggal_lahir_warga,
	warga.jenis_kelamin_warga,
	warga.agama_warga,
	warga.pekerjaan_warga,
	warga.alamat_ktp_warga
FROM
	belum_bekerja
	LEFT JOIN warga ON warga.id_warga = belum_bekerja.warga_id 
WHERE
	belum_bekerja.id = " . $id . "
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
                <div class="row">
                    <div class="col-12">
                        <div class="col-12" style="height: 120px;">
                            <img src="../../assets/img/logo.png" class="float-left" style="height: 130px;" />
                            <h4 style="top: 0; position: absolute; width:100%;" class="text-center">
                                PEMERINTAH KABUPATEN LEBAK<br />
                                KECAMATAN MALINGPING<br />
                                DESA MALINGPING SELATAN<br />
                                <p style="line-height: 14pt; font-size: 14px; margin-top: 10px;">
                                    Alamat : Jalan Lebak Lame Desa Malingping Selatan Kecamatan Malingping 42391<br />
                                    e-mail : malingpingselatan2018@gmail.com
                                </p>
                            </h4>
                        </div>
                    </div>
                </div>
                <hr style="border-top: 5px solid black;" />
                <table class="table table-borderless table-condensed table-sm w-100 p-0">
                    <tbody>
                        <tr>
                            <th colspan="3" class="h5 text-center">SURAT KETERANGAN BELUM BEKERJA</th>
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
                                Nama tersebut yang tercantum diatas sepanjang sepengetahuan kami dan berdasarkan surat pengantar dari Ketua RT/RW serta pengakuan dari Pemohon, adalah benar pada saat surat ini diterbitkan nama tersebut/Pemohon belum mempunyai pekerjaan.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Demikian keterangan ini dibuat dan diberikan atas dasar yang sebenarnya agar dipergunakan seperlunya. Dan apabila terjadi permasalahan/keberatan/komplain dikemudian hari, Pemohon bersedia bertanggung jawab menanggung segala akibatnya sesuai peraturan-peraturan yang berlaku di Indonesia dengan tidak/tanpa melibatkan aparatur pemerintah yang menangani surat keterangan ini.
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
                                        <?= $row_warga['nama_warga']; ?>
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