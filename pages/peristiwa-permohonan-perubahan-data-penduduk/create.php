<?php include __DIR__ . '../../_partials/top.php' ?>

<?php include('../../config/koneksi.php'); ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="row page-header">
    <div class="col-sm-12 col-md-6">
        <h4>
            Tambah Data - Permohonan Perubahan Data Penduduk
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
                <label for="tanggal_pembuatan">Tanggal Pembuatan <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_pembuatan" name="tanggal_pembuatan" value="<?= date('Y-m-d'); ?>" required />
            </div>
            <div class="form-group">
                <label for="acuan">Acuan Dokumen <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="acuan" name="acuan" required />
            </div>
            <div class="form-group">
                <label for="warga_id">Warga <span class="text-danger">*</span></label>
                <select class="form-control select2" id="warga_id" name="warga_id" required>
                    <option value=""></option>
                </select>
            </div>
            <hr />
            <h2 class="text-center">Detail Warga</h2>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" id="x_nama" name="nama_from" readonly>
            </div>
            <div class="form-group">
                <label>NIK</label>
                <input type="text" class="form-control" id="x_nik" name="nik_from" readonly>
            </div>
            <div class="form-group">
                <label>Tempat, Tgl Lahir</label>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <input type="text" class="form-control" id="x_tempat" name="tempat_lahir_from" readonly>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <input type="date" class="form-control" id="x_tanggal_lahir" name="tanggal_lahir_from" readonly>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <input type="text" class="form-control" id="x_jenis_kelamin" name="jenis_kelamin_from" readonly>
            </div>
            <div class="form-group">
                <label>Warganegara</label>
                <input type="text" class="form-control" id="x_warganegara" name="warganegara_from" readonly>
            </div>
            <div class="form-group">
                <label>Status Perkawinan</label>
                <input type="text" class="form-control" id="x_status_perkawinan" name="status_perkawinan_from" readonly>
            </div>
            <div class="form-group">
                <label>Agama</label>
                <input type="text" class="form-control" id="x_agama" name="agama_from" readonly>
            </div>
            <div class="form-group">
                <label>Pekerjaan</label>
                <input type="text" class="form-control" id="x_pekerjaan" name="pekerjaan_from" readonly>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" id="x_alamat" name="alamat_from" readonly>
            </div>
            <hr />
            <h2 class="text-center">Perubahan Warga</h2>
            <div class="form-group">
                <label>Nama <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama" name="nama_to" required>
            </div>
            <div class="form-group">
                <label>NIK <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nik" name="nik_to" required>
            </div>
            <div class="form-group">
                <label>Tempat, Tgl Lahir <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <input type="text" class="form-control" id="tempat" name="tempat_lahir_to" required>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir_to" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin_to" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Warganegara <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="warganegara" name="warganegara_to" required>
            </div>
            <div class="form-group">
                <label>Status Perkawinan <span class="text-danger">*</span></label>
                <select class="form-control" id="status_perkawinan" name="status_perkawinan_to" required>
                    <option value=""></option>
                    <option value="Belum Kawin">Belum Kawin</option>
                    <option value="Kawin">Kawin</option>
                    <option value="Cerai Hidup">Cerai Hidup</option>
                    <option value="Cerai Mati">Cerai Mati</option>
                </select>
            </div>
            <div class="form-group">
                <label>Agama <span class="text-danger">*</span></label>
                <select class="form-control" id="agama" name="agama_to" required>
                    <option value=""></option>
                    <option value="Islam">Islam</option>
                    <option value="Protestan">Protestan</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Budha">Budha</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
            </div>
            <div class="form-group">
                <label>Pekerjaan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan_to" required>
            </div>
            <div class="form-group">
                <label>Alamat <span class="text-danger">*</span></label>
                <textarea class="form-control" id="alamat" name="alamat_to" required></textarea>
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
                <hr />
                <button type="submit" class="btn btn-success btn-block" id="btn_simpan">Simpan</button>
                <button type="button" class="btn btn-warning btn-block" id="btn_print" disabled>Print</button>
                <a href="index.php" class="btn btn-info btn-block">Kembali</a>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . '../../_partials/bottom.php' ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="create_vitamin.js"></script>