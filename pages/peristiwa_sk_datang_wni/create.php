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
            Peristiwa - Surat Keterangan Datang WNI
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
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="nama_pemohon">Nama Pemohon <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" placeholder="Nama Pemohon" required />
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="tanggal_pembuatan">Tanggal Pembuatan <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_pembuatan" name="tanggal_pembuatan" placeholder="Tanggal Pembuatan" required />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h3>DATA DAERAH ASAL :</h3>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="no_kk">Nomor Kartu Keluarga <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="no_kk" name="no_kk" placeholder="Nomor Kartu Keluarga" required />
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="nama_kepala_keluarga">Nama Kartu Keluarga <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_kepala_keluarga" name="nama_kepala_keluarga" placeholder="Nama Kartu Keluarga" required />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h3>Alamat Daerah Asal</h3>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="f_kampung">Kampung</label>
                <input type="text" class="form-control" id="f_kampung" name="f_kampung" placeholder="Kampung" />
            </div>
            <div class="form-group">
                <label for="f_rt">RT <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="f_rt" name="f_rt" placeholder="RT" required />
            </div>
            <div class="form-group">
                <label for="f_rw">RW <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="f_rw" name="f_rw" placeholder="RW" required />
            </div>
            <div class="form-group">
                <label for="f_kodepos">Kodepos <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="f_kodepos" name="f_kodepos" placeholder="Kodepos" required />
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="f_desa">Desa <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="f_desa" name="f_desa" placeholder="Desa" required />
            </div>
            <div class="form-group">
                <label for="f_kecamatan">Kecamatan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="f_kecamatan" name="f_kecamatan" placeholder="Kecamatan" required />
            </div>
            <div class="form-group">
                <label for="f_kabupaten">Kabupaten <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="f_kabupaten" name="f_kabupaten" placeholder="Kabupaten" required />
            </div>
            <div class="form-group">
                <label for="f_provinsi">Provinsi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="f_provinsi" name="f_provinsi" placeholder="Provinsi" required />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <hr />
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h3>DATA KEPINDAHAN :</h3>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="tanggal_kedatangan">Tanggal Kedatangan <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_kedatangan" name="tanggal_kedatangan" placeholder="Tanggal Kedatangan" required />
            </div>
            <div class="form-group">
                <label for="alasan_pindah">Alasan Pindah <span class="text-danger">*</span></label>
                <select class="form-control" id="alasan_pindah" name="alasan_pindah" required>
                    <option value=""></option>
                    <option value="1">Pekerjaan</option>
                    <option value="2">Pendidikan</option>
                    <option value="3">Keamanan</option>
                    <option value="4">Kesehatan</option>
                    <option value="5">Perumahan</option>
                    <option value="6">Keluarga</option>
                    <option value="7">Lainnya</option>
                </select>
            </div>
            <div class="form-group alasan_pindah_lainnya_group" style="display: none;">
                <label for="alasan_pindah_lainnya">Alasan Pindah Lainnya <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="alasan_pindah_lainnya" name="alasan_pindah_lainnya" placeholder="Nama Kartu Keluarga" />
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="klasifikasi_pindah">Klasifikasi Pindah <span class="text-danger">*</span></label>
                <select class="form-control" id="klasifikasi_pindah" name="klasifikasi_pindah" required>
                    <option value=""></option>
                    <option value="1">Dalam Satu Desa/Kelurahan</option>
                    <option value="2">Antar Desa/Kelurahan</option>
                    <option value="3">Antar Kecamatan</option>
                    <option value="4">Antar Kabupaten/Kota</option>
                    <option value="5">Antar Provinsi</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jenis_kepindahan">Jenis Kepindahan <span class="text-danger">*</span></label>
                <select class="form-control" id="jenis_kepindahan" name="jenis_kepindahan" required>
                    <option value=""></option>
                    <option value="1">Kepala Keluarga</option>
                    <option value="2">Kepala Keluarga dan Seluruh Anggota Keluarga</option>
                    <option value="3">Kepala Keluarga sebagai Anggota Keluarga</option>
                    <option value="4">Anggota Kelurga</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status_no_kk_tidak_pindah">Status Nomor Kartu Keluarga bagi yang Tidak Pindah <span class="text-danger">*</span></label>
                <select class="form-control" id="status_no_kk_tidak_pindah" name="status_no_kk_tidak_pindah" required>
                    <option value=""></option>
                    <option value="1">Numpang Kartu Keluarga</option>
                    <option value="2">Membuat Kartu Keluarga Baru</option>
                    <option value="3">Tidak Ada Anggota Keluarga yang Ditinggal</option>
                    <option value="4">Nomor Kartu Keluarga Tetap</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status_no_kk_pindah">Status Nomor Kartu Keluarga bagi yang Pindah<span class="text-danger">*</span></label>
                <select class="form-control" id="status_no_kk_pindah" name="status_no_kk_pindah" required>
                    <option value=""></option>
                    <option value="1">Numpang Kartu Keluarga</option>
                    <option value="2">Membuat Kartu Keluarga Baru</option>
                    <option value="3">Nama Kepala Keluarga dan Nomor Kartu Keluarga Tetap</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h3>Alamat Tujuan Pindah</h3>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="t_kampung">Kampung </label>
                <input type="text" class="form-control" id="t_kampung" name="t_kampung" placeholder="Kampung" required />
            </div>
            <div class="form-group">
                <label for="t_rt">RT <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="t_rt" name="t_rt" placeholder="RT" required />
            </div>
            <div class="form-group">
                <label for="t_rw">RW <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="t_rw" name="t_rw" placeholder="RW" required />
            </div>
            <div class="form-group">
                <label for="t_kodepos">Kodepos <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="t_kodepos" name="t_kodepos" placeholder="Kodepos" required />
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="t_desa">Desa <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="t_desa" name="t_desa" placeholder="Desa" required />
            </div>
            <div class="form-group">
                <label for="t_kecamatan">Kecamatan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="t_kecamatan" name="t_kecamatan" placeholder="Kecamatan" required />
            </div>
            <div class="form-group">
                <label for="t_kabupaten">Kabupaten <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="t_kabupaten" name="t_kabupaten" placeholder="Kabupaten" required />
            </div>
            <div class="form-group">
                <label for="t_provinsi">Provinsi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="t_provinsi" name="t_provinsi" placeholder="Provinsi" required />
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
                <label for="nik_pendatang">NIK</label>
                <input type="number" class="form-control" id="nik_pendatang" name="nik_pendatang" placeholder="NIK" />
            </div>
            <div class="form-group">
                <label for="nama_pendatang">Nama</label>
                <input type="text" class="form-control" id="nama_pendatang" name="nama_pendatang" placeholder="Nama" />
            </div>
            <div class="form-group">
                <label for="tempat_lahir_pendatang">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir_pendatang" name="tempat_lahir_pendatang" placeholder="Tempat Lahir" />
            </div>
            <div class="form-group">
                <label for="tanggal_lahir_pendatang">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir_pendatang" name="tanggal_lahir_pendatang" placeholder="Tanggal Lahir" />
            </div>
            <div class="form-group">
                <label for="shdk_pendatang">SHDK</label>
                <input type="text" class="form-control" id="shdk_pendatang" name="shdk_pendatang" placeholder="SHDK" />
            </div>
            <button type="button" class="btn btn-info btn-block" onclick="tambahData()">
                <i class="fa fa-plus fa-fw"></i> Tambah Pendatang
            </button>
        </div>
        <div class="col-sm-12">
            <div class="table-responsive" style="margin-top: 20px;">
                <table class="table table-bordered table-striped">
                    <thead class="bg-info">
                        <tr>
                            <th class="text-center"><i class="fa fa-cog"></i></th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>SHDK</th>
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
        <div class="col-12">
            <hr />
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="no_camat">Nomor Camat <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="no_camat" name="no_camat" placeholder="Nomor Camat" required />
            </div>
            <div class="form-group">
                <label for="nama_camat">Nama Camat <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_camat" name="nama_camat" placeholder="Nama Camat" required />
            </div>
            <div class="form-group">
                <label for="nip_camat">NIP Camat <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nip_camat" name="nip_camat" placeholder="NIP Camat" required />
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="nama_kepala_desa">Nama Kepala Desa <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_kepala_desa" name="nama_kepala_desa" placeholder="Nama Kepala Desa" required />
            </div>
            <div class="form-group">
                <label for="nrp">NRP Kepala Desa</label>
                <input type="text" class="form-control" id="nrp" name="nrp" placeholder="NRP Kepala Desa" />
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