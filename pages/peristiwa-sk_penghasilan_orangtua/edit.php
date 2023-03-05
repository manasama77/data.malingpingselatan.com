<?php include __DIR__ . '../../_partials/top.php' ?>

<?php
include('../../config/koneksi.php');

$sql = "
SELECT  
    sk_penghasilan_orangtua.id,
    sk_penghasilan_orangtua.orangtua_id,
    sk_penghasilan_orangtua.anak_id,
    sk_penghasilan_orangtua.penghasilan_orangtua,
    sk_penghasilan_orangtua.keperluan,
    sk_penghasilan_orangtua.tanggal_pelaporan,
    sk_penghasilan_orangtua.nama_kepala_desa,
    sk_penghasilan_orangtua.nrp,
    sk_penghasilan_orangtua.nomor_surat,
    
    orangtua.nama_warga as nama_orangtua,
    orangtua.nik_warga as nik_orangtua,
    orangtua.tempat_lahir_warga as tempat_lahir_orangtua,
    orangtua.tanggal_lahir_warga as tanggal_lahir_orangtua,
    orangtua.jenis_kelamin_warga as jenis_kelamin_orangtua,
    orangtua.negara_warga as negara_orangtua,
    orangtua.status_perkawinan as status_perkawinan_orangtua,
    orangtua.agama_warga as agama_orangtua,
    orangtua.pekerjaan_warga as pekerjaan_orangtua,
    orangtua.alamat_ktp_warga as alamat_ktp_orangtua,

    anak.nama_warga as nama_anak,
    anak.nik_warga as nik_anak,
    anak.tempat_lahir_warga as tempat_lahir_anak,
    anak.tanggal_lahir_warga as tanggal_lahir_anak,
    anak.jenis_kelamin_warga as jenis_kelamin_anak,
    anak.negara_warga as negara_anak,
    anak.status_perkawinan as status_perkawinan_anak,
    anak.agama_warga as agama_anak,
    anak.pekerjaan_warga as pekerjaan_anak,
    anak.alamat_ktp_warga as alamat_ktp_anak

FROM sk_penghasilan_orangtua 
LEFT JOIN warga as orangtua ON orangtua.id_warga = sk_penghasilan_orangtua.orangtua_id
LEFT JOIN warga AS anak ON anak.id_warga = sk_penghasilan_orangtua.anak_id
WHERE sk_penghasilan_orangtua.id = " . $_GET['id'] . "
";

$query = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) == 0) {
    die("ID tidak ditemukan");
}
?>

<div class="row page-header">
    <div class="col-sm-12 col-md-9">
        <h4>
            Edit Data Surat Keterangan Penghasilan Orang Tua
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
                <input type="date" class="form-control" id="tanggal_pelaporan" name="tanggal_pelaporan" value="<?= $row['tanggal_pelaporan']; ?>" placeholder="Tanggal Pelaporan" required />
            </div>
            <div class="form-group">
                <label for="orangtua_id">Orang Tua <span class="text-danger">*</span></label>
                <select class="form-control select2" id="orangtua_id" name="orangtua_id" data-placeholder="Cari Orang Tua" required>
                    <option value=""></option>
                    <option value="<?= $row['orangtua_id']; ?>" selected="selected"><?= $row['nama_orangtua']; ?></option>
                </select>
            </div>
            <div class="form-group">
                <label for="anak_id">Anak <span class="text-danger">*</span></label>
                <select class="form-control select2" id="anak_id" name="anak_id" data-placeholder="Cari Anak" required>
                    <option value=""></option>
                    <option value="<?= $row['anak_id']; ?>" selected="selected"><?= $row['nama_anak']; ?></option>
                </select>
            </div>
            <div class=" form-group">
                <label for="penghasilan_orangtua">Penghasilan Orang Tua <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="penghasilan_orangtua" name="penghasilan_orangtua" value="<?= $row['penghasilan_orangtua']; ?>" placeholder="Penghasilan Orang Tua" required />
            </div>
            <div class=" form-group">
                <label for="keperluan">Keperluan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="keperluan" name="keperluan" value="<?= $row['keperluan']; ?>" placeholder="Keperluan" required />
            </div>
            <hr />
            <div class="form-group">
                <label for="nama_kepala_desa">Nama Kepala Desa <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_kepala_desa" name="nama_kepala_desa" value="<?= $row['nama_kepala_desa']; ?>" placeholder="Nama Kepala Desa" required />
            </div>
            <div class="form-group">
                <label for="nrp">NRP</label>
                <input type="text" class="form-control" id="nrp" name="nrp" value="<?= $row['nrp']; ?>" placeholder="NRP" />
            </div>
            <div class="form-group">
                <hr />
                <input type="hidden" name="id_edit" value="<?= $row['id']; ?>" />
                <button type="submit" class="btn btn-success btn-block" id="btn_simpan">Simpan</button>
                <button type="button" class="btn btn-warning btn-block" id="btn_print" disabled>Print</button>
                <a href="index.php" class="btn btn-info btn-block">Kembali</a>
            </div>
        </div>
    </form>
</div>


<?php include __DIR__ . '../../_partials/bottom.php' ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="edit_vitamin.js"></script>