<?php include __DIR__ . '../../_partials/top.php' ?>

<?php
include('../../config/koneksi.php');

$sql = "
SELECT
    id,
    warga_id,
    nama_usaha,
    bidang_usaha,
    alamat_usaha,
    status_bangunan,
    akta_pendirian,
    tahun_pendirian,
    pimpinan,
    jumlah_karyawan,
    modal,
    masa_berlaku,
    tanggal_pembuatan,
    nama_kepala_desa,
    nama_camat,
    nip_camat,
    nomor_surat,
    nama_warga
FROM
	sk_domisili_usaha
LEFT JOIN warga ON warga.id_warga = sk_domisili_usaha.warga_id
WHERE 
    sk_domisili_usaha.id = " . $_GET['id'] . "
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
            Edit Data Surat Keterangan Domisili Usaha
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
                <label for="masa_berlaku">Masa Berlaku <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="masa_berlaku" name="masa_berlaku" placeholder="Masa Berlaku" value="<?= $row['masa_berlaku']; ?>" required />
            </div>
            <div class="form-group">
                <label for="warga_id">Warga <span class="text-danger">*</span></label>
                <select class="form-control select2" id="warga_id" name="warga_id" required>
                    <option value=""></option>
                    <option value="<?= $row['warga_id']; ?>" selected="selected"><?= $row['nama_warga']; ?></option>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_usaha">Nama Usaha <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_usaha" name="nama_usaha" placeholder="Nama Usaha" value="<?= $row['nama_usaha']; ?>" required />
            </div>
            <div class="form-group">
                <label for="bidang_usaha">Bidang Usaha <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="bidang_usaha" name="bidang_usaha" placeholder="Bidang Usaha" value="<?= $row['bidang_usaha']; ?>" required />
            </div>
            <div class="form-group">
                <label for="alamat_usaha">Alamat Usaha <span class="text-danger">*</span></label>
                <textarea class="form-control" id="alamat_usaha" name="alamat_usaha" placeholder="Alamat Usaha" required><?= $row['alamat_usaha']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="status_bangunan">Status Bangunan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="status_bangunan" name="status_bangunan" placeholder="Status Bangunan" value="<?= $row['status_bangunan']; ?>" required />
            </div>
            <div class="form-group">
                <label for="akta_pendirian">Akta Pendirian <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="akta_pendirian" name="akta_pendirian" placeholder="Akta Pendirian" value="<?= $row['akta_pendirian']; ?>" required />
            </div>
            <div class="form-group">
                <label for="tahun_pendirian">Tahun Pendirian <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="tahun_pendirian" name="tahun_pendirian" placeholder="Tahun Pendirian" min="1900" max="2050" step="1" value="<?= $row['tahun_pendirian']; ?>" required />
            </div>
            <div class="form-group">
                <label for="pimpinan">Pimpinan/Pengeola <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="pimpinan" name="pimpinan" placeholder="Pimpinan/Pengeola" value="<?= $row['pimpinan']; ?>" required />
            </div>
            <div class="form-group">
                <label for="jumlah_karyawan">Jumlah Pegawai <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="jumlah_karyawan" name="jumlah_karyawan" placeholder="Jumlah Pegawai" min="0" value="<?= $row['jumlah_karyawan']; ?>" required />
            </div>
            <div class="form-group">
                <label for="modal">Modal <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="modal" name="modal" placeholder="Modal" min="0" value="<?= $row['modal']; ?>" required />
            </div>
            <div class="form-group">
                <label for="nama_kepala_desa">Nama Kepala Desa <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_kepala_desa" name="nama_kepala_desa" placeholder="Nama Kepala Desa" value="<?= $row['nama_kepala_desa']; ?>" required />
            </div>
            <div class="form-group">
                <label for="nama_camat">Nama Camat <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_camat" name="nama_camat" placeholder="Nama Camat" value="<?= $row['nama_camat']; ?>" required />
            </div>
            <div class="form-group">
                <label for="nip_camat">NIP <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nip_camat" name="nip_camat" placeholder="NIP" value="<?= $row['nip_camat']; ?>" required />
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