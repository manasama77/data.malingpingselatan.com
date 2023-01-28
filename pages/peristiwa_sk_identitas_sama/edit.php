<?php include __DIR__ . '../../_partials/top.php' ?>

<?php
include('../../config/koneksi.php');

$sql = "
SELECT  
    surat_kuasa.id,
    surat_kuasa.warga_1_id,
    surat_kuasa.warga_2_id,
    surat_kuasa.tanggal_kuasa,
    surat_kuasa.keperluan,
    surat_kuasa.tanggal_pelaporan,
    surat_kuasa.saksi_1,
    surat_kuasa.saksi_2,
    surat_kuasa.saksi_3,
    surat_kuasa.nama_kepala_desa,
    surat_kuasa.nomor_surat,
    
    warga_1.nama_warga as nama_warga_1,
    warga_1.nik_warga as nik_warga_1,
    warga_1.tempat_lahir_warga as tempat_lahir_warga_1,
    warga_1.tanggal_lahir_warga as tanggal_lahir_warga_1,
    warga_1.jenis_kelamin_warga as jenis_kelamin_warga_1,
    warga_1.negara_warga as negara_warga_1,
    warga_1.status_perkawinan as status_perkawinan_warga_1,
    warga_1.agama_warga as agama_warga_1,
    warga_1.pekerjaan_warga as pekerjaan_warga_1,
    warga_1.alamat_ktp_warga as alamat_ktp_warga_1,

    warga_2.nama_warga as nama_warga_2,
    warga_2.nik_warga as nik_warga_2,
    warga_2.tempat_lahir_warga as tempat_lahir_warga_2,
    warga_2.tanggal_lahir_warga as tanggal_lahir_warga_2,
    warga_2.jenis_kelamin_warga as jenis_kelamin_warga_2,
    warga_2.negara_warga as negara_warga_2,
    warga_2.status_perkawinan as status_perkawinan_warga_2,
    warga_2.agama_warga as agama_warga_2,
    warga_2.pekerjaan_warga as pekerjaan_warga_2,
    warga_2.alamat_ktp_warga as alamat_ktp_warga_2

FROM surat_kuasa 
LEFT JOIN warga as warga_1 ON warga_1.id_warga = surat_kuasa.warga_1_id
LEFT JOIN warga AS warga_2 ON warga_2.id_warga = surat_kuasa.warga_2_id
WHERE surat_kuasa.id = " . $_GET['id'] . "
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
            Edit Data Surat Kuasa
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
                <label for="warga_1_id">Memberi Kuasa <span class="text-danger">*</span></label>
                <select class="form-control select2" id="warga_1_id" name="warga_1_id" data-placeholder="Cari Memberi Kuasa" required>
                    <option value=""></option>
                    <option value="<?= $row['warga_1_id']; ?>" selected="selected"><?= $row['nama_warga_1']; ?></option>
                </select>
            </div>
            <div class="form-group">
                <label for="warga_2_id">Diberi Kuasa <span class="text-danger">*</span></label>
                <select class="form-control select2" id="warga_2_id" name="warga_2_id" data-placeholder="Cari Diberi Kuasa" required>
                    <option value=""></option>
                    <option value="<?= $row['warga_2_id']; ?>" selected="selected"><?= $row['nama_warga_2']; ?></option>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_kuasa">Tanggal Kuasa <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_kuasa" name="tanggal_kuasa" value="<?= $row['tanggal_kuasa']; ?>" placeholder="Tanggal Kuasa" required />
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
                <label for="saksi_1">Saksi 1 <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="saksi_1" name="saksi_1" value="<?= $row['saksi_1']; ?>" placeholder="Saksi 1" required />
            </div>
            <div class="form-group">
                <label for="saksi_2">Saksi 2 <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="saksi_2" name="saksi_2" value="<?= $row['saksi_2']; ?>" placeholder="Saksi 2" required />
            </div>
            <div class="form-group">
                <label for="saksi_3">Saksi 3 <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="saksi_3" name="saksi_3" value="<?= $row['saksi_3']; ?>" placeholder="Saksi 3" required />
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