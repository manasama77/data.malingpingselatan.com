<?php include __DIR__ . '../../_partials/top.php' ?>

<?php
include('../../config/koneksi.php');

$sql = "
SELECT
    id,
    jenis_lembaga,
    nama_lembaga,
    alamat,
    tahun_pendirian,
    sk_pendirian,
    jumlah_pegawai,
    pengurus,
    pimpinan,
    sekertaris,
    bendahara,
    masa_berlaku,
    tanggal_pembuatan,
    nomor_surat,
    nama_kepala_desa,
    nrp
FROM
	sk_domisili_lembaga
WHERE 
    sk_domisili_lembaga.id = " . $_GET['id'] . "
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
            Edit Data Surat Keterangan Domisili Perusahaan, Yayasan, Sekolah, Organisasi
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
                <label for="masa_berlaku">Masa Berlaku SK <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="masa_berlaku" name="masa_berlaku" placeholder="Masa Berlaku SK" value="<?= $row['masa_berlaku']; ?>" required />
            </div>
            <div class="form-group">
                <label for="jenis_lembaga">Jenis Lembaga <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="jenis_lembaga" name="jenis_lembaga" placeholder="Jenis Lembaga" value="<?= $row['jenis_lembaga']; ?>" required />
            </div>
            <div class="form-group">
                <label for="nama_lembaga">Nama Lembaga <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_lembaga" name="nama_lembaga" placeholder="Nama Lembaga" value="<?= $row['nama_lembaga']; ?>" required />
            </div>
            <div class="form-group">
                <label for="alamat">Alamat Lembaga <span class="text-danger">*</span></label>
                <textarea class="form-control" id="alamat" name="alamat" placeholder="Nama Lembaga" required><?= $row['alamat']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="tahun_pendirian">Tahun Pendirian <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="tahun_pendirian" name="tahun_pendirian" placeholder="Tahun Pendirian" min="1900" max="2050" step="1" value="<?= $row['tahun_pendirian']; ?>" required />
            </div>
            <div class="form-group">
                <label for="sk_pendirian">SK Pendirian <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="sk_pendirian" name="sk_pendirian" placeholder="SK Pendirian" value="<?= $row['sk_pendirian']; ?>" required />
            </div>
            <div class="form-group">
                <label for="jumlah_pegawai">Jumlah Pegawai <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="jumlah_pegawai" name="jumlah_pegawai" placeholder="Jumlah Pegawai" min="0" value="<?= $row['jumlah_pegawai']; ?>" required />
            </div>
            <div class="form-group">
                <label for="pengurus">Pengurus </label>
                <input type="text" class="form-control" id="pengurus" name="pengurus" placeholder="Pengurus" value="<?= $row['pengurus']; ?>" />
            </div>
            <div class="form-group">
                <label for="pimpinan">Pimpinan/Kepala/Ketua <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="pimpinan" name="pimpinan" placeholder="Pimpinan/Kepala/Ketua" value="<?= $row['pimpinan']; ?>" required />
            </div>
            <div class="form-group">
                <label for="sekertaris">Sekertaris </label>
                <input type="text" class="form-control" id="sekertaris" name="sekertaris" placeholder="Sekertaris" value="<?= $row['sekertaris']; ?>" />
            </div>
            <div class="form-group">
                <label for="bendahara">Bendahara </label>
                <input type="text" class="form-control" id="bendahara" name="bendahara" placeholder="Bendahara" value="<?= $row['bendahara']; ?>" />
            </div>
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