<?php
include __DIR__ . '../../_partials/top.php';
require '../helper_tanggal_indo.php';
include('../../config/koneksi.php');

$sql   = "
SELECT  
    sk_pemakaman.id,
    sk_pemakaman.jenazah_id,
    sk_pemakaman.tanggal_meninggal,
    sk_pemakaman.penyebab_kematian,
    sk_pemakaman.pengurus_pemakaman,
    sk_pemakaman.dimakamkan_di,
    sk_pemakaman.pelapor_id,
    sk_pemakaman.tanggal_pelaporan,
    sk_pemakaman.nama_kepala_desa,
    sk_pemakaman.nrp,
    sk_pemakaman.nomor_surat,
    
    jenazah.nama_warga as nama_jenazah,
    jenazah.nik_warga as nik_jenazah,
    jenazah.tempat_lahir_warga as tempat_lahir_jenazah,
    jenazah.tanggal_lahir_warga as tanggal_lahir_jenazah,
    jenazah.jenis_kelamin_warga as jenis_kelamin_jenazah,
    jenazah.negara_warga as negara_jenazah,
    jenazah.status_perkawinan as status_perkawinan_jenazah,
    jenazah.agama_warga as agama_jenazah,
    jenazah.pekerjaan_warga as pekerjaan_jenazah,
    jenazah.alamat_ktp_warga as alamat_ktp_jenazah,

    pelapor.nama_warga as nama_pelapor,
    pelapor.nik_warga as nik_pelapor,
    pelapor.tempat_lahir_warga as tempat_lahir_pelapor,
    pelapor.tanggal_lahir_warga as tanggal_lahir_pelapor,
    pelapor.jenis_kelamin_warga as jenis_kelamin_pelapor,
    pelapor.negara_warga as negara_pelapor,
    pelapor.status_perkawinan as status_perkawinan_pelapor,
    pelapor.agama_warga as agama_pelapor,
    pelapor.pekerjaan_warga as pekerjaan_pelapor,
    pelapor.alamat_ktp_warga as alamat_ktp_pelapor
FROM sk_pemakaman 
LEFT JOIN warga as jenazah ON jenazah.id_warga = sk_pemakaman.jenazah_id
LEFT JOIN warga as pelapor ON pelapor.id_warga = sk_pemakaman.pelapor_id
ORDER BY sk_pemakaman.id DESC
";
$query = mysqli_query($db, $sql);
?>

<div class="row page-header">
    <div class="col-sm-12 col-md-6">
        <h4>
            Peristiwa - Surat Keterangan Pemakaman
        </h4>
    </div>
    <div class="col-sm-12 col-md-6 text-right">
        <a href="create.php" class="btn btn-primary">
            <i class="fa fa-plus"></i> Tambah Data
        </a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table id="table_data" class="table table-bordered">
                <caption>Daftar Surat Keterangan Pemakaman</caption>
                <thead class="bg-primary">
                    <tr>
                        <th style="width: 150px;">Tanggal Pelaporan</th>
                        <th style="width: 200px;">Jenazah</th>
                        <th style="width: 100px;">Tanggal Meninggal</th>
                        <th style="width: 200px;">Penyebab</th>
                        <th style="width: 250px;">Pelapor</th>
                        <td class="text-center" style="width: 150px;">
                            <i class="fa fa-cog"></i>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($query) > 0) { ?>
                        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <td>
                                    <?= tanggal_indo_no_dash($row['tanggal_pelaporan']); ?>
                                </td>
                                <td><?= $row['nama_jenazah']; ?></td>
                                <td>
                                    <?= tanggal_indo_no_dash($row['tanggal_meninggal']); ?>
                                </td>
                                <td><?= $row['penyebab_kematian']; ?></td>
                                <td><?= $row['nama_pelapor']; ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning" title="Edit Data">
                                            <i class="fa fa-pencil fa-fw"></i>
                                        </a>
                                        <a href="print.php?id=<?= $row['id']; ?>" target="_blank" class="btn btn-success" title="Print Data">
                                            <i class="fa fa-print fa-fw"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" title="Delete Data" onclick="deleteData(<?= $row['id']; ?>, '<?= $row['nama_jenazah']; ?>')">
                                            <i class="fa fa-trash fa-fw"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php }; ?>
                    <?php }; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include __DIR__ . '../../_partials/bottom.php' ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js" integrity="sha512-eYSzo+20ajZMRsjxB6L7eyqo5kuXuS2+wEbbOkpaur+sA2shQameiJiWEzCIDwJqaB0a4a6tCuEvCOBHUg3Skg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(e => {
        $("#table_data").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
            "ordering": false
        })
    })

    function deleteData(id, namaWarga) {
        Swal.fire({
            title: 'Delete Data?',
            html: `Kamu akan menghapus data warga ${namaWarga}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus Data!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `ajax_destroy_warga.php`,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    beforeSend: () => {
                        $.blockUI()
                    }
                }).fail(e => {
                    $.unblockUI()
                    Swal.fire({
                        icon: 'warning',
                        html: e.responseText,
                    })
                }).done(e => {
                    if (e.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data Berhasil Dihapus',
                            showConfirmButton: false,
                            timer: 2000,
                            toast: true
                        }).then(() => window.location.reload())
                    } else {
                        $.unblockUI()
                        Swal.fire({
                            icon: 'error',
                            html: e.msg,
                        })
                    }
                })
            }
        })
    }
</script>