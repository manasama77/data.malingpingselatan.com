<?php
include __DIR__ . '../../_partials/top.php';
require '../helper_tanggal_indo.php';
include('../../config/koneksi.php');

$sql   = "
SELECT  
    surat_kuasa.id,
    surat_kuasa.warga_1_id,
    surat_kuasa.warga_2_id,
    surat_kuasa.tanggal_kuasa,
    surat_kuasa.keperluan,
    surat_kuasa.tanggal_pelaporan,
    surat_kuasa.saksi_1,
    surat_kuasa.saksi_2,
    surat_kuasa.saksi_3,
    surat_kuasa.nama_kepala_desa,
    surat_kuasa.nomor_surat,
    
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

FROM surat_kuasa 
LEFT JOIN warga as warga_1 ON warga_1.id_warga = surat_kuasa.warga_1_id
LEFT JOIN warga AS warga_2 ON warga_2.id_warga = surat_kuasa.warga_2_id
ORDER BY surat_kuasa.id DESC
";
$query = mysqli_query($db, $sql);
?>

<div class="row page-header">
    <div class="col-sm-12 col-md-6">
        <h4>
            Peristiwa - Surat Kuasa
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
                <caption>Daftar Surat Kuasa</caption>
                <thead class="bg-primary">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-cog"></i>
                        </td>
                        <th>Tanggal Pembuatan</th>
                        <th>Memberi Kuasa</th>
                        <th>Diberi Kuasa</th>
                        <th>Tanggal Kuasa</th>
                        <th>Keperluan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($query) > 0) { ?>
                        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning" title="Edit Data">
                                            <i class="fa fa-pencil fa-fw"></i>
                                        </a>
                                        <a href="print.php?id=<?= $row['id']; ?>" target="_blank" class="btn btn-success" title="Print Data">
                                            <i class="fa fa-print fa-fw"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" title="Delete Data" onclick="deleteData(<?= $row['id']; ?>, '<?= $row['nama_warga_1']; ?>')">
                                            <i class="fa fa-trash fa-fw"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <?= tanggal_indo_no_dash($row['tanggal_pelaporan']); ?>
                                </td>
                                <td><?= $row['nama_warga_1']; ?></td>
                                <td><?= $row['nama_warga_2']; ?></td>
                                <td>
                                    <?= tanggal_indo_no_dash($row['tanggal_kuasa']); ?>
                                </td>
                                <td><?= $row['keperluan']; ?></td>
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