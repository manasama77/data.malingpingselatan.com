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
            Tambah Data Surat Keterangan Domisili Usaha
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
                <label for="masa_berlaku">Masa Berlaku <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="masa_berlaku" name="masa_berlaku" placeholder="Masa Berlaku" required />
            </div>
            <div class="form-group">
                <label for="warga_id">Warga <span class="text-danger">*</span></label>
                <select class="form-control select2" id="warga_id" name="warga_id" required>
                    <option value=""></option>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_usaha">Nama Usaha <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_usaha" name="nama_usaha" value="" placeholder="Nama Usaha" required />
            </div>
            <div class="form-group">
                <label for="bidang_usaha">Bidang Usaha <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="bidang_usaha" name="bidang_usaha" placeholder="Bidang Usaha" required />
            </div>
            <div class="form-group">
                <label for="alamat_usaha">Alamat Usaha <span class="text-danger">*</span></label>
                <textarea class="form-control" id="alamat_usaha" name="alamat_usaha" placeholder="Alamat Usaha" required></textarea>
            </div>
            <div class="form-group">
                <label for="status_bangunan">Status Bangunan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="status_bangunan" name="status_bangunan" placeholder="Status Bangunan" required />
            </div>
            <div class="form-group">
                <label for="akta_pendirian">Akta Pendirian <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="akta_pendirian" name="akta_pendirian" placeholder="Akta Pendirian" required />
            </div>
            <div class="form-group">
                <label for="tahun_pendirian">Tahun Pendirian <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="tahun_pendirian" name="tahun_pendirian" placeholder="Tahun Pendirian" min="1900" max="2050" step="1" value="<?= date('Y'); ?>" required />
            </div>
            <div class="form-group">
                <label for="pimpinan">Pimpinan/Pengeola <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="pimpinan" name="pimpinan" placeholder="Pimpinan/Pengeola" required />
            </div>
            <div class="form-group">
                <label for="jumlah_karyawan">Jumlah Pegawai <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="jumlah_karyawan" name="jumlah_karyawan" placeholder="Jumlah Pegawai" min="0" required />
            </div>
            <div class="form-group">
                <label for="modal">Modal <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="modal" name="modal" placeholder="Modal" min="0" required />
            </div>
            <div class="form-group">
                <label for="nama_kepala_desa">Nama Kepala Desa <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_kepala_desa" name="nama_kepala_desa" placeholder="Nama Kepala Desa" required />
            </div>
            <div class="form-group">
                <label for="nama_camat">Nama Camat <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_camat" name="nama_camat" placeholder="Nama Camat" required />
            </div>
            <div class="form-group">
                <label for="nip_camat">NIP</label>
                <input type="text" class="form-control" id="nip_camat" name="nip_camat" placeholder="NIP" />
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