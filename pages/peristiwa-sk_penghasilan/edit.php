<?php include __DIR__ . '../../_partials/top.php' ?>

<?php
include('../../config/koneksi.php');

$sql = "
SELECT  
    sk_penghasilan.id,
    sk_penghasilan.warga_id,
    sk_penghasilan.penghasilan,
    sk_penghasilan.keterangan,
    sk_penghasilan.tanggal_pelaporan,
    sk_penghasilan.nama_kepala_desa,
    sk_penghasilan.nrp,
    sk_penghasilan.nomor_surat,
    
    warga.nama_warga as nama_warga,
    warga.nik_warga as nik_warga,
    warga.tempat_lahir_warga as tempat_lahir_warga,
    warga.tanggal_lahir_warga as tanggal_lahir_warga,
    warga.jenis_kelamin_warga as jenis_kelamin_warga,
    warga.negara_warga as negara_warga,
    warga.status_perkawinan as status_perkawinan_warga,
    warga.agama_warga as agama_warga,
    warga.pekerjaan_warga as pekerjaan_warga,
    warga.alamat_ktp_warga as alamat_ktp_warga

FROM sk_penghasilan 
LEFT JOIN warga ON warga.id_warga = sk_penghasilan.warga_id
WHERE sk_penghasilan.id = " . $_GET['id'] . "
";

$query = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) == 0) {
    die("ID tidak ditemukan");
}
?>

<div class="row page-header">
    <div class="col-sm-12 col-md-6">
        <h4>
            Edit Data Surat Keterangan Penghasilan
        </h4>
    </div>
    <div class="col-sm-12 col-md-6 text-right">
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
                <label for="warga_id">Warga <span class="text-danger">*</span></label>
                <select class="form-control select2" id="warga_id" name="warga_id" data-placeholder="Cari Warga" required>
                    <option value=""></option>
                    <option value="<?= $row['warga_id']; ?>" selected="selected"><?= $row['nama_warga']; ?></option>
                </select>
            </div>
            <div class=" form-group">
                <label for="penghasilan">Penghasilan <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="penghasilan" name="penghasilan" placeholder="Penghasilan" value="<?= $row['penghasilan']; ?>" required />
            </div>
            <div class=" form-group">
                <label for="keterangan">Keterangan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="<?= $row['keterangan']; ?>" required />
            </div>
            <hr />
            <div class="form-group">
                <label for="nama_kepala_desa">Nama Kepala Desa <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_kepala_desa" name="nama_kepala_desa" placeholder="Nama Kepala Desa" value="<?= $row['nama_kepala_desa']; ?>" required />
            </div>
            <div class="form-group">
                <label for="nrp">NRP <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nrp" name="nrp" placeholder="NRP" value="<?= $row['nrp']; ?>" required />
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