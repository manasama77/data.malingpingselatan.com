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
            Tambah Data Surat Kuasa
        </h4>
    </div>
    <div class="col-sm-12 col-md-3 text-right">
        <a href="index.php" class="btn btn-info">
            <i class="fa fa-backward"></i> Kembali
        </a>
    </div>
</div>
<div class="row">
    <form id="form">
        <div class="col-sm-12 col-md-6 col-md-offset-3">
            <div class="form-group">
                <label for="tanggal_pelaporan">Tanggal Pelaporan <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_pelaporan" name="tanggal_pelaporan" value="<?= date('Y-m-d'); ?>" placeholder="Tanggal Pelaporan" required />
            </div>
            <div class="form-group">
                <label for="warga_1_id">Memberi Kuasa <span class="text-danger">*</span></label>
                <select class="form-control select2" id="warga_1_id" name="warga_1_id" data-placeholder="Cari Memberi Kuasa" required>
                    <option value=""></option>
                </select>
            </div>
            <div class="form-group">
                <label for="warga_2_id">Diberi Kuasa <span class="text-danger">*</span></label>
                <select class="form-control select2" id="warga_2_id" name="warga_2_id" data-placeholder="Cari Diberi Kuasa" required>
                    <option value=""></option>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_kuasa">Tanggal Kuasa <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_kuasa" name="tanggal_kuasa" value="<?= date('Y-m-d'); ?>" placeholder="Tanggal Kuasa" required />
            </div>
            <div class=" form-group">
                <label for="keperluan">Keperluan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="keperluan" name="keperluan" placeholder="Keperluan" required />
            </div>
            <hr />
            <div class="form-group">
                <label for="nama_kepala_desa">Nama Kepala Desa <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_kepala_desa" name="nama_kepala_desa" placeholder="Nama Kepala Desa" required />
            </div>
            <div class="form-group">
                <label for="saksi_1">Saksi 1 <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="saksi_1" name="saksi_1" placeholder="Saksi 1" required />
            </div>
            <div class="form-group">
                <label for="saksi_2">Saksi 2 <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="saksi_2" name="saksi_2" placeholder="Saksi 2" required />
            </div>
            <div class="form-group">
                <label for="saksi_3">Saksi 3 <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="saksi_3" name="saksi_3" placeholder="Saksi 3" required />
            </div>
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