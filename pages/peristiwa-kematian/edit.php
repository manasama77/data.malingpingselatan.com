<?php include __DIR__ . '../../_partials/top.php' ?>

<?php
include('../../config/koneksi.php');
$sql = "
SELECT
	kematian.*,
    warga.nama_warga,
    pelapor.nama_warga as nama_pelapor
FROM
	kematian
LEFT JOIN warga ON warga.id_warga = kematian.warga_id
LEFT JOIN warga as pelapor ON pelapor.id_warga = kematian.pelapor_id
WHERE 
    kematian.id = " . $_GET['id'] . "
";

$query = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) == 0) {
    die("ID tidak ditemukan");
}

$tgl_obj = new DateTime($row['tanggal_kematian'] . " " . $row['jam_kematian']);
?>

<div class="row page-header">
    <div class="col-sm-12 col-md-6">
        <h4>
            Edit Data Warga Meninggal
        </h4>
    </div>
    <div class="col-sm-12 col-md-6 text-right">
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
                <label for="warga_id">Warga yang Meninggal <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="warga_id" name="warga_id" value="<?= $row['nama_warga']; ?>" required disabled />
                    <div class="input-group-addon" style="background-color: #d9534f; color: white;" role="button" id="btn_modal_warga">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="tanggal_kematian">Tanggal Menginggal <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_kematian" name="tanggal_kematian" value="<?= $tgl_obj->format('Y-m-d'); ?>" required />
            </div>
            <div class="form-group">
                <label for="jam_kematian">Jam Menginggal <span class="text-danger">*</span></label>
                <input type="time" class="form-control" id="jam_kematian" name="jam_kematian" value="<?= $tgl_obj->format('H:i'); ?>" required />
            </div>
            <div class="form-group">
                <label for="penyebab_kematian">Penyebab Kematian <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="penyebab_kematian" name="penyebab_kematian" value="<?= $row['penyebab_kematian']; ?>" placeholder="Penyebab Kematian" required />
            </div>
            <div class="form-group">
                <label for="tempat_kematian">Tempat Meninggal <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="tempat_kematian" name="tempat_kematian" value="<?= $row['tempat_kematian']; ?>" placeholder="Tempat Meninggal" required />
            </div>
            <div class="form-group">
                <label for="pelapor_id">Warga yang Melaporkan <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="pelapor_id" name="pelapor_id" value="<?= $row['nama_pelapor']; ?>" required readonly />
                    <div class="input-group-addon" style="background-color: #d9534f; color: white;" role="button" id="btn_modal_pelapor">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="hubungan_pelapor">Hubungan Pelapor <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="hubungan_pelapor" name="hubungan_pelapor" value="<?= $row['hubungan_pelapor']; ?>" placeholder="Hubungan Pelapor" required />
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
            <div class="form-group">
                <hr />
                <input type="hidden" id="id_edit" name="id_edit" value="<?= $row['id']; ?>" />
                <input type="hidden" id="warga_id_hidden" name="warga_id_hidden" value="<?= $row['warga_id']; ?>" />
                <input type="hidden" id="pelapor_id_hidden" name="pelapor_id_hidden" value="<?= $row['pelapor_id']; ?>" />
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

<!-- Modal -->
<form id="form_pelapor">
    <div class="modal fade" id="modal_pelapor" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pilih Pelapor</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pelapor_keyword">Nama Pelapor</label>
                        <input type="text" class="form-control" id="pelapor_keyword" name="pelapor_keyword" minlength="3" placeholder="Ketik Nama Pelapor" required />
                        <span class="text-muted">Ketikan minimal 3 karakter</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed">
                            <thead class="bg-danger">
                                <tr>
                                    <th>NAMA</th>
                                </tr>
                            </thead>
                            <tbody id="v_list_pelapor">
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