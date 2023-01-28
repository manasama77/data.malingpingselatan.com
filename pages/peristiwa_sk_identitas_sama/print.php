<?php
include('../../config/koneksi.php');
require '../helper_tanggal_indo.php';
require '../constant.php';

$id = $_GET['id'];

$sql = "
SELECT  
    sk_identitas_sama.id,
    sk_identitas_sama.nomor_surat,
    sk_identitas_sama.data_di_1,
    sk_identitas_sama.warga_1,
    sk_identitas_sama.data_di_2,
    sk_identitas_sama.warga_2,
    sk_identitas_sama.tanggal_pembuatan,
    sk_identitas_sama.nama_kepala_desa,

    
    warga_1.nama_warga as nama_warga_1,
    warga_1.nik_warga as nik_warga_1,
    warga_1.tempat_lahir_warga as tempat_lahir_warga_1,
    warga_1.tanggal_lahir_warga as tanggal_lahir_warga_1,
    warga_1.jenis_kelamin_warga as jenis_kelamin_warga_1,
    warga_1.negara_warga as negara_warga_1,
    warga_1.status_perkawinan as status_perkawinan_warga_1,
    warga_1.agama_warga as agama_warga_1,
    warga_1.pekerjaan_warga as pekerjaan_warga_1,
    warga_1.alamat_ktp_warga as alamat_ktp_warga_1,

    warga_2.nama_warga as nama_warga_2,
    warga_2.nik_warga as nik_warga_2,
    warga_2.tempat_lahir_warga as tempat_lahir_warga_2,
    warga_2.tanggal_lahir_warga as tanggal_lahir_warga_2,
    warga_2.jenis_kelamin_warga as jenis_kelamin_warga_2,
    warga_2.negara_warga as negara_warga_2,
    warga_2.status_perkawinan as status_perkawinan_warga_2,
    warga_2.agama_warga as agama_warga_2,
    warga_2.pekerjaan_warga as pekerjaan_warga_2,
    warga_2.alamat_ktp_warga as alamat_ktp_warga_2

FROM sk_identitas_sama 
LEFT JOIN warga as warga_1 ON warga_1.id_warga = sk_identitas_sama.warga_1
LEFT JOIN warga AS warga_2 ON warga_2.id_warga = sk_identitas_sama.warga_2
WHERE sk_identitas_sama.id = " . $id . "
ORDER BY sk_identitas_sama.id DESC
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
                <h5 class="h5 text-center">SURAT PERNYATAAN IDENTITAS YANG SAMA</h5>
                <h6 class="h6 text-center">Nomor : <?= $row_warga['nomor_surat']; ?></h6>
                <p>Yang bertanda tangan dibawah ini Kepala Desa Malingping Selatan menerangkan bahwa :</p>
                <table class="table table-borderless table-condensed table-sm w-100 p-0">
                    <tbody>
                        <tr>
                            <td style="width: 10px;">1.</td>
                            <td style="width: 170px;">Data di</td>
                            <td style="width: 10px;">:</td>
                            <td><?= $row_warga['data_di_1']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?= $row_warga['nama_warga_1']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_warga_1']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tempat, Tgl. Lahir</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_lahir_warga_1']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_warga_1']); ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?= ($row_warga['jenis_kelamin_warga_1'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_ktp_warga_1']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-borderless table-condensed table-sm w-100 p-0">
                    <tbody>
                        <tr>
                            <td style="width: 10px;">2.</td>
                            <td style="width: 170px;">Data di</td>
                            <td style="width: 10px;">:</td>
                            <td><?= $row_warga['data_di_2']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?= $row_warga['nama_warga_2']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $row_warga['nik_warga_2']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tempat, Tgl. Lahir</td>
                            <td>:</td>
                            <td><?= $row_warga['tempat_lahir_warga_2']; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_lahir_warga_2']); ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?= ($row_warga['jenis_kelamin_warga_2'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $row_warga['alamat_ktp_warga_2']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <p>Berdasarkan data identitas diatas, nama tersebut menunjuk kepada 1 (satu) orang yang sama.</p>
                <p>Demikian keterangan ini dibuat dan diberikan atas dasar yang sebenarnya dan kepada yang berkepentingan agar dipergunakan sebagaimana mestinya.</p>
                <div class="row">
                    <div class="col-sm-6 offset-sm-6 text-center">
                        <?= DESA; ?>, <?= tanggal_indo_no_dash($row_warga['tanggal_pembuatan']); ?>
                    </div>
                    <div class="col-sm-6 offset-sm-6 text-center">
                        Kepala Desa,
                    </div>
                    <div class="col-sm-6 offset-sm-6 text-center" style="height: 100px;">
                        &nbsp;
                    </div>
                    <div class="col-sm-6 offset-sm-6 text-center">
                        <?= $row_warga['nama_kepala_desa']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>