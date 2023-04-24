<?php
include __DIR__ . '../../_partials/top.php';
include('../../config/koneksi.php');
// include('../constant.php');

$sql = "
SELECT
    kelahiran.id,
    kelahiran.warga_id,
	kelahiran.hari,
	warga.tempat_lahir_warga,
	kelahiran.tanggal_kelahiran,
	kelahiran.jam_kelahiran,
	kelahiran.tempat_kelahiran,
	warga.jenis_kelamin_warga,
	warga.nama_warga,
	warga.agama_warga,
    warga.alamat_warga,
    warga.rt_warga,
    warga.rw_warga,
    warga.desa_kelurahan_warga,
    warga.kecamatan_warga,
    warga.kabupaten_kota_warga,
    warga.provinsi_warga,
	kelahiran.anak_ke,
	kartu_keluarga.id_keluarga,
	kartu_keluarga.nomor_keluarga,
	ibu.id_warga AS id_ibu,
	ibu.nama_warga AS nama_ibu,
	ibu.nik_warga AS nik_ibu,
	ibu.tempat_lahir_warga AS tempat_lahir_ibu,
	ibu.tanggal_lahir_warga AS tanggal_lahir_ibu,
	ibu.pekerjaan_warga AS pekerjaan_ibu,
	ibu.alamat_warga AS alamat_ibu,
    ayah.id_warga AS id_ayah,
	ayah.nama_warga AS nama_ayah,
	ayah.nik_warga AS nik_ayah,
	ayah.tempat_lahir_warga AS tempat_lahir_ayah,
	ayah.tanggal_lahir_warga AS tanggal_lahir_ayah,
	ayah.pekerjaan_warga AS pekerjaan_ayah,
	ayah.alamat_warga AS alamat_ayah,
	pelapor.nama_warga AS nama_pelapor,
	pelapor.nik_warga AS nik_pelapor,
	pelapor.tempat_lahir_warga AS tempat_lahir_pelapor,
	pelapor.tanggal_lahir_warga AS tanggal_lahir_pelapor,
	pelapor.pekerjaan_warga AS pekerjaan_pelapor,
	pelapor.alamat_warga AS alamat_pelapor,
    pelapor.jenis_kelamin_warga AS jenis_kelamin_pelapor,
	(
	IF
		(
			( SELECT count( * ) FROM kartu_keluarga WHERE kartu_keluarga.id_kepala_keluarga = kelahiran.pelapor_id ) = 1,
			( SELECT nomor_keluarga FROM kartu_keluarga WHERE kartu_keluarga.id_kepala_keluarga = kelahiran.pelapor_id ),
			( SELECT kartu_keluarga.nomor_keluarga FROM warga_has_kartu_keluarga LEFT JOIN kartu_keluarga ON kartu_keluarga.id_keluarga = warga_has_kartu_keluarga.id_keluarga WHERE warga_has_kartu_keluarga.id_warga = kelahiran.pelapor_id ) 
		) 
	) AS nomor_keluarga_pelapor,
    kelahiran.pelapor_id,
    kelahiran.hubungan_pelapor,
    kelahiran.tanggal_pembuatan,
    kelahiran.nomor_surat,
    kelahiran.nama_ttd,
    kelahiran.jabatan_ttd,
    kelahiran.nomor_induk_ttd
FROM
	kelahiran
	LEFT JOIN warga ON warga.id_warga = kelahiran.warga_id
	LEFT JOIN warga AS ibu ON ibu.id_warga = kelahiran.ibu_id
	LEFT JOIN warga AS ayah ON ayah.id_warga = kelahiran.ayah_id
	LEFT JOIN kartu_keluarga ON kartu_keluarga.id_kepala_keluarga = kelahiran.ayah_id
	LEFT JOIN warga AS pelapor ON pelapor.id_warga = kelahiran.pelapor_id
WHERE 
    kelahiran.id = " . $_GET['id'] . "
";

$query = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($query);

echo '<pre>' . print_r($row, 1) . '</pre>';

if (mysqli_num_rows($query) == 0) {
    die("ID tidak ditemukan");
}
?>

