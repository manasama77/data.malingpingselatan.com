<?php include __DIR__ . '../../_partials/top.php' ?>

<?php
include('../../config/koneksi.php');

$sql = "
SELECT  
    surat_pengantar_izin_keramaian.id,
    surat_pengantar_izin_keramaian.warga_id,
    surat_pengantar_izin_keramaian.acara,
    surat_pengantar_izin_keramaian.tanggal_jam_acara,
    surat_pengantar_izin_keramaian.tempat_acara,
    surat_pengantar_izin_keramaian.jumlah_peserta,
    surat_pengantar_izin_keramaian.hiburan,
    surat_pengantar_izin_keramaian.penanggungjawab_acara,
    surat_pengantar_izin_keramaian.tanggal_pelaporan,
    surat_pengantar_izin_keramaian.nama_kepala_desa,
    surat_pengantar_izin_keramaian.nomor_kapolsek,
    surat_pengantar_izin_keramaian.tanggal_kapolsek,
    surat_pengantar_izin_keramaian.diizinkan_kapolsek,
    surat_pengantar_izin_keramaian.catatan_kapolsek,
    surat_pengantar_izin_keramaian.nama_danramil,
    surat_pengantar_izin_keramaian.nrp_danramil,
    surat_pengantar_izin_keramaian.nama_kapolsek,
    surat_pengantar_izin_keramaian.nrp_kapolsek,
    surat_pengantar_izin_keramaian.no_rw,
    surat_pengantar_izin_keramaian.nama_rw,
    surat_pengantar_izin_keramaian.no_rt,
    surat_pengantar_izin_keramaian.nama_rt,
    
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

FROM surat_pengantar_izin_keramaian 
LEFT JOIN warga ON warga.id_warga = surat_pengantar_izin_keramaian.warga_id
WHERE surat_pengantar_izin_keramaian.id = " . $_GET['id'] . "
";

