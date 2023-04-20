<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
require '../constant.php';

$id = $_GET['id'];

$sql = "
SELECT  
    sk_datang_wni.id,
    sk_datang_wni.no_kk,
    sk_datang_wni.nama_kepala_keluarga,
    sk_datang_wni.f_kampung,
    sk_datang_wni.f_rt,
    sk_datang_wni.f_rw,
    sk_datang_wni.f_desa,
    sk_datang_wni.f_kecamatan,
    sk_datang_wni.f_kodepos,
    sk_datang_wni.f_kabupaten,
    sk_datang_wni.f_provinsi,
    sk_datang_wni.alasan_pindah,
    sk_datang_wni.alasan_pindah_lainnya,
    sk_datang_wni.t_kampung,
    sk_datang_wni.t_rt,
    sk_datang_wni.t_rw,
    sk_datang_wni.t_desa,
    sk_datang_wni.t_kecamatan,
    sk_datang_wni.t_kodepos,
    sk_datang_wni.t_kabupaten,
    sk_datang_wni.t_provinsi,
    sk_datang_wni.klasifikasi_pindah,
    sk_datang_wni.jenis_kepindahan,
    sk_datang_wni.status_no_kk_tidak_pindah,
    sk_datang_wni.status_no_kk_pindah,
    sk_datang_wni.tanggal_kedatangan,
    sk_datang_wni.no_camat,
    sk_datang_wni.nama_camat,
    sk_datang_wni.nip_camat,
    sk_datang_wni.nama_pemohon,
    sk_datang_wni.nama_kepala_desa,
    sk_datang_wni.nrp,
    sk_datang_wni.nomor_surat,
    sk_datang_wni.tanggal_pembuatan

FROM sk_datang_wni 
WHERE sk_datang_wni.id = " . $id . "
ORDER BY sk_datang_wni.id DESC
";
$query_warga = mysqli_query($db, $sql);
if (mysqli_num_rows($query_warga) == 0) {
    die("Data Warga Tidak Ditemukan");
} else {
    $row_warga = mysqli_fetch_assoc($query_warga);
}

