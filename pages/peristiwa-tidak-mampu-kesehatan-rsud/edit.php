<?php include __DIR__ . '../../_partials/top.php' ?>

<?php
include('../../config/koneksi.php');
$sql = "
SELECT
	tidak_mampu_kesehatan_rsud.id,
	tidak_mampu_kesehatan_rsud.warga_id,
	tidak_mampu_kesehatan_rsud.tanggal_pembuatan,
	tidak_mampu_kesehatan_rsud.nomor_surat,
	warga.nama_warga,
	warga.nik_warga,
    (
        IF
        (
            ( SELECT count( * ) FROM kartu_keluarga WHERE kartu_keluarga.id_kepala_keluarga = tidak_mampu_kesehatan_rsud.warga_id ) = 1,
            ( SELECT nomor_keluarga FROM kartu_keluarga WHERE kartu_keluarga.id_kepala_keluarga = tidak_mampu_kesehatan_rsud.warga_id ),
            ( SELECT kartu_keluarga.nomor_keluarga FROM warga_has_kartu_keluarga LEFT JOIN kartu_keluarga ON kartu_keluarga.id_keluarga = warga_has_kartu_keluarga.id_keluarga WHERE warga_has_kartu_keluarga.id_warga = tidak_mampu_kesehatan_rsud.warga_id ) 
        ) 
    ) AS nomor_keluarga,
	warga.tempat_lahir_warga,
	warga.tanggal_lahir_warga,
	warga.jenis_kelamin_warga,
	warga.agama_warga,
	warga.pekerjaan_warga,
	warga.alamat_ktp_warga,
	tidak_mampu_kesehatan_rsud.jabatan_ttd,
    tidak_mampu_kesehatan_rsud.nama_ttd,
	tidak_mampu_kesehatan_rsud.nomor_induk_ttd,
	tidak_mampu_kesehatan_rsud.no_register_camat,
	tidak_mampu_kesehatan_rsud.nama_camat,
	tidak_mampu_kesehatan_rsud.nip_camat
FROM
	tidak_mampu_kesehatan_rsud
	LEFT JOIN warga ON warga.id_warga = tidak_mampu_kesehatan_rsud.warga_id 
WHERE
	tidak_mampu_kesehatan_rsud.id = " . $_GET['id'] . "
";

$query = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) == 0) {
    die("ID tidak ditemukan");
}
?>

<div class="row page-header">
    <div class="col-sm-12 col-md-8">
        <h4>
            Edit Data Warga Keterangan Tidak Mampu Untuk Kesehatan (RSUD)
        </h4>
    </div>
    <div class="col-sm-12 col-md-4 text-right">
        <a href="index.php" class="btn btn-info">
            <i class="fa fa-backward"></i> Kembali
        </a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-6 col-md-offset-3">
        <form id="form">
            <div class="form-group">
                <label for="tanggal_pembuatan">Tanggal Pelaporan <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_pembuatan" name="tanggal_pembuatan" value="<?= $row['tanggal_pembuatan']; ?>" required />
            </div>
            <div class="form-group">
                <label for="warga_id">Warga <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="warga_id" name="warga_id" value="<?= $row['nama_warga']; ?>" required disabled />
                    <div class="input-group-addon" style="background-color: #d9534f; color: white;" role="button" id="btn_modal_warga">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
            </div>
            <hr />
            <h2 class="text-center">Tanda Tangan</h2>
            <div class="form-group">
                <label for="nama_ttd">Nama Penandatangan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_ttd" name="nama_ttd" value="<?= $row['nama_ttd']; ?>" placeholder="Nama Penandatangan" required />
            </div>
            <div class="form-group">
                <label for="jabatan_ttd">Jabatan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="jabatan_ttd" name="jabatan_ttd" value="<?= $row['jabatan_ttd']; ?>" placeholder="Jabatan" required />
            </div>
            <div class="form-group">
                <label for="nomor_induk_ttd">Nomor Induk</label>
                <input type="text" class="form-control" id="nomor_induk_ttd" name="nomor_induk_ttd" value="<?= $row['nomor_induk_ttd']; ?>" placeholder="Nomor Induk" />
            </div>
            <hr />
            <div class="form-group">
                <label for="no_register_camat">Nomor Register Camat <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="no_register_camat" name="no_register_camat" value="<?= $row['no_register_camat']; ?>" placeholder="Nomor Register Camat" required />
            </div>
            <div class="form-group">
                <label for="nama_camat">Nama Camat <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_camat" name="nama_camat" value="<?= $row['nama_camat']; ?>" placeholder="Nama Camat" required />
            </div>
            <div class="form-group">
                <label for="nip_camat">NIP Camat <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nip_camat" name="nip_camat" value="<?= $row['nip_camat']; ?>" placeholder="NIP Camat" required />
            </div>
            <div class="form-group">
                <hr />
                <input type="hidden" id="id_edit" name="id_edit" value="<?= $row['id']; ?>" />
                <input type="hidden" id="warga_id_hidden" name="warga_id_hidden" value="<?= $row['warga_id']; ?>" />
                <button type="submit" class="btn btn-success btn-block" id="btn_simpan">Simpan</button>
                <button type="button" class="btn btn-warning btn-block" id="btn_print" disabled>Print</button>
                <a href="index.php" class="btn btn-info btn-block">Kembali</a>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<form id="form_warga">
    <div class="modal fade" id="modal_warga" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pilih Warga</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="warga_keyword">Nama Warga</label>
                        <input type="text" class="form-control" id="warga_keyword" name="warga_keyword" minlength="3" placeholder="Ketik Nama Warga" required />
                        <span class="text-muted">Ketikan minimal 3 karakter</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed">
                            <thead class="bg-danger">
                                <tr>
                                    <th>NAMA</th>
                                </tr>
                            </thead>
                            <tbody id="v_list_warga">
                                <tr>
                                    <td>Data Tidak Ditemukan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>


<?php include __DIR__ . '../../_partials/bottom.php' ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="edit_vitamin.js"></script>