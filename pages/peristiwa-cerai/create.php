<?php include __DIR__ . '../../_partials/top.php' ?>

<?php include('../../config/koneksi.php'); ?>

<?php
$sql = "select * from warga";
$query = mysqli_query($db, $sql);
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="row page-header">
    <div class="col-sm-12 col-md-6">
        <h4>
            Tambah Data SK Cerai
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
                <input type="date" class="form-control" id="tanggal_pembuatan" name="tanggal_pembuatan" value="<?= date('Y-m-d'); ?>" required />
            </div>
            <div class="form-group">
                <label for="pelapor_id">Pelapor <span class="text-danger">*</span></label>
                <select class="form-control select2" id="pelapor_id" name="pelapor_id" required>
                    <option value=""></option>
                </select>
            </div>
            <div class="form-group">
                <label for="warga_id">Pasangan <span class="text-danger">*</span></label>
                <select class="form-control select2" id="warga_id" name="warga_id" required>
                    <option value=""></option>
                </select>
            </div>
            <div class="form-group">
                <label for="status_pelapor">Status Pelapor <span class="text-danger">*</span></label>
                <select class="form-control" id="status_pelapor" name="status_pelapor" required>
                    <option value="Duda">Duda</option>
                    <option value="Janda">Janda</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_cerai">Tanggal Cerai <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_cerai" name="tanggal_cerai" value="<?= date('Y-m-d'); ?>" required />
            </div>
            <div class="form-group">
                <label for="alasan_cerai">Alasan Cerai <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="alasan_cerai" name="alasan_cerai" required />
            </div>
            <hr />
            <h2 class="text-center">Tanda Tangan</h2>
            <div class="form-group">
                <label for="nama_ttd">Nama Penandatangan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_ttd" name="nama_ttd" placeholder="Nama Penandatangan" required />
            </div>
            <div class="form-group">
                <label for="jabatan_ttd">Jabatan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="jabatan_ttd" name="jabatan_ttd" placeholder="Jabatan" required />
            </div>
            <div class="form-group">
                <label for="nomor_induk_ttd">Nomor Induk</label>
                <input type="text" class="form-control" id="nomor_induk_ttd" name="nomor_induk_ttd" placeholder="Nomor Induk" />
            </div>
            <hr />
            <div class="form-group">
                <label for="saksi_1">Saksi 1</label>
                <input type="text" class="form-control" id="saksi_1" name="saksi_1" placeholder="Saksi 1" />
            </div>
            <div class="form-group">
                <label for="saksi_2">Saksi 2</label>
                <input type="text" class="form-control" id="saksi_2" name="saksi_2" placeholder="Saksi 2" />
            </div>
            <div class="form-group">
                <label for="saksi_3">Saksi 3</label>
                <input type="text" class="form-control" id="saksi_3" name="saksi_3" placeholder="Saksi 3" />
            </div>
            <div class="form-group">
                <hr />
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="create_vitamin.js"></script>