$sql_kayu   = "SELECT * FROM sk_datang_wni_warga WHERE sk_datang_wni_id = '" . $row_warga['id'] . "'";
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

        .table-x tr td {
            line-height: 14px;
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
                <table class="table table-borderless table-condensed table-sm w-100 p-0" style="line-height: 1;">
                    <tbody>
                        <tr>
                            <td style="width: 150px;">PROVINSI</td>
                            <td style="width: 10px;">:</td>
                            <td><?= KODE_PROVINSI; ?></td>
                            <td><?= PROVINSI; ?></td>
                        </tr>
                        <tr>
                            <td>KABUPATEN</td>
                            <td>:</td>
                            <td><?= KODE_KOKAB; ?></td>
                            <td><?= KOKAB; ?></td>
                        </tr>
                        <tr>
                            <td>KECAMATAN</td>
                            <td>:</td>
                            <td><?= KODE_KECAMATAN; ?></td>
                            <td><?= KECAMATAN; ?></td>
                        </tr>
                        <tr>
                            <td>DESA</td>
                            <td>:</td>
                            <td><?= KODE_DESA; ?></td>
                            <td><?= DESA; ?></td>
                        </tr>
                    </tbody>
                </table>
                <h4 class="text-center font-weight-bold">SURAT KETERANGAN DATANG WNI</h4>
                <p class="h7 text-center">Nomor : <?= $row_warga['nomor_surat']; ?></p>

                <p style="font-size: 0.9rem; font-weight: 700;">DATA DAERAH ASAL :</p>
                <table class="table table-borderless table-condensed table-sm w-100 p-0" style="font-size: 0.9rem; line-height: 0.8;">
                    <tbody>
                        <tr>
                            <td style="width: 20px; padding-left: 20px;">1.</td>
                            <td style="width: 250px;">Nomor Kartu Keluarga</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['no_kk']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20px; padding-left: 20px;">2.</td>
                            <td>Nama Kepala Keluarga</td>
                            <td>:</td>
                            <td><?= $row_warga['nama_kepala_keluarga']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20px; padding-left: 20px;">3.</td>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>
                                KP. <?= ($row_warga['f_kampung'] == "") ? $row_warga['f_kampung'] : "-"; ?>
                                RT: <?= $row_warga['f_rt']; ?>
                                RW: <?= $row_warga['f_rw']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20px; padding-left: 20px;"></td>
                            <td>a. Desa</td>
                            <td></td>
                            <td><?= $row_warga['f_desa']; ?></td>
                            <td style="width: 20px; padding-left: 20px;"></td>
                            <td>c. Kabupaten</td>
                            <td></td>
                            <td><?= $row_warga['f_kabupaten']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20px; padding-left: 20px;"></td>
                            <td>b. Kecamatan</td>
                            <td></td>
                            <td><?= $row_warga['f_kecamatan']; ?></td>
                            <td style="width: 20px; padding-left: 20px;"></td>
                            <td>d. Provinsi</td>
                            <td></td>
                            <td><?= $row_warga['f_provinsi']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20px; padding-left: 20px;"></td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;Kode Pos</td>
                            <td></td>
                            <td><?= $row_warga['f_kodepos']; ?></td>
                        </tr>
                    </tbody>
                </table>

                <p style="font-size: 0.9rem; font-weight: 700;">DATA KEPINDAHAN :</p>
                <table class="table table-borderless table-condensed table-sm w-100 p-0" style="font-size: 0.9rem; line-height: 0.8;">
                    <tbody>
                        <tr>
                            <td style="width: 20px; padding-left: 20px;">1.</td>
                            <td style="width: 250px;">Alasan Pindah</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['alasan_pindah']; ?></td>
                            <td colspan="4" style="width: 200px;">
                                <table class="table table-borderless table-condensed table-sm w-100 p-0" style="font-size: 0.7rem; line-height: 0.8;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 100px;">1. Pekerjaan</td>
                                            <td style="width: 20px;">&nbsp;</td>
                                            <td style="width: 100px;">4. Kesehatan</td>
                                            <td style="width: 20px;">&nbsp;</td>
                                            <td style="width: 150px;">
                                                7. Lainnnya (sebutkan)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100px;">2. Pendidikan</td>
                                            <td style="width: 20px;">&nbsp;</td>
                                            <td style="width: 100px;">5. Perumahan</td>
                                            <td style="width: 20px;">&nbsp;</td>
                                            <td style="width: 150px;">
                                                <?= $row_warga['alasan_pindah_lainnya']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100px;">3. Keamanan</td>
                                            <td style="width: 20px;">&nbsp;</td>
                                            <td style="width: 100px;">6. Keluarga</td>
                                            <td style="width: 20px;">&nbsp;</td>
                                            <td style="width: 150px;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 20px; padding-left: 20px;">2.</td>
                            <td>Alamat Tujuan Pindah</td>
                            <td>:</td>
                            <td>
                                KP. <?= ($row_warga['t_kampung'] == "") ? $row_warga['t_kampung'] : "-"; ?>
                                RT: <?= $row_warga['t_rt']; ?>
                                RW: <?= $row_warga['t_rw']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20px; padding-left: 20px;"></td>
                            <td>a. Desa</td>
                            <td></td>
                            <td><?= $row_warga['t_desa']; ?></td>
                            <td style="width: 20px; padding-left: 20px;"></td>
                            <td>c. Kabupaten</td>
                            <td></td>
                            <td><?= $row_warga['t_kabupaten']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20px; padding-left: 20px;"></td>
                            <td>b. Kecamatan</td>
                            <td></td>
                            <td><?= $row_warga['t_kecamatan']; ?></td>
                            <td style="width: 20px; padding-left: 20px;"></td>
                            <td>d. Provinsi</td>
                            <td></td>
                            <td><?= $row_warga['t_provinsi']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20px; padding-left: 20px;"></td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;Kode Pos</td>
                            <td></td>
                            <td><?= $row_warga['t_kodepos']; ?></td>
                        </tr>

                        <tr>
                            <td style="width: 20px; padding-left: 20px;">3.</td>
                            <td style="width: 250px;">Klasifikasi Pindah</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['klasifikasi_pindah']; ?></td>
                            <td colspan="4" style="width: 200px;">
                                <table class="table table-borderless table-condensed table-sm w-100 p-0" style="font-size: 0.7rem; line-height: 0.8;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 100px;">1. Dalam Satu Desa/Kelurahan</td>
                                            <td style="width: 20px;">&nbsp;</td>
                                            <td style="width: 100px;">4. Antar Kabupaten/Kota</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100px;">2. Antar Desa/Kelurahan</td>
                                            <td style="width: 20px;">&nbsp;</td>
                                            <td style="width: 100px;">5. Antar Provinsi</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100px;">3. Antar Kecamatan </td>
                                            <td style="width: 20px;">&nbsp;</td>
                                            <td style="width: 100px;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 20px; padding-left: 20px;">4.</td>
                            <td style="width: 250px;">Jenis Kepindahan</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['jenis_kepindahan']; ?></td>
                            <td colspan="4" style="width: 200px;">
                                <table class="table table-borderless table-condensed table-sm w-100 p-0 table-x" style="font-size: 0.7rem; line-height: 0.8;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 100px;">1. Kepala Keluarga</td>
                                            <td style="width: 20px;">&nbsp;</td>
                                            <td style="width: 100px;">3. Kepala Keluarga sebagai Anggota Keluarga</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100px;">2. Kepala Keluarga dan Seluruh Anggota Keluarga</td>
                                            <td style="width: 20px;">&nbsp;</td>
                                            <td style="width: 100px;">4. Anggota Kelurga</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 20px; padding-left: 20px;">5.</td>
                            <td style="width: 250px;">Status Nomor Kartu Keluarga bagi yang Tidak Pindah</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['status_no_kk_tidak_pindah']; ?></td>
                            <td colspan="4" style="width: 200px;">
                                <table class="table table-borderless table-condensed table-sm w-100 p-0 table-x" style="font-size: 0.7rem; line-height: 0.8;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 100px;">1. Numpang Kartu Keluarga</td>
                                            <td style="width: 20px;">&nbsp;</td>
                                            <td style="width: 100px;">3. Tidak Ada Anggota Keluarga yang Ditinggal</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100px;">2. Membuat Kartu Keluarga Baru</td>
                                            <td style="width: 20px;">&nbsp;</td>
                                            <td style="width: 100px;">4. Nomor Kartu Keluarga Tetap</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 20px; padding-left: 20px;">6.</td>
                            <td style="width: 250px;">Status Nomor Kartu Keluarga bagi yang Pindah</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['status_no_kk_pindah']; ?></td>
                            <td colspan="4" style="width: 200px;">
                                <table class="table table-borderless table-condensed table-sm w-100 p-0 table-x" style="font-size: 0.7rem; line-height: 0.8;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 100px;">1. Numpang Kartu Keluarga</td>
                                            <td style="width: 20px;">&nbsp;</td>
                                            <td style="width: 100px;">3. Nama Kepala Keluarga dan Nomor Kartu Keluarga Tetap</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100px;">2. Membuat Kartu Keluarga Baru</td>
                                            <td style="width: 20px;">&nbsp;</td>
                                            <td style="width: 100px;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 20px; padding-left: 20px;">7.</td>
                            <td style="width: 250px;">Tanggal Kedatangan</td>
                            <td style="width: 5px;">:</td>
                            <td>
                                <?= tanggal_indo_no_dash($row_warga['tanggal_kedatangan']); ?>
                            </td>
                            <td colspan="4" style="width: 200px;">
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 20px; padding-left: 20px;">8.</td>
                            <td style="width: 250px;">Keluarga yang Datang</td>
                            <td style="width: 5px;">:</td>
                            <td colspan="5"></td>
                        </tr>

                        <tr>
                            <td colspan="8">
                                <table class="table table-bordered table-condensed table-sm w-100 p-0" style="font-size: 0.9rem; line-height: 0.8;">
                                    <thead>
                                        <tr>
                                            <td class="font-weight-bold text-center">NO.</td>
                                            <td class="font-weight-bold text-center">NIK</td>
                                            <td class="font-weight-bold text-center">NAMA</td>
                                            <td class="font-weight-bold text-center">TEMPAT, TGL. LAHIR</td>
                                            <td class="font-weight-bold text-center">SHDK</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql_sub = "SELECT * FROM sk_datang_wni_warga WHERE sk_datang_wni_id = '" . $row_warga['id'] . "'";
                                        $query_sub = mysqli_query($db, $sql_sub);
                                        $no_sub = 1;
                                        while ($row_sub = mysqli_fetch_assoc($query_sub)) {
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $no_sub++; ?></td>
                                                <td class="text-center"><?= $row_sub['nik']; ?></td>
                                                <td><?= $row_sub['nama']; ?></td>
                                                <td class="text-center"><?= $row_sub['tempat_lahir']; ?>, <?= tanggal_indo_no_dash($row_sub['tanggal_lahir']); ?></td>
                                                <td class="text-center"><?= $row_sub['shdk']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-4">
                        <table class="table table-borderless table-condensed table-sm w-100 p-0" style="font-size: 0.9rem;">
                            <tbody>
                                <tr>
                                    <td class="text-center">Diketahui :</td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        Camat <?= KECAMATAN; ?>,
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        Nomor: <?= $row_warga['no_camat']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 80px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <?= $row_warga['nama_camat']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        NIP. <?= $row_warga['nip_camat']; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-4">
                        <table class="table table-borderless table-condensed table-sm w-100 p-0" style="font-size: 0.9rem;">
                            <tbody>
                                <tr>
                                    <td class="text-center">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        Pemohon,
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 80px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <?= $row_warga['nama_pemohon']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        &nbsp;
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-4">
                        <table class="table table-borderless table-condensed table-sm w-100 p-0" style="font-size: 0.9rem;">
                            <tbody>
                                <tr>
                                    <td class="text-center">Dikeluarkan oleh :</td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        a.n Kepala Desa
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        Kepala Urusan Umum,
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 80px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <?= $row_warga['nama_kepala_desa']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        NRPDes. <?= $row_warga['nrp']; ?>
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