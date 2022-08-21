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
            Tambah Data Surat Keterangan Pemakaman
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
                <label for="jenazah_id">Warga yang Meninggal <span class="text-danger">*</span></label>
                <select class="form-control select2" id="jenazah_id" name="jenazah_id" data-placeholder="Cari Warga yang Meninggal" required>
                    <option value=""></option>
                </select>
            </div>
            <div class=" form-group">
                <label for="tanggal_meninggal">Tanggal Meninggal <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_meninggal" name="tanggal_meninggal" placeholder="Tanggal Meninggal" required />
            </div>
            <div class=" form-group">
                <label for="penyebab_kematian">Penyebab Kematian <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="penyebab_kematian" name="penyebab_kematian" placeholder="Penyebab Kematian" required />
            </div>
            <div class=" form-group">
                <label for="pengurus_pemakaman">Yang Mengurus Pemakaman <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="pengurus_pemakaman" name="pengurus_pemakaman" placeholder="Yang Mengurus Pemakaman" required />
            </div>
            <div class=" form-group">
                <label for="dimakamkan_di">Dimakamkan di <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="dimakamkan_di" name="dimakamkan_di" placeholder="Dimakamkan di" required />
            </div>
            <div class="form-group">
                <label for="pelapor_id">Pelapor <span class="text-danger">*</span></label>
                <select class="form-control select2" id="pelapor_id" name="pelapor_id" data-placeholder="Cari Pelapor" required>
                    <option value=""></option>
                </select>
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