<div class="row page-header">
    <div class="col-sm-12 col-md-6">
        <h4>
            Edit Data Warga Lahir
        </h4>
    </div>
    <div class="col-sm-12 col-md-6 text-right">
        <a href="index.php" class="btn btn-info">
            <i class="fa fa-backward"></i> Kembali
        </a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-6 col-md-offset-3">
        <form id="form">
            <div class="form-group">
                <label for="tanggal_pembuatan">Tanggal Pelaporan <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_pembuatan" name="tanggal_pembuatan" value="<?= $row['tanggal_pembuatan']; ?>" required />
            </div>
            <hr />
            <h1 class="text-center">Biodata Bayi</h1>
            <div class="form-group">
                <label for="nama_bayi">Nama Bayi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_bayi" name="nama_bayi" value="<?= $row['nama_warga']; ?>" placeholder="Nama Bayi" required />
            </div>
            <div class="form-group">
                <label for="anak_ke">Anak ke <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="anak_ke" name="anak_ke" value="<?= $row['anak_ke']; ?>" placeholder="Anak ke" step="1" min="1" required />
            </div>
            <div class="form-group">
                <label for="kota_kelahiran">Kota Kelahiran <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="kota_kelahiran" name="kota_kelahiran" value="<?= $row['tempat_lahir_warga']; ?>" placeholder="Kota Kelahiran" required />
            </div>
            <div class="form-group">
                <label for="tempat_kelahiran">Tempat Kelahiran <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="tempat_kelahiran" name="tempat_kelahiran" value="<?= $row['tempat_kelahiran']; ?>" placeholder="Tempat Kelahiran" required />
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $row['tanggal_kelahiran']; ?>" required />
            </div>
            <div class="form-group">
                <label for="jam_kelahiran">Jam Kelahiran <span class="text-danger">*</span></label>
                <input type="time" class="form-control" id="jam_kelahiran" name="jam_kelahiran" value="<?= $row['jam_kelahiran']; ?>" required />
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                <div class="radio">
                    <label class="jenis_kelamin_warga_l"><input type="radio" id="jenis_kelamin_warga_l" name="jenis_kelamin_warga" <?= ($row['jenis_kelamin_warga'] == "L") ? "checked" : null; ?> value="L"> Laki - laki</label>
                </div>
                <div class="radio">
                    <label class="jenis_kelamin_warga_p"><input type="radio" id="jenis_kelamin_warga_p" name="jenis_kelamin_warga" <?= ($row['jenis_kelamin_warga'] == "P") ? "checked" : null; ?> value="P"> Perempuan</label>
                </div>
            </div>
            <div class="form-group">
                <label for="agama">Agama <span class="text-danger">*</span></label>
                <select class="form-control" id="agama" name="agama" required>
                    <option value=""></option>
                    <option <?= ($row['agama_warga'] == "Islam") ? "selected" : null; ?> value="Islam">Islam</option>
                    <option <?= ($row['agama_warga'] == "Kristen") ? "selected" : null; ?> value="Kristen">Kristen</option>
                    <option <?= ($row['agama_warga'] == "Katholik") ? "selected" : null; ?> value="Katholik">Katholik</option>
                    <option <?= ($row['agama_warga'] == "Hindu") ? "selected" : null; ?> value="Hindu">Hindu</option>
                    <option <?= ($row['agama_warga'] == "Budha") ? "selected" : null; ?> value="Budha">Budha</option>
                    <option <?= ($row['agama_warga'] == "Konghucu") ? "selected" : null; ?> value="Konghucu">Konghucu</option>
                </select>
            </div>

            <hr />
            <h1 class="text-center">Data Orang Tua</h1>
            <div class="form-group">
                <label for="ayah_id">Ayah <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="ayah_id" name="ayah_id" value="<?= $row['nama_ayah']; ?>" required readonly />
                    <div class="input-group-addon" style="background-color: #d9534f; color: white;" role="button" id="btn_modal_ayah">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="ibu_id">Ibu <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="ibu_id" name="ibu_id" value="<?= $row['nama_ibu']; ?>" required readonly />
                    <div class="input-group-addon" style="background-color: #d9534f; color: white;" role="button" id="btn_modal_ibu">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
            </div>

            <hr />
            <h1 class="text-center">Data Alamat</h1>
            <div class="form-group">
                <label for="alamat">Alamat Tinggal <span class="text-danger">*</span></label>
                <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat Tinggal" required><?= $row['alamat_warga']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="rt">RT <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="rt" name="rt" placeholder="RT" value="<?= $row['rt_warga']; ?>" required />
            </div>
            <div class="form-group">
                <label for="rw">RW <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="rw" name="rw" placeholder="RW" value="<?= $row['rw_warga']; ?>" required />
            </div>
            <div class="form-group">
                <label for="desa">Desa/Kelurahan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="desa" name="desa" placeholder="Desa/Kelurahan" value="<?= $row['desa_kelurahan_warga']; ?>" required />
            </div>
            <div class="form-group">
                <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Kecamatan" value="<?= $row['kecamatan_warga']; ?>" required />
            </div>
            <div class="form-group">
                <label for="kokab">Kota/Kabupaten <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="kokab" name="kokab" placeholder="Kota/Kabupaten" value="<?= $row['kabupaten_kota_warga']; ?>" required />
            </div>
            <div class="form-group">
                <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Provinsi" value="<?= $row['provinsi_warga']; ?>" required />
            </div>
            <div class="form-group">
                <label for="pelapor_id">Warga yang Melaporkan <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="pelapor_id" name="pelapor_id" value="<?= $row['nama_pelapor']; ?>" required readonly />
                    <div class="input-group-addon" style="background-color: #d9534f; color: white;" role="button" id="btn_modal_pelapor">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="hubungan_pelapor">Hubungan Pelapor <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="hubungan_pelapor" name="hubungan_pelapor" value="<?= $row['hubungan_pelapor']; ?>" placeholder="Hubungan Pelapor" required />
            </div>
            <hr />
            <h2 class="text-center">Tanda Tangan</h2>
            <div class="form-group">
                <label for="nama_ttd">Nama Penandatangan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_ttd" name="nama_ttd" value="<?= $row['nama_ttd']; ?>" placeholder="Nama Penandatangan" required />
            </div>
            <div class="form-group">
                <label for="jabatan_ttd">Jabatan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="jabatan_ttd" name="jabatan_ttd" value="<?= $row['jabatan_ttd']; ?>" placeholder="Jabatan" required />
            </div>
            <div class="form-group">
                <label for="nomor_induk_ttd">Nomor Induk</label>
                <input type="text" class="form-control" id="nomor_induk_ttd" name="nomor_induk_ttd" value="<?= $row['nomor_induk_ttd']; ?>" placeholder="Nomor Induk" />
            </div>
            <div class="form-group">
                <hr />
                <input type="hidden" id="id_edit" name="id_edit" value="<?= $row['id']; ?>" />
                <input type="hidden" id="warga_id" name="warga_id" value="<?= $row['warga_id']; ?>" />
                <input type="hidden" id="ayah_id_hidden" name="ayah_id_hidden" value="<?= $row['id_ayah']; ?>" />
                <input type="hidden" id="keluarga_id_hidden" name="keluarga_id_hidden" value="<?= $row['id_keluarga']; ?>" />
                <input type="hidden" id="ibu_id_hidden" name="ibu_id_hidden" value="<?= $row['id_ibu']; ?>" />
                <input type="hidden" id="pelapor_id_hidden" name="pelapor_id_hidden" value="<?= $row['pelapor_id']; ?>" />
                <button type="submit" class="btn btn-success btn-block" id="btn_simpan">Simpan</button>
                <button type="button" class="btn btn-warning btn-block" id="btn_print" disabled>Print</button>
                <a href="index.php" class="btn btn-info btn-block">Kembali</a>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<form id="form_ayah">
    <div class="modal fade" id="modal_ayah" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pilih Ayah</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ayah_keyword">Nama Ayah</label>
                        <input type="text" class="form-control" id="ayah_keyword" name="ayah_keyword" minlength="3" placeholder="Ketik Nama Warga" required />
                        <span class="text-muted">Ketikan minimal 3 karakter</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed">
                            <thead class="bg-danger">
                                <tr>
                                    <th>NAMA</th>
                                </tr>
                            </thead>
                            <tbody id="v_list_ayah">
                                <tr>
                                    <td>Data Tidak Ditemukan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<form id="form_ibu">
    <div class="modal fade" id="modal_ibu" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pilih Ayah</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ibu_keyword">Nama Ibu</label>
                        <input type="text" class="form-control" id="ibu_keyword" name="ibu_keyword" minlength="3" placeholder="Ketik Nama Warga" required />
                        <span class="text-muted">Ketikan minimal 3 karakter</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed">
                            <thead class="bg-danger">
                                <tr>
                                    <th>NAMA</th>
                                </tr>
                            </thead>
                            <tbody id="v_list_ibu">
                                <tr>
                                    <td>Data Tidak Ditemukan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<form id="form_pelapor">
    <div class="modal fade" id="modal_pelapor" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pilih Pelapor</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pelapor_keyword">Nama Pelapor</label>
                        <input type="text" class="form-control" id="pelapor_keyword" name="pelapor_keyword" minlength="3" placeholder="Ketik Nama Pelapor" required />
                        <span class="text-muted">Ketikan minimal 3 karakter</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed">
                            <thead class="bg-danger">
                                <tr>
                                    <th>NAMA</th>
                                </tr>
                            </thead>
                            <tbody id="v_list_pelapor">
                                <tr>
                                    <td>Data Tidak Ditemukan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>


<?php include __DIR__ . '../../_partials/bottom.php' ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="./edit_vitamin.js"></script>