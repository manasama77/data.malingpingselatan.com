<?php include __DIR__ . '../../_partials/top.php' ?>

<?php
include('../../config/koneksi.php');

$sql   = "
SELECT  
    kematian.id,
    warga.nama_warga,
    warga.jenis_kelamin_warga,
    kematian.hari,
    kematian.tanggal_kematian,
    kematian.jam_kematian,
    kematian.penyebab_kematian,
    kematian.tempat_kematian,
    kematian.pelapor_id,
    kematian.hubungan_pelapor,
    kematian.tanggal_pembuatan,
    kematian.nomor_surat,
    kematian.sequence,
    pelapor.nama_warga as nama_pelapor
FROM kematian 
LEFT JOIN warga ON warga.id_warga = kematian.warga_id 
LEFT JOIN warga as pelapor ON pelapor.id_warga = kematian.pelapor_id 
ORDER BY id DESC
";
$query = mysqli_query($db, $sql);
?>

<div class="row page-header">
    <div class="col-sm-12 col-md-6">
        <h4>
            Peristiwa - Kematian
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
            <table id="table_data" class="table table-bordered" style="width: 100%;">
                <caption>Daftar Warga Meninggal</caption>
                <thead class="bg-primary">
                    <tr>
                        <th>Tanggal Kematian</th>
                        <th>Nama Warga</th>
                        <th>Jenis Kelamin</th>
                        <th>Sebab</th>
                        <th>Tempat Kematian</th>
                        <th>Pelapor</th>
                        <th>Hubungan</th>
                        <td class="text-center">
                            <i class="fa fa-cog"></i>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($query) > 0) { ?>
                        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <td>
                                    <?php
                                    $tgl_obj = new DateTime($row['tanggal_kematian']);
                                    echo $tgl_obj->format('d-m-Y');
                                    ?>
                                </td>
                                <td><?= $row['nama_warga']; ?></td>
                                <td>
                                    <?= ($row['jenis_kelamin_warga'] == "L") ? "Laki-Laki" : "Perempuan"; ?>
                                </td>
                                <td><?= $row['penyebab_kematian']; ?></td>
                                <td><?= $row['tempat_kematian']; ?></td>
                                <td><?= $row['nama_pelapor']; ?></td>
                                <td><?= $row['hubungan_pelapor']; ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
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