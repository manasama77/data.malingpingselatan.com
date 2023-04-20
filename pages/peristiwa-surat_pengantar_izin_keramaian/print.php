<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
require '../constant.php';

$id = $_GET['id'];

$sql = "
SELECT  
    surat_pengantar_izin_keramaian.id,
    surat_pengantar_izin_keramaian.warga_id,
    surat_pengantar_izin_keramaian.acara,
    surat_pengantar_izin_keramaian.tanggal_jam_acara,
    surat_pengantar_izin_keramaian.tempat_acara,
    surat_pengantar_izin_keramaian.jumlah_peserta,
    surat_pengantar_izin_keramaian.hiburan,
    surat_pengantar_izin_keramaian.penanggungjawab_acara,
    surat_pengantar_izin_keramaian.tanggal_pelaporan,
    surat_pengantar_izin_keramaian.nama_kepala_desa,
    surat_pengantar_izin_keramaian.nomor_kapolsek,
    surat_pengantar_izin_keramaian.tanggal_kapolsek,
    surat_pengantar_izin_keramaian.diizinkan_kapolsek,
    surat_pengantar_izin_keramaian.catatan_kapolsek,
    surat_pengantar_izin_keramaian.nama_danramil,
    surat_pengantar_izin_keramaian.nrp_danramil,
    surat_pengantar_izin_keramaian.nama_kapolsek,
    surat_pengantar_izin_keramaian.nrp_kapolsek,
    surat_pengantar_izin_keramaian.no_rw,
    surat_pengantar_izin_keramaian.nama_rw,
    surat_pengantar_izin_keramaian.no_rt,
    surat_pengantar_izin_keramaian.nama_rt,
    surat_pengantar_izin_keramaian.nomor_surat,
    
    warga.nama_warga as nama_warga,
    warga.nik_warga as nik_warga,
    warga.tempat_lahir_warga as tempat_lahir_warga,
    warga.tanggal_lahir_warga as tanggal_lahir_warga,
    warga.jenis_kelamin_warga as jenis_kelamin_warga,
    warga.negara_warga as negara_warga,
    warga.status_perkawinan as status_perkawinan_warga,
    warga.agama_warga as agama_warga,
    warga.pekerjaan_warga as pekerjaan_warga,
    warga.alamat_ktp_warga as alamat_ktp_warga

