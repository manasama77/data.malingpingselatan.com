<?php include __DIR__ . '../../_partials/top.php' ?>

<?php
include('../../config/koneksi.php');

$sql = "
SELECT  
    sk_telah_menikah.id,
    sk_telah_menikah.pelapor_id,
    sk_telah_menikah.pasangan_id,
    sk_telah_menikah.tanggal_menikah,
    sk_telah_menikah.tempat_menikah,
    sk_telah_menikah.nama_wali_nikah,
    sk_telah_menikah.nama_penghulu_nikah,
    sk_telah_menikah.tanggal_pelaporan,
    sk_telah_menikah.nama_kepala_desa,
    sk_telah_menikah.nrp,
    sk_telah_menikah.saksi_1,
    sk_telah_menikah.saksi_2,
    sk_telah_menikah.saksi_3,
    sk_telah_menikah.nomor_surat,
    
    pelapor.nama_warga as nama_pelapor,
    pelapor.nik_warga as nik_pelapor,
    pelapor.tempat_lahir_warga as tempat_lahir_pelapor,
    pelapor.tanggal_lahir_warga as tanggal_lahir_pelapor,
    pelapor.jenis_kelamin_warga as jenis_kelamin_pelapor,
    pelapor.negara_warga as negara_pelapor,
    pelapor.status_perkawinan as status_perkawinan_pelapor,
    pelapor.agama_warga as agama_pelapor,
    pelapor.pekerjaan_warga as pekerjaan_pelapor,
    pelapor.alamat_ktp_warga as alamat_ktp_pelapor,

    pasangan.nama_warga as nama_pasangan,
    pasangan.nik_warga as nik_pasangan,
    pasangan.tempat_lahir_warga as tempat_lahir_pasangan,
    pasangan.tanggal_lahir_warga as tanggal_lahir_pasangan,
    pasangan.jenis_kelamin_warga as jenis_kelamin_pasangan,
    pasangan.negara_warga as negara_pasangan,
    pasangan.status_perkawinan as status_perkawinan_pasangan,
    pasangan.agama_warga as agama_pasangan,
    pasangan.pekerjaan_warga as pekerjaan_pasangan,
    pasangan.alamat_ktp_warga as alamat_ktp_pasangan
FROM sk_telah_menikah 
LEFT JOIN warga as pelapor ON pelapor.id_warga = sk_telah_menikah.pelapor_id
LEFT JOIN warga as pasangan ON pasangan.id_warga = sk_telah_menikah.pasangan_id
WHERE sk_telah_menikah.id = " . $_GET['id'] . "
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
            Edit Data Surat Keterangan Telah Menikah
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
                <label for="pelapor_id">Pelapor <span class="text-danger">*</span></label>
                <select class="form-control select2" id="pelapor_id" name="pelapor_id" data-placeholder="Cari Pelapor" required>
                    <option value=""></option>
                    <option value="<?= $row['pelapor_id']; ?>" selected="selected"><?= $row['nama_pelapor']; ?></option>
                </select>
            </div>
            <div class="form-group">
                <label for="pasangan_id">Pasangan <span class="text-danger">*</span></label>
                <select class="form-control select2" id="pasangan_id" name="pasangan_id" data-placeholder="Cari Pasangan" required>
                    <option value=""></option>
                    <option value="<?= $row['pasangan_id']; ?>" selected="selected"><?= $row['nama_pasangan']; ?></option>
                </select>
            </div>
            <div class=" form-group">
                <label for="tanggal_menikah">Tanggal Menikah <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_menikah" name="tanggal_menikah" placeholder="Tanggal Menikah" value="<?= $row['tanggal_menikah']; ?>" required />
            </div>
            <div class=" form-group">
                <label for="tempat_menikah">Tempat Menikah <span class="text-danger">*</span></label>
                <textarea class="form-control" id="tempat_menikah" name="tempat_menikah" placeholder="Tempat Menikah" required><?= $row['tempat_menikah']; ?></textarea>
            </div>
            <div class=" form-group">
                <label for="nama_wali_nikah">Nama Wali Nikah <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_wali_nikah" name="nama_wali_nikah" placeholder="Nama Wali Nikah" value="<?= $row['nama_wali_nikah']; ?>" required />
            </div>
            <div class=" form-group">
                <label for="nama_penghulu_nikah">Nama Penghulu Pernikahan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_penghulu_nikah" name="nama_penghulu_nikah" placeholder="Nama Penghulu Pernikahan" value="<?= $row['nama_penghulu_nikah']; ?>" required />
            </div>
            <div class=" form-group">
                <label for="saksi_1">Nama Saksi 1 <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="saksi_1" name="saksi_1" placeholder="Nama Saksi 1" value="<?= $row['saksi_1']; ?>" required />
            </div>
            <div class=" form-group">
                <label for="saksi_2">Nama Saksi 2 <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="saksi_2" name="saksi_2" placeholder="Nama Saksi 2" value="<?= $row['saksi_2']; ?>" required />
            </div>
            <div class=" form-group">
                <label for="saksi_3">Nama Saksi 3 <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="saksi_3" name="saksi_3" placeholder="Nama Saksi 3" value="<?= $row['saksi_3']; ?>" required />
            </div>
            <hr />
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
                <input type="hidden" class="form-control" name="id_edit" value="<?= $row['id']; ?>" />
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