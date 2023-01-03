<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
require '../constant.php';

$id = $_GET['id'];

$sql = "
SELECT  
    sk_izin_tebang.id,
    sk_izin_tebang.warga_id,
    sk_izin_tebang.luas_lahan,
    sk_izin_tebang.status_lahan,
    sk_izin_tebang.persil_girik_sppt,
    sk_izin_tebang.lokasi_blok,
    sk_izin_tebang.tanggal_pembuatan,
    sk_izin_tebang.no_rt,
    sk_izin_tebang.nama_rt,
    sk_izin_tebang.nama_kepala_desa,
    sk_izin_tebang.nomor_surat,

    
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

FROM sk_izin_tebang 
LEFT JOIN warga ON warga.id_warga = sk_izin_tebang.warga_id
WHERE sk_izin_tebang.id = " . $id . "
";
$query_warga = mysqli_query($db, $sql);
if (mysqli_num_rows($query_warga) == 0) {
    die("Data Warga Tidak Ditemukan");
} else {
    $row_warga = mysqli_fetch_assoc($query_warga);
}

$sql_kayu   = "SELECT * FROM sk_izin_tebang_item WHERE sk_izin_tebang_id = '" . $row_warga['id'] . "'";
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
    </style>
</head>

<body onload="window.print();">

    <!-- <body> -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h4 class="text-center mb-5">SURAT PERNYATAAN PEMILIK POHON</h4>
                <p>Yang bertandatangan dibawah ini :</p>
                <table class="table table-borderless table-condensed table-sm w-100 p-0" style="line-height: 1;">
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?= $row_warga['nama_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tgl. Lahir/Umur</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_lahir_warga']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_warga']); ?></td>
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
                    </tbody>
                </table>
                <p>Dengan ini mengajukan permohonan izin penebangan pohon kayu pada lahan dengan keterangan sebagai berikut :</p>
                <table class="table table-borderless table-condensed table-sm w-100 p-0" style="line-height: 1;">
                    <tbody>
                        <tr>
                            <td style="width: 10px;">a.</td>
                            <td style="width: 50px;">Jenis Kayu</td>
                            <td style="width: 10px;">:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">
                                <ol>
                                    <?php
                                    $query_kayu = mysqli_query($db, $sql_kayu);
                                    while ($row_kayu = mysqli_fetch_assoc($query_kayu)) {
                                        echo '<li>' . $row_kayu['jenis_kayu'] . '</li>';
                                    }
                                    ?>
                                </ol>
                            </td>
                        </tr>
                        <tr>
                            <td>b.</td>
                            <td>Luas Lahan</td>
                            <td>:</td>
                            <td><?= $row_warga['luas_lahan']; ?></td>
                        </tr>
                        <tr>
                            <td>c.</td>
                            <td>Status Lahan</td>
                            <td>:</td>
                            <td><?= $row_warga['status_lahan']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Persil/Girik/SPPT</td>
                            <td>:</td>
                            <td><?= $row_warga['persil_girik_sppt']; ?></td>
                        </tr>
                        <tr>
                            <td>d.</td>
                            <td>Lokasi/Blok</td>
                            <td>:</td>
                            <td><?= $row_warga['lokasi_blok']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <p>Demikian surat pernyataan ini dibuat dengan sebenarnya, apabila pernyataan ini <strong>TIDAK BENAR</strong>, maka saya bersedia dikenakan sangsi sesuai dengan ketentuan yang berlaku. Lokasi pohon tersebut berada dalam wilayah Desa Malingping Selatan.</p>
            </div>
            <div class="col-6">
                <table class="table table-borderless table-condensed table-sm w-100 p-0">
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
                <table class="table table-borderless table-condensed table-sm w-100 p-0">
                    <tbody>
                        <tr>
                            <td class="text-center"><?= DESA; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_pembuatan']); ?></td>
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
        <footer>&nbsp;</footer>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php include('../_partials/print_header.php'); ?>
                <hr style="border-top: 5px solid black;" />
                <table class="table table-borderless table-condensed table-sm w-100 p-0" style="font-size: 0.9rem; line-height: 1;">
                    <tbody>
                        <tr>
                            <th colspan="3" class="h6 text-center">SURAT KETERANGAN</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="h7 text-center">Nomor : <?= $row_warga['nomor_surat']; ?></th>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Yang bertanda tangan dibawah ini Kepala Desa <?= DESA; ?> menerangkan bahwa :
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 250px;">Nama Lengkap</td>
                            <td style="width: 5px;">:</td>
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
                            <td><?= $row_warga['tempat_lahir_warga']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_warga']); ?></td>
                        </tr>
                        <tr>
                            <td>Warganegara</td>
                            <td>:</td>
                            <td><?= $row_warga['negara_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?= ($row_warga['jenis_kelamin_warga'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?= $row_warga['pekerjaan_warga']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat KTP</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_ktp_warga']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-justify">
                                Berdasarkan hasil penelitian kami dilapangan dan data di desa, orang yang tercantum diatas adalah benar mempunyai Lahan/Tanah di wilayah administrasi Desa Malingping Selatan, dengan data-data sebagai berikut :
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 250px;">a. Luas Lahan</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['luas_lahan']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 250px;">b. Persil/Girik/SPPT</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['persil_girik_sppt']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 250px;">c. Lokasi/Blok</td>
                            <td style="width: 5px;">:</td>
                            <td><?= $row_warga['lokasi_blok']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-justify">
                                Adapun lahan/tanah tersebut terdapat jenis pohon/kayu tersebut sebagai berikut :
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered table-condensed table-sm w-100 p-0" style="font-size: 0.9rem; line-height: 1;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Jenis Pohon/Kayu</th>
                            <th>Banyaknya</th>
                            <th>Perkiraan Hasil Klem (m³)</th>
                            <th>Ket.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_kayu = mysqli_query($db, $sql_kayu);
                        $no = 1;
                        while ($row_kayu = mysqli_fetch_assoc($query_kayu)) {
                            echo '<tr>';
                            echo '<td>' . $no++ . '.</td>';
                            echo '<td>' . $row_kayu['jenis_kayu'] . '</td>';
                            echo '<td>' . $row_kayu['jumlah_batang'] . ' Batang</td>';
                            echo '<td>' . $row_kayu['hasil_klem'] . '</td>';
                            echo '<td>' . $row_kayu['keterangan'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-borderless table-condensed table-sm w-100 p-0" style="font-size: 0.9rem;">
                            <tbody>
                                <tr>
                                    <td class="text-center">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-center">

                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 100px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-center">

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-borderless table-condensed table-sm w-100 p-0" style="font-size: 0.9rem;">
                            <tbody>
                                <tr>
                                    <td class="text-center"><?= DESA; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_pembuatan']); ?></td>
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
            </div>
        </div>
    </div>
    <footer>&nbsp;</footer>
    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <table class="table table-borderless table-condensed table-sm w-100 p-0" style="line-height: 1;">
                    <tbody>
                        <tr>
                            <td>Perihal</td>
                            <td>:</td>
                            <td>Permohonan Izin<br />Penebangan Pohon/Kayu</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-borderless table-condensed table-sm w-100 p-0" style="line-height: 1;">
                    <tbody>
                        <tr>
                            <td></td>
                            <td style="width: 30px;">Kepada</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Yth.</td>
                            <td colspan="3">Ketua TimTeknis Pelayanan Perizinan Terpadu <?= KOKAB; ?></td>
                        </tr>
                        <tr>
                            <td>c.q.</td>
                            <td colspan="3">Ketua Tim Teknis Pelayanan Perizinan Terpadu Kecamatan <?= KECAMATAN; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <p>Yang bertandatangan dibawah ini :</p>
        <table class="table table-borderless table-condensed table-sm w-100 p-0" style="line-height: 1;">
            <tbody>
                <tr>
                    <td style="width: 250px;">Nama</td>
                    <td style="width: 10px;">:</td>
                    <td><?= $row_warga['nama_warga']; ?></td>
                </tr>
                <tr>
                    <td>Tempat, Tgl. Lahir/Umur</td>
                    <td>:</td>
                    <td><?= $row_warga['tempat_lahir_warga']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_warga']); ?></td>
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
            </tbody>
        </table>
        <p>Dengan ini mengajukan permohonan izin penebangan pohon/kayu pada lahan Milik dengan keterangan sebagai berikut :</p>
        <table class="table table-borderless table-condensed table-sm w-100 p-0" style="line-height: 1;">
            <tbody>
                <tr>
                    <td style="width: 10px;">a.</td>
                    <td style="width: 150px;">Jenis Pohon/Kayu</td>
                    <td style="width: 10px;">:</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">
                        <ol>
                            <?php
                            $query_kayu = mysqli_query($db, $sql_kayu);
                            while ($row_kayu = mysqli_fetch_assoc($query_kayu)) {
                                echo '<li>' . $row_kayu['jenis_kayu'] . '</li>';
                            }
                            ?>
                        </ol>
                    </td>
                </tr>
                <tr>
                    <td>b.</td>
                    <td>Luas Lahan</td>
                    <td>:</td>
                    <td><?= $row_warga['luas_lahan']; ?></td>
                </tr>
                <tr>
                    <td>c.</td>
                    <td>Status Lahan</td>
                    <td>:</td>
                    <td><?= $row_warga['status_lahan']; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Persil/Girik/SPPT</td>
                    <td>:</td>
                    <td><?= $row_warga['persil_girik_sppt']; ?></td>
                </tr>
                <tr>
                    <td>d.</td>
                    <td>Lokasi/Blok</td>
                    <td>:</td>
                    <td><?= $row_warga['lokasi_blok']; ?></td>
                </tr>
            </tbody>
        </table>
        <p class="text-justify">Sebagai bahan pertimbangan Bapak/Ibu, Daftar Klaim Tegakan dan Surat Keterangan dari Desa terlampir. Demikian permohonan ini saya buat dengan sebenarnya, atas perhatiannya saya ucapkan terima kasih.</p>
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
                            <td class="text-center"><?= DESA; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_pembuatan']); ?></td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                Pemohon,
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