<?php include __DIR__ . '../../_partials/top.php' ?>

<?php include('../../config/koneksi.php'); ?>

<?php
$sql = "select * from warga";
$query = mysqli_query($db, $sql);
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="row page-header">
    <div class="col-sm-12 col-md-9">
        <h4>
            Tambah Data Pernyataan Identitas Sama
        </h4>
    </div>
    <div class="col-sm-12 col-md-3 text-right">
        <a href="index.php" class="btn btn-info">
            <i class="fa fa-backward"></i> Kembali
        </a>
    </div>
</div>
<form id="form">
    <div class="row">
        <div class="col-sm-12 col-md-2">
            <div class="form-group">
                <label for="tanggal_pembuatan">Tanggal Pembuatan <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_pembuatan" name="tanggal_pembuatan" value="<?= date('Y-m-d'); ?>" placeholder="Tanggal Pelaporan" required />
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-md-offset-4">
            <div class="form-group">
                <label for="nama_kepala_desa">Nama Kepala Desa <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_kepala_desa" name="nama_kepala_desa" placeholder="Nama Kepala Desa" required />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="data_di_1">Data di <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="data_di_1" name="data_di_1" placeholder="Data di" required />
            </div>
            <div class="form-group">
                <label for="warga_1">Warga <span class="text-danger">*</span></label>
                <select class="form-control select2" id="warga_1" name="warga_1" data-placeholder="Warga" required>
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="data_di_2">Data di <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="data_di_2" name="data_di_2" placeholder="Data di" required />
            </div>
            <div class="form-group">
                <label for="warga_2">Warga <span class="text-danger">*</span></label>
                <select class="form-control select2" id="warga_2" name="warga_2" data-placeholder="Warga" required>
                    <option value=""></option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <hr />
                <button type="submit" class="btn btn-success btn-block" id="btn_simpan">Simpan</button>
                <button type="button" class="btn btn-warning btn-block" id="btn_print" disabled>Print</button>
                <a href="index.php" class="btn btn-info btn-block">Kembali</a>
            </div>
        </div>
</form>
</div>


<?php include __DIR__ . '../../_partials/bottom.php' ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="create_vitamin.js"></script>