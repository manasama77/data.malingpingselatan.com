<?php
include __DIR__ . '../../_partials/top.php';
require '../helper_tanggal_indo.php';
include('../../config/koneksi.php');

$sql   = "
SELECT  
    sk_telah_menikah.id,
    sk_telah_menikah.pelapor_id,
    sk_telah_menikah.pasangan_id,
    sk_telah_menikah.tanggal_menikah,
    sk_telah_menikah.tempat_menikah,
    sk_telah_menikah.nama_wali_nikah,
    sk_telah_menikah.nama_penghulu_nikah,
    sk_telah_menikah.tanggal_pelaporan,
    sk_telah_menikah.nama_kepala_desa,
    sk_telah_menikah.nrp,
    sk_telah_menikah.saksi_1,
    sk_telah_menikah.saksi_2,
    sk_telah_menikah.saksi_3,
    sk_telah_menikah.nomor_surat,
    
    pelapor.nama_warga as nama_pelapor,
    pelapor.nik_warga as nik_pelapor,
    pelapor.tempat_lahir_warga as tempat_lahir_pelapor,
    pelapor.tanggal_lahir_warga as tanggal_lahir_pelapor,
    pelapor.jenis_kelamin_warga as jenis_kelamin_pelapor,
    pelapor.negara_warga as negara_pelapor,
    pelapor.status_perkawinan as status_perkawinan_pelapor,
    pelapor.agama_warga as agama_pelapor,
    pelapor.pekerjaan_warga as pekerjaan_pelapor,
    pelapor.alamat_ktp_warga as alamat_ktp_pelapor,

    pasangan.nama_warga as nama_pasangan,
    pasangan.nik_warga as nik_pasangan,
    pasangan.tempat_lahir_warga as tempat_lahir_pasangan,
    pasangan.tanggal_lahir_warga as tanggal_lahir_pasangan,
    pasangan.jenis_kelamin_warga as jenis_kelamin_pasangan,
    pasangan.negara_warga as negara_pasangan,
    pasangan.status_perkawinan as status_perkawinan_pasangan,
    pasangan.agama_warga as agama_pasangan,
    pasangan.pekerjaan_warga as pekerjaan_pasangan,
    pasangan.alamat_ktp_warga as alamat_ktp_pasangan
FROM sk_telah_menikah 
LEFT JOIN warga as pelapor ON pelapor.id_warga = sk_telah_menikah.pelapor_id
LEFT JOIN warga as pasangan ON pasangan.id_warga = sk_telah_menikah.pasangan_id
ORDER BY sk_telah_menikah.id DESC
";
$query = mysqli_query($db, $sql);
?>

<div class="row page-header">
    <div class="col-sm-12 col-md-6">
        <h4>
            Peristiwa - Surat Keterangan Telah Menikah
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
                <caption>Daftar Surat Telah Menikah</caption>
                <thead class="bg-primary">
                    <tr>
                        <td class="text-center" style="width: 190px;">
                            <i class="fa fa-cog"></i>
                        </td>
                        <th style="width: 150px;">Tanggal Pelaporan</th>
                        <th style="width: 200px;">Pelapor</th>
                        <th style="width: 200px;">Pasangan</th>
                        <th style="width: 100px;">Tanggal Menikah</th>
                        <th style="width: 200px;">Wali Nikah</th>
                        <th style="width: 250px;">Penghulu</th>
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
                                        <button type="button" class="btn btn-danger" title="Delete Data" onclick="deleteData(<?= $row['id']; ?>, '<?= $row['nama_pelapor']; ?>')">
                                            <i class="fa fa-trash fa-fw"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <?= tanggal_indo_no_dash($row['tanggal_pelaporan']); ?>
                                </td>
                                <td><?= $row['nama_pelapor']; ?></td>
                                <td><?= $row['nama_pasangan']; ?></td>
                                <td>
                                    <?= tanggal_indo_no_dash($row['tanggal_menikah']); ?>
                                </td>
                                <td><?= $row['nama_wali_nikah']; ?></td>
                                <td><?= $row['nama_penghulu_nikah']; ?></td>
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