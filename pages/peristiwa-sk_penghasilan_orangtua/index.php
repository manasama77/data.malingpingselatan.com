<?php
include __DIR__ . '../../_partials/top.php';
require '../helper_tanggal_indo.php';
include('../../config/koneksi.php');

$sql   = "
SELECT  
    sk_penghasilan_orangtua.id,
    sk_penghasilan_orangtua.orangtua_id,
    sk_penghasilan_orangtua.anak_id,
    sk_penghasilan_orangtua.penghasilan_orangtua,
    sk_penghasilan_orangtua.keperluan,
    sk_penghasilan_orangtua.tanggal_pelaporan,
    sk_penghasilan_orangtua.nama_kepala_desa,
    sk_penghasilan_orangtua.nrp,
    sk_penghasilan_orangtua.nomor_surat,
    
    orangtua.nama_warga as nama_orangtua,
    orangtua.nik_warga as nik_orangtua,
    orangtua.tempat_lahir_warga as tempat_lahir_orangtua,
    orangtua.tanggal_lahir_warga as tanggal_lahir_orangtua,
    orangtua.jenis_kelamin_warga as jenis_kelamin_orangtua,
    orangtua.negara_warga as negara_orangtua,
    orangtua.status_perkawinan as status_perkawinan_orangtua,
    orangtua.agama_warga as agama_orangtua,
    orangtua.pekerjaan_warga as pekerjaan_orangtua,
    orangtua.alamat_ktp_warga as alamat_ktp_orangtua,

    anak.nama_warga as nama_anak,
    anak.nik_warga as nik_anak,
    anak.tempat_lahir_warga as tempat_lahir_anak,
    anak.tanggal_lahir_warga as tanggal_lahir_anak,
    anak.jenis_kelamin_warga as jenis_kelamin_anak,
    anak.negara_warga as negara_anak,
    anak.status_perkawinan as status_perkawinan_anak,
    anak.agama_warga as agama_anak,
    anak.pekerjaan_warga as pekerjaan_anak,
    anak.alamat_ktp_warga as alamat_ktp_anak

FROM sk_penghasilan_orangtua 
LEFT JOIN warga as orangtua ON orangtua.id_warga = sk_penghasilan_orangtua.orangtua_id
LEFT JOIN warga AS anak ON anak.id_warga = sk_penghasilan_orangtua.anak_id
ORDER BY sk_penghasilan_orangtua.id DESC
";
$query = mysqli_query($db, $sql);
?>

<div class="row page-header">
    <div class="col-sm-12 col-md-6">
        <h4>
            Peristiwa - Surat Keterangan Penghasilan Orang Tua
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
                <caption>Daftar Surat Keterangan Penghasilan Orang Tua</caption>
                <thead class="bg-primary">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-cog"></i>
                        </td>
                        <th>Tanggal Pembuatan</th>
                        <th>Orang Tua</th>
                        <th>Anak</th>
                        <th>Penghasilan Orang Tua</th>
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
                                        <button type="button" class="btn btn-danger" title="Delete Data" onclick="deleteData(<?= $row['id']; ?>, '<?= $row['nama_orangtua']; ?>')">
                                            <i class="fa fa-trash fa-fw"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <?= tanggal_indo_no_dash($row['tanggal_pelaporan']); ?>
                                </td>
                                <td><?= $row['nama_orangtua']; ?></td>
                                <td><?= $row['nama_anak']; ?></td>
                                <td>Rp. <?= number_format($row['penghasilan_orangtua'], 0, ',', '.'); ?></td>
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