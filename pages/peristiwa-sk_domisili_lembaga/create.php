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
            Tambah Data Surat Keterangan Domisili Perusahaan, Yayasan, Sekolah, Organisasi
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
                <label for="tanggal_pembuatan">Tanggal Pelaporan <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_pembuatan" name="tanggal_pembuatan" value="<?= date('Y-m-d'); ?>" placeholder="Tanggal Pelaporan" required />
            </div>
            <div class="form-group">
                <label for="masa_berlaku">Masa Berlaku SK <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="masa_berlaku" name="masa_berlaku" value="" placeholder="Masa Berlaku SK" required />
            </div>
            <div class="form-group">
                <label for="jenis_lembaga">Jenis Lembaga <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="jenis_lembaga" name="jenis_lembaga" placeholder="Jenis Lembaga" required />
            </div>
            <div class="form-group">
                <label for="nama_lembaga">Nama Lembaga <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_lembaga" name="nama_lembaga" placeholder="Nama Lembaga" required />
            </div>
            <div class="form-group">
                <label for="alamat">Alamat Lembaga <span class="text-danger">*</span></label>
                <textarea class="form-control" id="alamat" name="alamat" placeholder="Nama Lembaga" required></textarea>
            </div>
            <div class="form-group">
                <label for="tahun_pendirian">Tahun Pendirian <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="tahun_pendirian" name="tahun_pendirian" placeholder="Tahun Pendirian" min="1900" max="2050" step="1" value="<?= date('Y'); ?>" required />
            </div>
            <div class="form-group">
                <label for="sk_pendirian">SK Pendirian <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="sk_pendirian" name="sk_pendirian" placeholder="SK Pendirian" required />
            </div>
            <div class="form-group">
                <label for="jumlah_pegawai">Jumlah Pegawai <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="jumlah_pegawai" name="jumlah_pegawai" placeholder="Jumlah Pegawai" min="0" required />
            </div>
            <div class="form-group">
                <label for="pengurus">Pengurus </label>
                <input type="text" class="form-control" id="pengurus" name="pengurus" placeholder="Pengurus" />
            </div>
            <div class="form-group">
                <label for="pimpinan">Pimpinan/Kepala/Ketua <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="pimpinan" name="pimpinan" placeholder="Pimpinan/Kepala/Ketua" required />
            </div>
            <div class="form-group">
                <label for="sekertaris">Sekertaris </label>
                <input type="text" class="form-control" id="sekertaris" name="sekertaris" placeholder="Sekertaris" />
            </div>
            <div class="form-group">
                <label for="bendahara">Bendahara </label>
                <input type="text" class="form-control" id="bendahara" name="bendahara" placeholder="Bendahara" />
            </div>
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