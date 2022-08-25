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
            Tambah Data Surat Keterangan Telah Menikah
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
                <label for="pelapor_id">Pelapor <span class="text-danger">*</span></label>
                <select class="form-control select2" id="pelapor_id" name="pelapor_id" data-placeholder="Cari Pelapor" required>
                    <option value=""></option>
                </select>
            </div>
            <div class="form-group">
                <label for="pasangan_id">Pasangan <span class="text-danger">*</span></label>
                <select class="form-control select2" id="pasangan_id" name="pasangan_id" data-placeholder="Cari Pasangan" required>
                    <option value=""></option>
                </select>
            </div>
            <div class=" form-group">
                <label for="tanggal_menikah">Tanggal Menikah <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_menikah" name="tanggal_menikah" placeholder="Tanggal Menikah" required />
            </div>
            <div class=" form-group">
                <label for="tempat_menikah">Tempat Menikah <span class="text-danger">*</span></label>
                <textarea class="form-control" id="tempat_menikah" name="tempat_menikah" placeholder="Tempat Menikah" required></textarea>
            </div>
            <div class=" form-group">
                <label for="nama_wali_nikah">Nama Wali Nikah <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_wali_nikah" name="nama_wali_nikah" placeholder="Nama Wali Nikah" required />
            </div>
            <div class=" form-group">
                <label for="nama_penghulu_nikah">Nama Penghulu Pernikahan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_penghulu_nikah" name="nama_penghulu_nikah" placeholder="Nama Penghulu Pernikahan" required />
            </div>
            <div class=" form-group">
                <label for="saksi_1">Nama Saksi 1 <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="saksi_1" name="saksi_1" placeholder="Nama Saksi 1" required />
            </div>
            <div class=" form-group">
                <label for="saksi_2">Nama Saksi 2 <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="saksi_2" name="saksi_2" placeholder="Nama Saksi 2" required />
            </div>
            <div class=" form-group">
                <label for="saksi_3">Nama Saksi 3 <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="saksi_3" name="saksi_3" placeholder="Nama Saksi 3" required />
            </div>
            <hr />
            <div class="form-group">
                <label for="nama_kepala_desa">Nama Kepala Desa <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_kepala_desa" name="nama_kepala_desa" placeholder="Nama Kepala Desa" required />
            </div>
            <div class="form-group">
                <label for="nrp">NRP <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nrp" name="nrp" placeholder="NRP" required />
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