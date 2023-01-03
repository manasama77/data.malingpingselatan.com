<?php include __DIR__ . '../../_partials/top.php' ?>

<?php include('../../config/koneksi.php'); ?>

<?php
date_default_timezone_set('Asia/Jakarta');
$sql = "select * from warga";
$query = mysqli_query($db, $sql);
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<div class="row page-header">
    <div class="col-sm-12 col-md-9">
        <h4>
            Peristiwa - Surat Keterangan Izin Tebang
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
        <div class="col-sm-12">
            <h3>Detail Pelaporan</h3>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="tanggal_pelaporan">Tanggal Pelaporan <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_pelaporan" name="tanggal_pelaporan" value="<?= date('Y-m-d'); ?>" placeholder="Tanggal Pelaporan" required />
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="warga_id">Pemohon <span class="text-danger">*</span></label>
                <select class="form-control select2" id="warga_id" name="warga_id" data-placeholder="Cari Pemohon" required>
                    <option value=""></option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <hr />
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h3>Detail Lahan / Tanah</h3>
            <div class="form-group">
                <label for="luas_lahan">Luas Lahan</label>
                <input type="text" class="form-control" id="luas_lahan" name="luas_lahan" placeholder="Luas Lahan" requried />
            </div>
            <div class="form-group">
                <label for="status_lahan">Status Lahan</label>
                <input type="text" class="form-control" id="status_lahan" name="status_lahan" placeholder="Status Lahan" requried />
            </div>
            <div class="form-group">
                <label for="persil_girik_sppt">Persil/Girik/SPPT</label>
                <input type="text" class="form-control" id="persil_girik_sppt" name="persil_girik_sppt" placeholder="Persil/Girik/SPPT" requried />
            </div>
            <div class="form-group">
                <label for="lokasi_blok">Lokasi Blok</label>
                <input type="text" class="form-control" id="lokasi_blok" name="lokasi_blok" placeholder="Lokasi Blok" requried />
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <h3>Tanda Tangan</h3>
            <div class="form-group">
                <label for="nama_kepala_desa">Nama Kepala Desa <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_kepala_desa" name="nama_kepala_desa" placeholder="Nama Kepala Desa" required />
            </div>
            <div class="form-group">
                <label for="no_rt">No RT <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="no_rt" name="no_rt" placeholder="No RT" required />
            </div>
            <div class="form-group">
                <label for="nama_rt">Nama RT <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_rt" name="nama_rt" placeholder="Nama RT" required />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <hr />
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-4 col-md-offset-4">
            <div class="form-group">
                <label for="nama_kayu">Jenis Pohon / Kayu</label>
                <input type="text" class="form-control" id="nama_kayu" name="nama_kayu" placeholder="Jenis Pohon / Kayu" />
            </div>
            <div class="form-group">
                <label for="jumlah_batang">Jumlah Batang</label>
                <input type="number" class="form-control" id="jumlah_batang" name="jumlah_batang" placeholder="Jumlah Batang" />
            </div>
            <div class="form-group">
                <label for="hasil_klem">Perkiraan Hasil Klem m³</label>
                <input type="number" class="form-control" id="hasil_klem" name="hasil_klem" placeholder="Perkiraan Hasil Klem m³" />
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" />
            </div>
            <button type="button" class="btn btn-info btn-block" onclick="tambahKayu()">
                <i class="fa fa-plus fa-fw"></i> Tambah Jenis Pohon / Kayu
            </button>
        </div>
        <div class="col-sm-12">
            <div class="table-responsive" style="margin-top: 20px;">
                <table class="table table-bordered table-striped">
                    <thead class="bg-info">
                        <tr>
                            <th class="text-center"><i class="fa fa-cog"></i></th>
                            <th>Jenis Pohon / Kayu</th>
                            <th>Jumlah batang</th>
                            <th>Perkiraan Hasil Klem m³</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody id="v_list">
                        <tr>
                            <td colspan="5" class="text-center text-danger">Tidak ada data</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                <hr />
                <button type="submit" class="btn btn-success btn-block" id="btn_simpan"><i class="fa fa-save fa-fw"></i> Simpan</button>
                <button type="button" class="btn btn-warning btn-block" id="btn_print" disabled><i class="fa fa-print fa-fw"></i> Print</button>
                <a href="index.php" class="btn btn-info btn-block"><i class="fa fa-backward fa-fw"></i> Kembali</a>
            </div>
        </div>
    </div>
</form>


<?php include __DIR__ . '../../_partials/bottom.php' ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="create_vitamin.js"></script>