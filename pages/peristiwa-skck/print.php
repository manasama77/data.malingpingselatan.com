<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
require '../constant.php';

$id = $_GET['id'];

$sql = "
SELECT
    skck.warga_id, 
    skck.tanggal_pembuatan, 
    skck.nomor_surat,
    skck.nama_kepala_desa,
    skck.reg_no_camat, 
    skck.tanggal_ttd_camat, 
    skck.nama_camat, 
    skck.nip_camat, 
    skck.reg_no_danramil, 
    skck.tanggal_ttd_danramil, 
    skck.nama_danramil, 
    skck.nrp_danramil, 
    skck.reg_no_kapolsek, 
    skck.tanggal_ttd_kapolsek, 
    skck.nama_kapolsek, 
    skck.nrp_kapolsek,
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
    warga.alamat_ktp_warga
FROM
	skck
	LEFT JOIN warga ON warga.id_warga = skck.warga_id
WHERE
	skck.id = " . $id . "
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
                            <th colspan="3" class="h5 text-center">SURAT PENGANTAR CATATAN KEPOLISIAN</th>
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
                            <td><?= $row_warga['negara_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>Status Perkawinan</td>
                            <td>:</td>
                            <td><?= $row_warga['status_perkawinan']; ?></td>
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
                            <td>Alamat Domisili</td>
                            <td>:</td>
                            <td>
                                <?= $row_warga['alamat_warga']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
                        </tr>
                        <tr>
                            <td colspan="3">Berdasarkan data dan catatan yang ada serta sepanjang sepengetahuan kami orang tersebut :</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <ol>
                                    <li>Penduduk/ warga desa <?= DESA; ?> kecamatan <?= KECAMATAN; ?> <?= KOKAB; ?>.</li>
                                    <li>Berkelakuan baik di dalam kehidupan masyarakat.</li>
                                    <li>Tidak pernah bersangkut perkara kriminalitas dengan instansi kepolisian.</li>
                                    <li>Tidak dalam status tahanan yang berwajib.</li>
                                    <li>Tidak pernah terlibat dengan penggunaan obat-obatan terlarang.</li>
                                </ol>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">Surat Pengantar ini dibuat untuk keperluan : </td>
                        </tr>
                        <tr>
                            <td colspan="3">“ PENGANTAR PEMBUATAN SURAT KETERANGAN CATATAN KEPOLISIAN (SKCK) “</td>
                        </tr>
                        <tr>
                            <td colspan="3">Demikian surat pengantar ini dibuat untuk dipergunakan sebagaimana mestinya.</td>
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
                                    <td style="width: 50px;">Reg.No</td>
                                    <td style="width: 5px;">:</td>
                                    <td><?= $row_warga['reg_no_camat']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50px;">Tanggal</td>
                                    <td style="width: 5px;">:</td>
                                    <td>
                                        <?= tanggal_indo_no_dash($row_warga['tanggal_ttd_camat']); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50px;"></td>
                                    <td style="width: 5px;"></td>
                                    <td class="text-center">
                                        Mengetahui :<br />
                                        Camat <?= KECAMATAN; ?>,
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="height: 100px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width: 50px;"></td>
                                    <td style="width: 5px;"></td>
                                    <td class="text-center" style="border-bottom: 1px solid #000;">
                                        <?= $row_warga['nama_camat']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50px;"></td>
                                    <td style="width: 5px;"></td>
                                    <td class="text-center">
                                        NIP. <?= $row_warga['nip_camat']; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-borderless table-condensed table-sm w-100 p-0">
                            <tbody>
                                <tr>
                                    <td class="text-center"><?= DESA; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_pembuatan']); ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <br />
                                        Kepala Desa,
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 100px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <?= $row_warga['nama_kepala_desa']; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-borderless table-condensed table-sm w-100 p-0">
                            <tbody>
                                <tr>
                                    <td style="width: 50px;">Reg.No</td>
                                    <td style="width: 5px;">:</td>
                                    <td><?= $row_warga['reg_no_danramil']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50px;">Tanggal</td>
                                    <td style="width: 5px;">:</td>
                                    <td>
                                        <?= tanggal_indo_no_dash($row_warga['tanggal_ttd_danramil']); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50px;"></td>
                                    <td style="width: 5px;"></td>
                                    <td class="text-center">
                                        Mengetahui :<br />
                                        Danramil <?= KECAMATAN; ?>,
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="height: 100px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width: 50px;"></td>
                                    <td style="width: 5px;"></td>
                                    <td class="text-center" style="border-bottom: 1px solid #000;">
                                        <?= $row_warga['nama_danramil']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50px;"></td>
                                    <td style="width: 5px;"></td>
                                    <td class="text-center">
                                        NRP. <?= $row_warga['nrp_danramil']; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-borderless table-condensed table-sm w-100 p-0">
                            <tbody>
                                <tr>
                                    <td style="width: 50px;">Reg.No</td>
                                    <td style="width: 5px;">:</td>
                                    <td><?= $row_warga['reg_no_kapolsek']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50px;">Tanggal</td>
                                    <td style="width: 5px;">:</td>
                                    <td>
                                        <?= tanggal_indo_no_dash($row_warga['tanggal_ttd_kapolsek']); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50px;"></td>
                                    <td style="width: 5px;"></td>
                                    <td class="text-center">
                                        Mengetahui :<br />
                                        Kapolsek <?= KECAMATAN; ?>,
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="height: 100px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width: 50px;"></td>
                                    <td style="width: 5px;"></td>
                                    <td class="text-center" style="border-bottom: 1px solid #000;">
                                        <?= $row_warga['nama_kapolsek']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50px;"></td>
                                    <td style="width: 5px;"></td>
                                    <td class="text-center">
                                        NRP. <?= $row_warga['nrp_kapolsek']; ?>
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