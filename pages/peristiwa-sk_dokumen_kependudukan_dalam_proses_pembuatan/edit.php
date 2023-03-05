<?php include __DIR__ . '../../_partials/top.php' ?>

<?php
include('../../config/koneksi.php');

$sql = "
SELECT
    id,
    warga_id,
    tanggal_pembuatan,
    nomor_surat,
    jenis_pembuatan,
    nama_kepala_desa,
    nrp,
    warga.nama_warga
FROM
	sk_dokumen_kependudukan_dalam_proses_pembuatan
    left join warga on warga.id_warga = sk_dokumen_kependudukan_dalam_proses_pembuatan.warga_id
WHERE 
    sk_dokumen_kependudukan_dalam_proses_pembuatan.id = " . $_GET['id'] . "
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
            Edit Data Surat Keterangan Dokumen Kependudukan Dalam Proses Pembuatan
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
                <label for="tanggal_pembuatan">Tanggal Pelaporan <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_pembuatan" name="tanggal_pembuatan" value="<?= $row['tanggal_pembuatan']; ?>" placeholder="Tanggal Pelaporan" required />
            </div>
            <div class="form-group">
                <label for="warga_id">Warga <span class="text-danger">*</span></label>
                <select class="form-control select2" id="warga_id" name="warga_id" required>
                    <option value=""></option>
                    <option value="<?= $row['warga_id']; ?>" selected="selected"><?= $row['nama_warga']; ?></option>
                </select>
            </div>
            <div class="form-group">
                <label for="jenis_pembuatan">Jenis Pembuatan <span class="text-danger">*</span></label>
                <select class="form-control" id="jenis_pembuatan" name="jenis_pembuatan" required>
                    <option <?= ($row['jenis_pembuatan'] == "E-KTP") ? "selected" : ""; ?> value="E-KTP">E-KTP</option>
                    <option <?= ($row['jenis_pembuatan'] == "Kartu Keluarga") ? "selected" : ""; ?> value="Kartu Keluarga">Kartu Keluarga</option>
                    <option <?= ($row['jenis_pembuatan'] == "Akte Kelahiran") ? "selected" : ""; ?> value="Akte Kelahiran">Akte Kelahiran</option>
                    <option <?= ($row['jenis_pembuatan'] == "Akte Kematian") ? "selected" : ""; ?> value="Akte Kematian">Akte Kematian</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_kepala_desa">Nama Kepala Desa <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_kepala_desa" name="nama_kepala_desa" placeholder="Nama Kepala Desa" value="<?= $row['nama_kepala_desa']; ?>" required />
            </div>
            <div class="form-group">
                <label for="nrp">NRP</label>
                <input type="text" class="form-control" id="nrp" name="nrp" placeholder="NRP" value="<?= $row['nrp']; ?>" />
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