$query = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) == 0) {
    die("ID tidak ditemukan");
}
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<div class="row page-header">
    <div class="col-sm-12 col-md-9">
        <h4>
            Edit Data Surat Pengantar Izin Keramaian
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
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h3>Detail Acara</h3>
                <div class="form-group">
                    <label for="tanggal_pelaporan">Tanggal Pelaporan <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="tanggal_pelaporan" name="tanggal_pelaporan" value="<?= $row['tanggal_pelaporan']; ?>" placeholder="Tanggal Pelaporan" required />
                </div>
                <div class="form-group">
                    <label for="warga_id">Pemohon <span class="text-danger">*</span></label>
                    <select class="form-control select2" id="warga_id" name="warga_id" data-placeholder="Cari Pemohon" required>
                        <option value=""></option>
                        <option value="<?= $row['warga_id']; ?>" selected="selected"><?= $row['nama_warga']; ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="acara">Acara <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="acara" name="acara" placeholder="Acara" value="<?= $row['acara']; ?>" required />
                </div>
                <div class="form-group">
                    <label for="tanggal_jam_acara">Tanggal & Jam Acara <span class="text-danger">*</span></label>
                    <input type="text" class="form-control datetimepicker" id="tanggal_jam_acara" name="tanggal_jam_acara" value="<?= $row['tanggal_jam_acara']; ?>" placeholder="Tanggal Acara" required />
                </div>
                <div class=" form-group">
                    <label for="tempat_acara">Tempat Acara <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="tempat_acara" name="tempat_acara" placeholder="Tempat Acara" required><?= $row['tempat_acara']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="jumlah_peserta">Jumlah Peserta <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="jumlah_peserta" name="jumlah_peserta" placeholder="Jumlah Peserta" min="0" value="<?= $row['jumlah_peserta']; ?>" required />
                </div>
                <div class="form-group">
                    <label for="hiburan">Hiburan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="hiburan" name="hiburan" placeholder="Hiburan" value="<?= $row['hiburan']; ?>" required />
                </div>
                <div class="form-group">
                    <label for="penanggungjawab_acara">Penanggungjawab Acara <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="penanggungjawab_acara" name="penanggungjawab_acara" placeholder="Penanggungjawab Acara" value="<?= $row['penanggungjawab_acara']; ?>" required />
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <h3>Izin Kapolsek</h3>
                <div class="form-group">
                    <label for="nomor_kapolsek">Nomor Izin Kapolsek <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nomor_kapolsek" name="nomor_kapolsek" placeholder="Nomor Izin Kapolsek" value="<?= $row['nomor_kapolsek']; ?>" required />
                </div>
                <div class="form-group">
                    <label for="tanggal_kapolsek">Tanggal Izin Kapolsek <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="tanggal_kapolsek" name="tanggal_kapolsek" placeholder="Tanggal Izin Kapolsek" value="<?= $row['tanggal_kapolsek']; ?>" required />
                </div>
                <div class="form-group">
                    <label for="diizinkan_kapolsek">Status Izin Kapolsek <span class="text-danger">*</span></label>
                    <select class="form-control" id="diizinkan_kapolsek" name="diizinkan_kapolsek" required>
                        <option <?= ($row['diizinkan_kapolsek'] == "ya") ? "selected" : null; ?> value="ya">Diizinkan</option>
                        <option <?= ($row['diizinkan_kapolsek'] == "tidak") ? "selected" : null; ?> value="tidak">Tidak Diizinkan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="catatan_kapolsek">Catatan Kapolsek <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="catatan_kapolsek" name="catatan_kapolsek" placeholder="Catatan Kapolsek" required><?= $row['catatan_kapolsek']; ?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <hr />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h3>Tanda Tangan</h3>
                <div class="form-group">
                    <label for="nama_kepala_desa">Nama Kepala Desa <span class="text-danger">*</span></label>
                    <input type="text" value="<?= $row['nama_kepala_desa']; ?>" class="form-control" id="nama_kepala_desa" name="nama_kepala_desa" placeholder="Nama Kepala Desa" required />
                </div>
                <div class="form-group">
                    <label for="nama_danramil">Nama Danramil <span class="text-danger">*</span></label>
                    <input type="text" value="<?= $row['nama_danramil']; ?>" class="form-control" id="nama_danramil" name="nama_danramil" placeholder="Nama Danramil" required />
                </div>
                <div class="form-group">
                    <label for="nrp_danramil">NRP Danramil <span class="text-danger">*</span></label>
                    <input type="text" value="<?= $row['nrp_danramil']; ?>" class="form-control" id="nrp_danramil" name="nrp_danramil" placeholder="NRP Danramil" required />
                </div>
                <div class="form-group">
                    <label for="nama_kapolsek">Nama Kapolsek <span class="text-danger">*</span></label>
                    <input type="text" value="<?= $row['nama_kapolsek']; ?>" class="form-control" id="nama_kapolsek" name="nama_kapolsek" placeholder="Nama Kapolsek" required />
                </div>
                <div class="form-group">
                    <label for="nrp_kapolsek">NRP Kapolsek <span class="text-danger">*</span></label>
                    <input type="text" value="<?= $row['nrp_kapolsek']; ?>" class="form-control" id="nrp_kapolsek" name="nrp_kapolsek" placeholder="NRP Kapolsek" required />
                </div>
                <div class="form-group">
                    <label for="no_rw">No RW <span class="text-danger">*</span></label>
                    <input type="number" value="<?= $row['no_rw']; ?>" class="form-control" id="no_rw" name="no_rw" placeholder="No RW" required />
                </div>
                <div class="form-group">
                    <label for="nama_rw">Nama RW <span class="text-danger">*</span></label>
                    <input type="text" value="<?= $row['nama_rw']; ?>" class="form-control" id="nama_rw" name="nama_rw" placeholder="Nama RW" required />
                </div>
                <div class="form-group">
                    <label for="no_rt">No RT <span class="text-danger">*</span></label>
                    <input type="number" value="<?= $row['no_rt']; ?>" class="form-control" id="no_rt" name="no_rt" placeholder="No RT" required />
                </div>
                <div class="form-group">
                    <label for="nama_rt">Nama RT <span class="text-danger">*</span></label>
                    <input type="text" value="<?= $row['nama_rt']; ?>" class="form-control" id="nama_rt" name="nama_rt" placeholder="Nama RT" required />
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <h3>Izin Lingkungan</h3>
                <div class="form-group">
                    <label for="nama_perwakilan">Nama Perwakilan Warga / Tetangga <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_perwakilan" placeholder="Nama Perwakilan Warga / Tetangga" />
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary btn-block" onclick="tambahPerwakilan();"><i class="fa fa-plus fa-fw"></i> Tambah Perwakilan</button>
                </div>
                <hr />
                <div class="table-responsive">
                    <table class="table table-bordered" id="table_perwakilan">
                        <caption>List Perwakilan</caption>
                        <thead class="bg-info">
                            <tr>
                                <th class="text-center">
                                    <i class="fa fa-cog"></i>
                                </th>
                                <th>Nama Perwakilan</th>
                            </tr>
                        </thead>
                        <tbody id="v_list_perwakilan">
                            <tr>
                                <td colspan="2" class="text-center">Tidak ada perwakilan</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="form-group">
                    <hr />
                    <input type="hidden" id="id_edit" name="id_edit" value="<?= $row['id']; ?>" />
                    <button type="submit" class="btn btn-success btn-block" id="btn_simpan"><i class="fa fa-save fa-fw"></i> Simpan</button>
                    <button type="button" class="btn btn-warning btn-block" id="btn_print" disabled><i class="fa fa-print fa-fw"></i> Print</button>
                    <a href="index.php" class="btn btn-info btn-block"><i class="fa fa-backward fa-fw"></i> Kembali</a>
                </div>
            </div>
        </div>
    </form>
</div>


<?php include __DIR__ . '../../_partials/bottom.php' ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js" integrity="sha512-eYSzo+20ajZMRsjxB6L7eyqo5kuXuS2+wEbbOkpaur+sA2shQameiJiWEzCIDwJqaB0a4a6tCuEvCOBHUg3Skg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="edit_vitamin.js"></script>