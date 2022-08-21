<?php include __DIR__ . '../../_partials/top.php' ?>

<?php
include('../../config/koneksi.php');

$sql = "
SELECT  
    sk_pemakaman.id,
    sk_pemakaman.jenazah_id,
    sk_pemakaman.tanggal_meninggal,
    sk_pemakaman.penyebab_kematian,
    sk_pemakaman.pengurus_pemakaman,
    sk_pemakaman.dimakamkan_di,
    sk_pemakaman.pelapor_id,
    sk_pemakaman.tanggal_pelaporan,
    sk_pemakaman.nama_kepala_desa,
    sk_pemakaman.nrp,
    sk_pemakaman.nomor_surat,
    
    jenazah.nama_warga as nama_jenazah,
    jenazah.nik_warga as nik_jenazah,
    jenazah.tempat_lahir_warga as tempat_lahir_jenazah,
    jenazah.tanggal_lahir_warga as tanggal_lahir_jenazah,
    jenazah.jenis_kelamin_warga as jenis_kelamin_jenazah,
    jenazah.negara_warga as negara_jenazah,
    jenazah.status_perkawinan as status_perkawinan_jenazah,
    jenazah.agama_warga as agama_jenazah,
    jenazah.pekerjaan_warga as pekerjaan_jenazah,
    jenazah.alamat_ktp_warga as alamat_ktp_jenazah,

    pelapor.nama_warga as nama_pelapor,
    pelapor.nik_warga as nik_pelapor,
    pelapor.tempat_lahir_warga as tempat_lahir_pelapor,
    pelapor.tanggal_lahir_warga as tanggal_lahir_pelapor,
    pelapor.jenis_kelamin_warga as jenis_kelamin_pelapor,
    pelapor.negara_warga as negara_pelapor,
    pelapor.status_perkawinan as status_perkawinan_pelapor,
    pelapor.agama_warga as agama_pelapor,
    pelapor.pekerjaan_warga as pekerjaan_pelapor,
    pelapor.alamat_ktp_warga as alamat_ktp_pelapor
FROM sk_pemakaman 
LEFT JOIN warga as jenazah ON jenazah.id_warga = sk_pemakaman.jenazah_id
LEFT JOIN warga as pelapor ON pelapor.id_warga = sk_pemakaman.pelapor_id
WHERE sk_pemakaman.id = " . $_GET['id'] . "
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
            Edit Data Surat Keterangan Pemakaman
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
                <label for="jenazah_id">Warga yang Meninggal <span class="text-danger">*</span></label>
                <select class="form-control select2" id="jenazah_id" name="jenazah_id" data-placeholder="Cari Warga yang Meninggal" required>
                    <option value=""></option>
                    <option value="<?= $row['jenazah_id']; ?>" selected="selected"><?= $row['nama_jenazah']; ?></option>
                </select>
            </div>
            <div class=" form-group">
                <label for="tanggal_meninggal">Tanggal Meninggal <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_meninggal" name="tanggal_meninggal" placeholder="Tanggal Meninggal" value="<?= $row['tanggal_meninggal']; ?>" required />
            </div>
            <div class=" form-group">
                <label for="penyebab_kematian">Penyebab Kematian <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="penyebab_kematian" name="penyebab_kematian" placeholder="Penyebab Kematian" value="<?= $row['penyebab_kematian']; ?>" required />
            </div>
            <div class=" form-group">
                <label for="pengurus_pemakaman">Yang Mengurus Pemakaman <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="pengurus_pemakaman" name="pengurus_pemakaman" placeholder="Yang Mengurus Pemakaman" value="<?= $row['pengurus_pemakaman']; ?>" required />
            </div>
            <div class=" form-group">
                <label for="dimakamkan_di">Dimakamkan di <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="dimakamkan_di" name="dimakamkan_di" placeholder="Dimakamkan di" value="<?= $row['dimakamkan_di']; ?>" required />
            </div>
            <div class="form-group">
                <label for="pelapor_id">Pelapor <span class="text-danger">*</span></label>
                <select class="form-control select2" id="pelapor_id" name="pelapor_id" data-placeholder="Cari Pelapor" required>
                    <option value=""></option>
                    <option value="<?= $row['pelapor_id']; ?>" selected="selected"><?= $row['nama_pelapor']; ?></option>
                </select>
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