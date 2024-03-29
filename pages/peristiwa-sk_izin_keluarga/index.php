<?php
include __DIR__ . '../../_partials/top.php';
require '../helper_tanggal_indo.php';
include('../../config/koneksi.php');

$sql   = "
SELECT  
    sk_izin_keluarga.id,
    sk_izin_keluarga.warga_id,
    sk_izin_keluarga.jenis_relasi,
    sk_izin_keluarga.keluarga_id,
    sk_izin_keluarga.keperluan,
    sk_izin_keluarga.tanggal_pelaporan,
    sk_izin_keluarga.nama_kepala_desa,
    sk_izin_keluarga.nrp,
    sk_izin_keluarga.nomor_surat,
    warga.nama_warga,
    warga.nik_warga,
    warga.tempat_lahir_warga,
    warga.tanggal_lahir_warga,
    warga.jenis_kelamin_warga,
    warga.negara_warga,
    warga.status_perkawinan,
    warga.agama_warga,
    warga.pekerjaan_warga,
    warga.alamat_ktp_warga,

    keluarga.nama_warga as nama_keluarga,
    keluarga.nik_warga as nik_keluarga,
    keluarga.tempat_lahir_warga as tempat_lahir_keluarga,
    keluarga.tanggal_lahir_warga as tanggal_lahir_keluarga,
    keluarga.jenis_kelamin_warga as jenis_kelamin_keluarga,
    keluarga.negara_warga as negara_keluarga,
    keluarga.status_perkawinan as status_keluarga,
    keluarga.agama_warga as agama_keluarga,
    keluarga.pekerjaan_warga as pekerjaan_keluarga,
    keluarga.alamat_ktp_warga as alamat_ktp_keluarga
FROM sk_izin_keluarga 
LEFT JOIN warga ON warga.id_warga = sk_izin_keluarga.warga_id
LEFT JOIN warga as keluarga ON keluarga.id_warga = sk_izin_keluarga.keluarga_id
ORDER BY sk_izin_keluarga.id DESC
";
$query = mysqli_query($db, $sql);
?>

<div class="row page-header">
    <div class="col-sm-12 col-md-6">
        <h4>
            Peristiwa - Surat Keterangan Izin Keluarga
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
            <table id="table_data" class="table table-bordered w-100">
                <caption>Daftar Surat Keterangan Izin Keluarga</caption>
                <thead class="bg-primary">
                    <tr>
                        <th style="width: 150px;">Tanggal Pelaporan</th>
                        <th style="width: 200px;">Warga</th>
                        <th style="width: 100px;">Izin Untuk</th>
                        <th style="width: 200px;">Keluarga</th>
                        <th style="width: 250px;">Keperluan</th>
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
                                <td><?= $row['nama_warga']; ?></td>
                                <td><?= $row['jenis_relasi']; ?></td>
                                <td><?= $row['nama_keluarga']; ?></td>
                                <td><?= $row['keperluan']; ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning" title="Edit Data">
                                            <i class="fa fa-pencil fa-fw"></i>
                                        </a>
                                        <a href="print.php?id=<?= $row['id']; ?>" target="_blank" class="btn btn-success" title="Print Data">
                                            <i class="fa fa-print fa-fw"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" title="Delete Data" onclick="deleteData(<?= $row['id']; ?>, '<?= $row['nama_warga']; ?>')">
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