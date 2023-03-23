<?php include __DIR__ . '../../_partials/top.php' ?>

<?php
include('../../config/koneksi.php');

$sql   = "
SELECT
	`logs`.id,
	`logs`.jenis_permohonan,
	`logs`.no_surat,
	warga.nik_warga,
	warga.nama_warga 
FROM
	`logs`
	LEFT JOIN warga ON warga.id_warga = `logs`.warga_id
";
$query = mysqli_query($db, $sql);
?>

<div class="row page-header">
    <div class="col-sm-12 col-md-6">
        <h4>
            Laporan
        </h4>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table id="table_data" class="table table-bordered">
                <caption>Daftar Laporan</caption>
                <thead class="bg-primary">
                    <tr>
                        <th>#</th>
                        <th>Jenis Permohonan</th>
                        <th>No Surat</th>
                        <th>NIK Warga</th>
                        <th>Nama Warga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($query) > 0) { ?>
                        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td><?= $row['jenis_permohonan']; ?></td>
                                <td><?= $row['no_surat']; ?></td>
                                <td><?= $row['nik_warga']; ?></td>
                                <td><?= $row['nama_warga']; ?></td>
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
            "dom": "Bflrtip",
            lengthMenu: [
                [10, 25, 100, -1],
                [10, 25, 100, "All"]
            ],
            "responsive": false,
            "lengthChange": true,
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