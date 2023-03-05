<?php include __DIR__ . '../../_partials/top.php' ?>

<?php
include('../../config/koneksi.php');

$sql = "
SELECT
    id,
    warga_id, 
    tanggal_pembuatan, 
    nomor_surat,
    nama_kepala_desa,
    reg_no_camat, 
    tanggal_ttd_camat, 
    nama_camat, 
    nip_camat, 
    reg_no_danramil, 
    tanggal_ttd_danramil, 
    nama_danramil, 
    nrp_danramil, 
    reg_no_kapolsek, 
    tanggal_ttd_kapolsek, 
    nama_kapolsek, 
    nrp_kapolsek,
    warga.nama_warga
FROM
	skck
    left join warga on warga.id_warga = skck.warga_id
WHERE 
    skck.id = " . $_GET['id'] . "
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
            Edit Data Surat Pengantar Catatan Kepolisian
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
                <input type="date" class="form-control" id="tanggal_pembuatan" name="tanggal_pembuatan" value="<?= $row['tanggal_pembuatan']; ?>" required />
            </div>
            <div class="form-group">
                <label for="warga_id">Warga <span class="text-danger">*</span></label>
                <select class="form-control select2" id="warga_id" name="warga_id" required>
                    <option value=""></option>
                    <option value="<?= $row['warga_id']; ?>" selected="selected"><?= $row['nama_warga']; ?></option>
                </select>
            </div>
        </div>
        <div class="col-sm-12 col-md-12">
            <hr />
            <h2 class="text-center">Tanda Tangan</h2>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="nama_camat">Nama Camat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_camat" name="nama_camat" placeholder="Nama Camat" value="<?= $row['nama_camat']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="nip_camat">NIP Camat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nip_camat" name="nip_camat" placeholder="NIP Camat" value="<?= $row['nip_camat']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="reg_no_camat">Reg. No Camat</label>
                        <input type="text" class="form-control" id="reg_no_camat" name="reg_no_camat" placeholder="Reg. No Camat" value="<?= $row['reg_no_camat']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_ttd_camat">Tanggal TTD Camat</label>
                        <input type="date" class="form-control" id="tanggal_ttd_camat" name="tanggal_ttd_camat" placeholder="Tanggal TTD Camat" value="<?= $row['tanggal_ttd_camat']; ?>" required />
                    </div>
                    <hr />
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="nama_danramil">Nama Danramil <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_danramil" name="nama_danramil" placeholder="Nama Danramil" value="<?= $row['nama_danramil']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="nrp_danramil">NRP Danramil</label>
                        <input type="text" class="form-control" id="nrp_danramil" name="nrp_danramil" placeholder="NRP Danramil" value="<?= $row['nrp_danramil']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="reg_no_danramil">Reg. No Danramil</label>
                        <input type="text" class="form-control" id="reg_no_danramil" name="reg_no_danramil" placeholder="Reg. No Danramil" value="<?= $row['reg_no_danramil']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_ttd_danramil">Tanggal TTD Danramil</label>
                        <input type="date" class="form-control" id="tanggal_ttd_danramil" name="tanggal_ttd_danramil" placeholder="Tanggal TTD Danramil" value="<?= $row['tanggal_ttd_danramil']; ?>" required />
                    </div>
                    <hr />
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="nama_kapolsek">Nama Kapolsek <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_kapolsek" name="nama_kapolsek" placeholder="Nama Kapolsek" value="<?= $row['nama_kapolsek']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="nrp_kapolsek">NRP Kapolsek</label>
                        <input type="text" class="form-control" id="nrp_kapolsek" name="nrp_kapolsek" placeholder="NRP Kapolsek" value="<?= $row['nrp_kapolsek']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="reg_no_kapolsek">Reg. No Kapolsek</label>
                        <input type="text" class="form-control" id="reg_no_kapolsek" name="reg_no_kapolsek" placeholder="Reg. No Kapolsek" value="<?= $row['reg_no_kapolsek']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_ttd_kapolsek">Tanggal TTD Kapolsek</label>
                        <input type="date" class="form-control" id="tanggal_ttd_kapolsek" name="tanggal_ttd_kapolsek" placeholder="Tanggal TTD Kapolsek" value="<?= $row['tanggal_ttd_kapolsek']; ?>" required />
                    </div>
                    <hr />
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="nama_kepala_desa">Nama Kepala Desa <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_kepala_desa" name="nama_kepala_desa" placeholder="Nama Kepala Desa" value="<?= $row['nama_kepala_desa']; ?>" required />
                    </div>
                    <hr />
                </div>
            </div>
            <hr />
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