FROM surat_pengantar_izin_keramaian 
LEFT JOIN warga ON warga.id_warga = surat_pengantar_izin_keramaian.warga_id
WHERE surat_pengantar_izin_keramaian.id = " . $id . "
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
            line-height: 1.5;
        }

        .text-justify {
            text-align: justify;
            text-justify: inter-word;
        }

        @media print {
            footer {
                page-break-after: always;
            }
        }

        .h7 {
            font-size: 0.8rem;
            font-weight: normal;
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
                <table class="table table-borderless table-condensed table-sm w-100 p-0" style="font-size: 0.9rem; line-height: 0.9;">
                    <tbody>
                        <tr>
                            <th colspan="3" class="h6 text-center">SURAT PENGANTAR IZIN KERAMAIAN</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="h7 text-center">Nomor : <?= $row_warga['nomor_surat']; ?></th>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Kepala Desa <?= DESA; ?> dalam rangka menindaklanjuti Surat Izin Lingkungan setempat dan memenuhi permohonan dari :
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 250px;">Nama</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['nama_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>N I K</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>Tempat/Tanggal Lahir</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_lahir_warga']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_warga']); ?></td>
                        </tr>
                        <tr>
                            <td>Umur</td>
                            <td>:</td>
                            <td>
                                <?= umur($row_warga['tanggal_lahir_warga']); ?> TAHUN
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?= ($row_warga['jenis_kelamin_warga'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td><?= $row_warga['status_perkawinan_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td><?= $row_warga['agama_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>Kewarganegaraan</td>
                            <td>:</td>
                            <td><?= $row_warga['negara_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_ktp_warga']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-justify">
                                Selanjutnya disebut <u>Pemohon</u><br />
                                Benar pemohon tersebut mengajukan permohonan untuk memperoleh Suart Pengantar Izin Keramaian dengan keterangan sebagai berikut :
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 250px;">Acara</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['acara']; ?></td>
                        </tr>
                        <tr>
                            <td>Hari/Tanggal</td>
                            <td>:</td>
                            <td><?= full_tanggal_indo_no_dash($row_warga['tanggal_jam_acara']); ?></td>
                        </tr>
                        <tr>
                            <td>Pukul</td>
                            <td>:</td>
                            <td><?= jam($row_warga['tanggal_jam_acara']); ?></td>
                        </tr>
                        <tr>
                            <td>Tempat Acara</td>
                            <td>:</td>
                            <td><?= nl2br($row_warga['tempat_acara']); ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah peserta</td>
                            <td>:</td>
                            <td><?= $row_warga['jumlah_peserta']; ?></td>
                        </tr>
                        <tr>
                            <td>Hiburan</td>
                            <td>:</td>
                            <td><?= $row_warga['hiburan']; ?></td>
                        </tr>
                        <tr>
                            <td>Penanggungjawab Acara</td>
                            <td>:</td>
                            <td><?= $row_warga['penanggungjawab_acara']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-justify">
                                Dengan ini menerangkan bahwa pada dasarnya Pemerintah Desa <?= DESA; ?> tidak berkeberatan atas permohonan Pemohon dengan ketentuan sebagai berikut :
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <ol class="text-justify">
                                    <li>
                                        Pada waktu dilaksanakan Keramaian harus disertai dengan ketentraman dan ketertiban di lingkungan masyarakat/tetangga, menghargai waktu-waktu ibadah dalam menciptakan kerukunan umat beragama dan serta merta memperhatikan kebersihan lingkungan setelah selesai mengadakan Keramaian.
                                    </li>
                                    <li>
                                        Pada waktu dilaksanakan Keramaian tidak dibenarkan/dilarang melakukan hal-hal/kegiatan yang bertentangan dengan norma agama, adat istiadat bangsa, SARA dan tindakan yang melanggar hukum di Negara Kesatuan Republik Indonesia.
                                    </li>
                                    <li>
                                        Apabila terjadi hal-hal yang dapat menimbulkan ketidakondusifan/perpecahan/konflik di lingkungan masyarakat atas dilaksanakannya Keramaian tersebut, maka Pemohon/Penanggungjawab Acara wajib menyelesaikan hal tersebut secara arif dan bijaksana (musyawarah)/menempuh jalur hukum lainnya, sebagai bentuk pertanggungjawaban Pemohon/Penanggungjawab Acara.
                                    </li>
                                    <li>
                                        Apabila dikemudian hari terdapat kekeliruan dari Surat Pengantar ini, maka akan diadakan peninjauan kembali.
                                    </li>
                                </ol>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-borderless table-condensed table-sm w-100 p-0" style="font-size: 0.9rem; line-height: 0.9;">
                            <tbody>
                                <tr>
                                    <td class="text-center">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        Pemohon
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
                        <table class="table table-borderless table-condensed table-sm w-100 p-0" style="font-size: 0.9rem; line-height: 0.9;">
                            <tbody>
                                <tr>
                                    <td class="text-center"><?= DESA; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_pelaporan']); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        Kepala Desa<br />
                                        <?= DESA; ?>
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
                    <div class="col-6">&nbsp;</div>
                    <div class="col-6">
                        <table class="table table-borderless table-condensed table-sm w-100" style="font-size: 0.8rem; line-height:0 .9;">
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        Pertimbangan Kapolsek <?= DESA; ?> :
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 15px;">Nomor</td>
                                    <td style="width: 5px;">:</td>
                                    <td style="border-bottom: 1px solid black;"><?= $row_warga['nomor_kapolsek']; ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px solid black;"><?= tanggal_indo_no_dash($row_warga['tanggal_kapolsek']); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-uppercase">
                                        Atas permohonannya :<br />
                                        <?= $row_warga['diizinkan_kapolsek']; ?> DIIZINKAN, DENGAN CATATAN :<br />
                                        <?= nl2br($row_warga['catatan_kapolsek']); ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 text-center" style="font-size: 0.9rem;">
                        Mengetahui :<br />
                        Danramil <?= KECAMATAN; ?>,<br />
                        <div style="height: 100px;">&nbsp;</div>
                        <?= $row_warga['nama_danramil']; ?><br />
                        NRP.<?= $row_warga['nrp_danramil']; ?>
                    </div>
                    <div class="col-6 text-center" style="font-size: 0.9rem;">
                        <br />
                        Kapolsek <?= KECAMATAN; ?>,<br />
                        <div style="height: 100px;">&nbsp;</div>
                        <?= $row_warga['nama_kapolsek']; ?><br />
                        NRP.<?= $row_warga['nrp_kapolsek']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>&nbsp;</footer>
    <div class="container mt-5">
        <h5 class="h5 text-center">SURAT IZIN LINGKUNGAN</h5>
        <p>Saya yang bertanda tangan dibawah ini :</p>
        <table class="table table-borderless table-condensed table-sm w-100 p-0">
            <tbody>
                <tr>
                    <td style="width: 250px;">Nama</td>
                    <td style="width: 5px;">:</td>
                    <td><?= $row_warga['nama_warga']; ?></td>
                </tr>
                <tr>
                    <td>N I K</td>
                    <td>:</td>
                    <td><?= $row_warga['nik_warga']; ?></td>
                </tr>
                <tr>
                    <td>Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td><?= $row_warga['tempat_lahir_warga']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_warga']); ?></td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td>:</td>
                    <td>
                        <?= umur($row_warga['tanggal_lahir_warga']); ?> TAHUN
                    </td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><?= ($row_warga['jenis_kelamin_warga'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td><?= $row_warga['status_perkawinan_warga']; ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td><?= $row_warga['agama_warga']; ?></td>
                </tr>
                <tr>
                    <td>Kewarganegaraan</td>
                    <td>:</td>
                    <td><?= $row_warga['negara_warga']; ?></td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td><?= $row_warga['pekerjaan_warga']; ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?= $row_warga['alamat_ktp_warga']; ?></td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-justify">
                        Dalam hal ini kami bermaksud memohon Ijin Lingkungan dalam rangka :
                    </td>
                </tr>
                <tr>
                    <td style="width: 250px;">Acara</td>
                    <td style="width: 5px;">:</td>
                    <td><?= $row_warga['acara']; ?></td>
                </tr>
                <tr>
                    <td>Hari/Tanggal</td>
                    <td>:</td>
                    <td><?= full_tanggal_indo_no_dash($row_warga['tanggal_jam_acara']); ?></td>
                </tr>
                <tr>
                    <td>Pukul</td>
                    <td>:</td>
                    <td><?= jam($row_warga['tanggal_jam_acara']); ?></td>
                </tr>
                <tr>
                    <td>Tempat Acara</td>
                    <td>:</td>
                    <td><?= nl2br($row_warga['tempat_acara']); ?></td>
                </tr>
                <tr>
                    <td>Jumlah peserta</td>
                    <td>:</td>
                    <td><?= $row_warga['jumlah_peserta']; ?></td>
                </tr>
                <tr>
                    <td>Hiburan</td>
                    <td>:</td>
                    <td><?= $row_warga['hiburan']; ?></td>
                </tr>
                <tr>
                    <td>Penanggungjawab Acara</td>
                    <td>:</td>
                    <td><?= $row_warga['penanggungjawab_acara']; ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-justify">
                        Izin Lingkungan kami kepada (perwakilan warga/tetangga) :
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row mb-3">
            <div class="col-6">
                <ol>
                    <?php
                    $sql_lingkungan   = "select * from izin_lingkungan where surat_pengantar_izin_keramaian_id = '" . $id . "'";
                    $query_lingkungan = mysqli_query($db, $sql_lingkungan);

                    while ($row_lingkungan = mysqli_fetch_assoc($query_lingkungan)) {
                    ?>
                        <li><?= $row_lingkungan['nama']; ?></li>
                    <?php } ?>
                </ol>
            </div>
            <div class="col-6">
                <?php
                $query_lingkungan = mysqli_query($db, $sql_lingkungan);
                $i = 1;
                while ($row_lingkungan = mysqli_fetch_assoc($query_lingkungan)) {
                ?>
                    <?php if ($i % 2 == 1) { ?>
                        <div class="row">
                            <div class="col-6" style="border-bottom: 1px solid black;"><?= $i; ?>.</div>
                            <div class="col-6"></div>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-6" style="border-bottom: 1px solid black;"><?= $i; ?>.</div>
                        </div>
                <?php
                    }
                    $i++;
                }
                ?>
            </div>
        </div>
        <p class="text-justify">Demikian Permohonan Izin Lingkungan kami buat dengan sebenarnya. Atas kerjasamanya diucapkan terima kasih.</p>
        <div class="row">
            <div class="col-6">
                <table class="table table-borderless table-condensed table-sm w-100 p-0">
                    <tbody>
                        <tr>
                            <td class="text-center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td style="height: 100px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                &nbsp;
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
                                Hormat Saya,
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
        </div>
        <p class="text-center">Mengetahui :</p>
        <div class="row">
            <div class="col-6">
                <table class="table table-borderless table-condensed table-sm w-100 p-0">
                    <tbody>
                        <tr>
                            <td class="text-center">Ketua Lingkungan</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                Rukun Warga <?= $row_warga['no_rw']; ?>,
                            </td>
                        </tr>
                        <tr>
                            <td style="height: 100px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <?= $row_warga['nama_rw']; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-borderless table-condensed table-sm w-100 p-0">
                    <tbody>
                        <tr>
                            <td class="text-center">Ketua Lingkungan</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                Rukun Tetangga <?= $row_warga['no_rt']; ?>,
                            </td>
                        </tr>
                        <tr>
                            <td style="height: 100px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <?= $row_warga['nama_rt']; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer>&nbsp;</footer>
    <div class="container mt-5">
        <h5 class="h5 text-center">SURAT PERNYATAAN</h5>
        <p>Dengan Hormat,</p>
        <p>Saya yang bertanda tangan dibawah ini :</p>
        <table class="table table-borderless table-condensed table-sm w-100 p-0">
            <tbody>
                <tr>
                    <td style="width: 250px;">Nama</td>
                    <td style="width: 5px;">:</td>
                    <td><?= $row_warga['nama_warga']; ?></td>
                </tr>
                <tr>
                    <td>N I K</td>
                    <td>:</td>
                    <td><?= $row_warga['nik_warga']; ?></td>
                </tr>
                <tr>
                    <td>Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td><?= $row_warga['tempat_lahir_warga']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_warga']); ?></td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td>:</td>
                    <td>
                        <?= umur($row_warga['tanggal_lahir_warga']); ?> TAHUN
                    </td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><?= ($row_warga['jenis_kelamin_warga'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td><?= $row_warga['status_perkawinan_warga']; ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td><?= $row_warga['agama_warga']; ?></td>
                </tr>
                <tr>
                    <td>Kewarganegaraan</td>
                    <td>:</td>
                    <td><?= $row_warga['negara_warga']; ?></td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td><?= $row_warga['pekerjaan_warga']; ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?= $row_warga['alamat_ktp_warga']; ?></td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-justify">
                        Selaku Penanggungjawab kegiatan Keramaian :
                    </td>
                </tr>
                <tr>
                    <td style="width: 250px;">Acara</td>
                    <td style="width: 5px;">:</td>
                    <td><?= $row_warga['acara']; ?></td>
                </tr>
                <tr>
                    <td>Hari/Tanggal</td>
                    <td>:</td>
                    <td><?= full_tanggal_indo_no_dash($row_warga['tanggal_jam_acara']); ?></td>
                </tr>
                <tr>
                    <td>Pukul</td>
                    <td>:</td>
                    <td><?= jam($row_warga['tanggal_jam_acara']); ?></td>
                </tr>
                <tr>
                    <td>Tempat Acara</td>
                    <td>:</td>
                    <td><?= nl2br($row_warga['tempat_acara']); ?></td>
                </tr>
                <tr>
                    <td>Jumlah peserta</td>
                    <td>:</td>
                    <td><?= $row_warga['jumlah_peserta']; ?></td>
                </tr>
                <tr>
                    <td>Hiburan</td>
                    <td>:</td>
                    <td><?= $row_warga['hiburan']; ?></td>
                </tr>
            </tbody>
        </table>
        <p class="text-justify">Dengan ini menyatakan bahwa dalam pelaksanaan acara tersebut akan mematuhi peraturan sesuai dengan ketentuan/syarat-syarat sebagai berikut :</p>
        <ol>
            <li>Pada waktu dilaksanakan Keramaian akan disertai dengan ketentraman dan ketertiban di lingkungan masyarakat/tetangga, menghargai waktu-waktu ibadah dalam menciptakan kerukunan umat beragama dan serta merta memperhatikan kebersihan lingkungan setelah selesai mengadakan Keramaian.</li>
            <li>Pada waktu dilaksanakan Keramaian saya menjamin tidak akan melakukan hal-hal/kegiatan/tindakan yang dilarang/melakukan hal-hal/kegiatan/tindakan yang bertentangan dengan norma agama, adat istiadat bangsa, SARA dan tindakan yang melanggar hukum di Negara Kesatuan Republik Indonesia.</li>
            <li>Apabila terjadi hal-hal yang menimbulkan ketidakondusifan/perpecahan/konflik di lingkungan masyarakat atas dilaksanakannya Keramaian tersebut, maka saya bersedia menyelesaikan hal tersebut secara arif dan bijaksana (musyawarah)/menempuh jalur hukum lainnya.</li>
            <li>Selanjutnya saya menyatakan juga dengan sesungguhnya tanpa paksaan bilamana ketentuan/syarat-syarat tersebut dilanggar maka aparat/pejabat yang berwenang dapat mencabut izin/membatalkan acara/keramaiann tersebut, dan segala kerugian yang dialami akibat pencabutan izin/pembatalan acara/keramaian ini kami tidak menuntut ganti rugi apapun terhadap tindakan tersebut.</li>
        </ol>
        <p class="text-justify">Demikian surat pernyataan ini saya buat dengan sebenarnya dalam keadaan sehat jasmani dan rohani untuk diketahui dan dipergunakan seperlunya.</p>
        <div class="row">
            <div class="col-6">
                <table class="table table-borderless table-condensed table-sm w-100 p-0">
                    <tbody>
                        <tr>
                            <td class="text-center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td style="height: 100px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                &nbsp;
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
                                Hormat Saya,
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
        </div>
    </div>
</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>