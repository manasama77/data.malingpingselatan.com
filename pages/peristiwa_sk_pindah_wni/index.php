<?php
include __DIR__ . '../../_partials/top.php';
require '../helper_tanggal_indo.php';
include('../../config/koneksi.php');

$sql   = "
SELECT  
    sk_pergi_wni.id,
    sk_pergi_wni.no_kk,
    sk_pergi_wni.nama_kepala_keluarga,
    sk_pergi_wni.f_kampung,
    sk_pergi_wni.f_rt,
    sk_pergi_wni.f_rw,
    sk_pergi_wni.f_desa,
    sk_pergi_wni.f_kecamatan,
    sk_pergi_wni.f_kodepos,
    sk_pergi_wni.f_kabupaten,
    sk_pergi_wni.f_provinsi,
    sk_pergi_wni.alasan_pindah,
    sk_pergi_wni.alasan_pindah_lainnya,
    sk_pergi_wni.t_kampung,
    sk_pergi_wni.t_rt,
    sk_pergi_wni.t_rw,
    sk_pergi_wni.t_desa,
    sk_pergi_wni.t_kecamatan,
    sk_pergi_wni.t_kodepos,
    sk_pergi_wni.t_kabupaten,
    sk_pergi_wni.t_provinsi,
    sk_pergi_wni.klasifikasi_pindah,
    sk_pergi_wni.jenis_kepindahan,
    sk_pergi_wni.status_no_kk_tidak_pindah,
    sk_pergi_wni.tanggal_kepindahan,
    sk_pergi_wni.no_camat,
    sk_pergi_wni.nama_camat,
    sk_pergi_wni.nip_camat,
    sk_pergi_wni.nama_kepala_desa,
    sk_pergi_wni.nrp,
    sk_pergi_wni.nomor_surat

FROM sk_pergi_wni 
ORDER BY sk_pergi_wni.id DESC
";
$query = mysqli_query($db, $sql);
?>

<div class="row page-header">
    <div class="col-sm-12 col-md-6">
        <h4>
            Peristiwa - Surat Keterangan Pergi WNI
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
                <caption>Daftar Surat Keterangan Pergi WNI</caption>
                <thead class="bg-primary">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-cog"></i>
                        </td>
                        <th>Tanggal Kepindahan</th>
                        <th>Nomor Surat</th>
                        <th>No KK</th>
                        <th>Nama KK</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($query) > 0) { ?>
                        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <!-- <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning" title="Edit Data">
                                            <i class="fa fa-pencil fa-fw"></i>
                                        </a> -->
                                        <a href="print.php?id=<?= $row['id']; ?>" target="_blank" class="btn btn-success" title="Print Data">
                                            <i class="fa fa-print fa-fw"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" title="Delete Data" onclick="deleteData(<?= $row['id']; ?>, '<?= $row['no_kk']; ?>')">
                                            <i class="fa fa-trash fa-fw"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <?= tanggal_indo_no_dash($row['tanggal_kepindahan']); ?>
                                </td>
                                <td><?= $row['nomor_surat']; ?></td>
                                <td><?= $row['no_kk']; ?></td>
                                <td><?= $row['nama_kepala_keluarga']; ?></td>
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