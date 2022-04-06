<?php include __DIR__ . '../../_partials/top.php' ?>

<?php
include('../../config/koneksi.php');

$sql   = "
SELECT
	kelahiran.id,
	kelahiran.hari,
	warga.tempat_lahir_warga,
	kelahiran.tanggal_kelahiran,
	kelahiran.jam_kelahiran,
	kelahiran.tempat_kelahiran,
	warga.jenis_kelamin_warga,
	warga.nama_warga,
	warga.agama_warga,
	kelahiran.anak_ke,
	kartu_keluarga.nomor_keluarga,
	ibu.nama_warga AS nama_ibu,
	ibu.nik_warga AS nik_ibu,
	ibu.tempat_lahir_warga AS tempat_lahir_ibu,
	ibu.tanggal_lahir_warga AS tanggal_lahir_ibu,
	ibu.pekerjaan_warga AS pekerjaan_ibu,
	ibu.alamat_warga AS alamat_ibu,
	ayah.nama_warga AS nama_ayah,
	ayah.nik_warga AS nik_ayah,
	ayah.tempat_lahir_warga AS tempat_lahir_ayah,
	ayah.tanggal_lahir_warga AS tanggal_lahir_ayah,
	ayah.pekerjaan_warga AS pekerjaan_ayah,
	ayah.alamat_warga AS alamat_ayah,
	pelapor.nama_warga AS nama_pelapor,
	pelapor.nik_warga AS nik_pelapor,
	pelapor.tempat_lahir_warga AS tempat_lahir_pelapor,
	pelapor.tanggal_lahir_warga AS tanggal_lahir_pelapor,
	pelapor.pekerjaan_warga AS pekerjaan_pelapor,
	pelapor.alamat_warga AS alamat_pelapor,
    pelapor.jenis_kelamin_warga AS jenis_kelamin_pelapor,
	(
	IF
		(
			( SELECT count( * ) FROM kartu_keluarga WHERE kartu_keluarga.id_kepala_keluarga = kelahiran.pelapor_id ) = 1,
			( SELECT nomor_keluarga FROM kartu_keluarga WHERE kartu_keluarga.id_kepala_keluarga = kelahiran.pelapor_id ),
			( SELECT kartu_keluarga.nomor_keluarga FROM warga_has_kartu_keluarga LEFT JOIN kartu_keluarga ON kartu_keluarga.id_keluarga = warga_has_kartu_keluarga.id_keluarga WHERE warga_has_kartu_keluarga.id_warga = kelahiran.pelapor_id ) 
		) 
	) AS nomor_keluarga_pelapor,
    kelahiran.hubungan_pelapor,
    kelahiran.tanggal_pembuatan,
    kelahiran.nomor_surat
FROM
	kelahiran
	LEFT JOIN warga ON warga.id_warga = kelahiran.warga_id
	LEFT JOIN warga AS ibu ON ibu.id_warga = kelahiran.ibu_id
	LEFT JOIN warga AS ayah ON ayah.id_warga = kelahiran.ayah_id
	LEFT JOIN kartu_keluarga ON kartu_keluarga.id_kepala_keluarga = kelahiran.ayah_id
	LEFT JOIN warga AS pelapor ON pelapor.id_warga = kelahiran.pelapor_id
ORDER BY kelahiran.id DESC
";
$query = mysqli_query($db, $sql);
?>

<div class="row page-header">
    <div class="col-sm-12 col-md-6">
        <h4>
            Peristiwa - Kelahiran
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
                <caption>Daftar Warga Lahir</caption>
                <thead class="bg-primary">
                    <tr>
                        <th>Nama Bayi</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Kelahiran</th>
                        <th>Jam Kelahiran</th>
                        <th>Tempat Kelahiran</th>
                        <th>Anak ke</th>
                        <th>Ayah</th>
                        <th>Ibu</th>
                        <td class="text-center">
                            <i class="fa fa-cog"></i>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($query) > 0) { ?>
                        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <td><?= $row['nama_warga']; ?></td>
                                <td>
                                    <?= ($row['jenis_kelamin_warga'] == "L") ? "Laki-Laki" : "Perempuan"; ?>
                                </td>
                                <td>
                                    <?php
                                    $tgl_obj = new DateTime($row['tanggal_kelahiran']);
                                    echo $tgl_obj->format('d-m-Y');
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $tgl_obj = new DateTime($row['jam_kelahiran']);
                                    echo $tgl_obj->format('H:i') . " WIB";
                                    ?>
                                </td>
                                <td><?= $row['tempat_kelahiran']; ?></td>
                                <td><?= $row['anak_ke']; ?></td>
                                <td><?= $row['nama_ayah']; ?></td>
                                <td><?= $row['nama_ibu']; ?></td>
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