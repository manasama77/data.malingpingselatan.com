<?php
include('../_partials/top.php');
include('../../config/koneksi.php');
include('./_partials/Helper.php');
cek_session();
?>

<?php
$sql_kk   = "SELECT kartu_keluarga.id_keluarga, kartu_keluarga.nomor_keluarga, warga.nama_warga FROM kartu_keluarga LEFT JOIN warga on warga.id_warga = kartu_keluarga.id_kepala_keluarga";
$query_kk = mysqli_query($db, $sql_kk);
?>

<button type="button" class="btn btn-info btn-sm" onclick="javascript:history.back()">
	<i class="fa fa-arrow-circle-left"></i> Kembali
</button>
<h1 class="page-header" align="center">Pindah Masuk</h1>

<?php
if (isset($_SESSION['warning'])) {
?>
	<div class="alert alert-warning alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong><?= $_SESSION['warning']; ?></strong>
	</div>
<?php
	unset($_SESSION['warning']);
}
?>

<form action="store_datang.php" method="post">
	<table class="table table-striped table-middle">
		<tr>
			<th width="20%">Jenis Kepindahan</th>
			<td width="1%">:</td>
			<td>
				<select class="form-control" id="jenis_kepindahan" name="jenis_kepindahan" required>
					<option <?= ($_SESSION['jenis_kepindahan'] == "Perorangan") ? "selected" : null; ?> value="Perorangan">Perorangan</option>
					<option <?= ($_SESSION['jenis_kepindahan'] == "Kepala Keluarga") ? "selected" : null; ?> value="Kepala Keluarga" default>Kepala Keluarga</option>
					<option <?= ($_SESSION['jenis_kepindahan'] == "Anggota Keluarga") ? "selected" : null; ?> value="Anggota Keluarga" default>Anggota Keluarga</option>
				</select>
			</td>
		</tr>
	</table>
	<h3>Data Pribadi</h3>
	<table class="table table-striped table-middle">
		<tr id="group_nomor_keluarga" style="display: none;">
			<th width="20%">Nomor Kartu Keluarga</th>
			<td width="1%">:</td>
			<td>
				<input type="text" placeholder="NO KK" class="form-control" name="nomor_keluarga" value="<?= $_SESSION['nomor_keluarga']; ?>" minlength="16" maxlength="16" />
			</td>
		</tr>
		<tr id="group_kk" style="display: none;">
			<th width="20%">Kepala Keluarga</th>
			<td width="1%">:</td>
			<td>
				<select class="form-control select2" id="id_keluarga" name="id_keluarga" data-placeholder="Pilih Kartu Keluarga" style="width: 100%;">
					<option value=""></option>
					<?php while ($row = mysqli_fetch_assoc($query_kk)) { ?>
						<option value="<?= $row['id_keluarga']; ?>">(<?= $row['nomor_keluarga']; ?>) <?= $row['nama_warga']; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<th>NIK Warga</th>
			<td>:</td>
			<td>
				<input type="text" placeholder="NIK Warga" class="form-control" name="nik_warga" value="<?= $_SESSION['nik_warga']; ?>" required>
			</td>
		</tr>
		<tr>
			<th width="20%">Nama Warga</th>
			<td width="1%">:</td>
			<td>
				<input type="text" placeholder="Nama Warga" class="form-control" name="nama_warga" value="<?= $_SESSION['nama_warga']; ?>" required>
			</td>
		</tr>
		<tr>
			<th>Tempat Lahir</th>
			<td>:</td>
			<td><input type="text" placeholder="Tempat Lahir" class="form-control" name="tempat_lahir_warga" value="<?= $_SESSION['tempat_lahir_warga']; ?>" required></td>
		</tr>
		<tr>
			<th>Tanggal Lahir</th>
			<td>:</td>
			<td>
				<div class="input-group">
					<span class="input-group-addon">
						<span class="fa fa-calendar"></span>
					</span>
					<input type="text" class="form-control datepicker input-md" name="tanggal_lahir_warga" size="20" value="<?= $_SESSION['tanggal_lahir_warga']; ?>" readonly="readonly" />
				</div>
			</td>
		</tr>
		<tr>
			<th>Jenis Kelamin</th>
			<td>:</td>
			<td>
				<div class="form-group">
					<div class="col-md-9">
						<div class="radio">
							<label class="radio"><input type="radio" name="jk" value="L" <?= ($_SESSION['jenis_kelamin_warga'] == "L") ? "checked" : null; ?> required> Laki - laki</label>
						</div>
						<div class="radio">
							<label class="radio"><input type="radio" name="jk" value="P" <?= ($_SESSION['jenis_kelamin_warga'] == "P") ? "checked" : null; ?> required> Perempuan</label>
						</div>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<th>Agama</th>
			<td>:</td>
			<td>
				<select class="form-control" name="agama_warga" required>
					<option <?= ($_SESSION['agama_warga'] == "Islam") ? "selected" : null; ?> value="Islam">Islam</option>
					<option <?= ($_SESSION['agama_warga'] == "Kristen") ? "selected" : null; ?> value="Kristen">Kristen</option>
					<option <?= ($_SESSION['agama_warga'] == "Katholik") ? "selected" : null; ?> value="Katholik">Katholik</option>
					<option <?= ($_SESSION['agama_warga'] == "Hindu") ? "selected" : null; ?> value="Hindu">Hindu</option>
					<option <?= ($_SESSION['agama_warga'] == "Budha") ? "selected" : null; ?> value="Budha">Budha</option>
					<option <?= ($_SESSION['agama_warga'] == "Konghucu") ? "selected" : null; ?> value="Konghucu">Konghucu</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>Pendidikan Terakhir</th>
			<td>:</td>
			<td>
				<select class="form-control" name="pendidikan_terakhir_warga" required>
					<option <?= ($_SESSION['pendidikan_terakhir_warga'] == "Tidak Sekolah") ? "selected" : null; ?> value="Tidak Sekolah">Tidak Sekolah</option>
					<option <?= ($_SESSION['pendidikan_terakhir_warga'] == "Tidak Tamat SD") ? "selected" : null; ?> value="Tidak Tamat SD">Tidak Tamat SD</option>
					<option <?= ($_SESSION['pendidikan_terakhir_warga'] == "SD") ? "selected" : null; ?> value="SD">SD</option>
					<option <?= ($_SESSION['pendidikan_terakhir_warga'] == "SMP") ? "selected" : null; ?> value="SMP">SMP</option>
					<option <?= ($_SESSION['pendidikan_terakhir_warga'] == "SMA") ? "selected" : null; ?> value="SMA">SMA</option>
					<option <?= ($_SESSION['pendidikan_terakhir_warga'] == "D1") ? "selected" : null; ?> value="D1">D1</option>
					<option <?= ($_SESSION['pendidikan_terakhir_warga'] == "D2") ? "selected" : null; ?> value="D2">D2</option>
					<option <?= ($_SESSION['pendidikan_terakhir_warga'] == "D3") ? "selected" : null; ?> value="D3">D3</option>
					<option <?= ($_SESSION['pendidikan_terakhir_warga'] == "S1") ? "selected" : null; ?> value="S1">S1</option>
					<option <?= ($_SESSION['pendidikan_terakhir_warga'] == "S2") ? "selected" : null; ?> value="S2">S2</option>
					<option <?= ($_SESSION['pendidikan_terakhir_warga'] == "S3") ? "selected" : null; ?> value="S3">S3</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>Pekerjaan</th>
			<td>:</td>
			<td><input type="text" class="form-control" name="pekerjaan_warga" placeholder="Pekerjaan" value="<?= $_SESSION['pekerjaan_warga']; ?>" required /></td>
		</tr>
	</table>

	<h3>Data Daerah Tujuan</h3>
	<table class="table table-striped table-middle">
		<tr>
			<th width="20%">Alamat Tujuan</th>
			<td width="1%">:</td>
			<td><textarea placeholder="Alamat Tujuan" class="form-control" name="alamat_tujuan" required><?= $_SESSION['alamat_tujuan']; ?></textarea></td>
		</tr>
		<tr>
			<th width="20%">RT</th>
			<td width="1%">:</td>
			<td>
				<input type="number" class="form-control" id="rt_warga" name="rt_warga" placeholder="RT" value="<?= $_SESSION['rt_warga']; ?>" required />
			</td>
		</tr>
		<tr>
			<th>RW</th>
			<td>:</td>
			<td>
				<input type="number" class="form-control" id="rw_warga" name="rw_warga" placeholder="RW" value="<?= $_SESSION['rw_warga']; ?>" required />
			</td>
		</tr>
		<tr>
			<th>Desa/Kelurahan</th>
			<td>:</td>
			<td>
				<input type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="Desa/Kelurahan" value="<?= ($_SESSION['kelurahan']) ?? "Periuk"; ?>" required />
			</td>
		</tr>
		<tr>
			<th>Kecamatan</th>
			<td>:</td>
			<td>
				<input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Kecamatan" value="<?= ($_SESSION['kecamatan']) ?? "Gebang Raya"; ?>" required />
			</td>
		</tr>
		<tr>
			<th>Kabupaten/Kota</th>
			<td>:</td>
			<td>
				<input type="text" class="form-control" id="kokab" name="kokab" placeholder="Kabupaten/Kota" value="<?= ($_SESSION['kokab']) ?? "Tangerang"; ?>" required />
			</td>
		</tr>
		<tr>
			<th>Provinsi</th>
			<td>:</td>
			<td>
				<input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Provinsi" value="<?= ($_SESSION['provinsi']) ?? "Banten"; ?>" required />
			</td>
		</tr>
		<tr>
			<th>Negara</th>
			<td>:</td>
			<td>
				<input type="text" class="form-control" id="negara" name="negara" placeholder="Negara" value="<?= ($_SESSION['negara']) ?? "Indonesia"; ?>" required />
			</td>
		</tr>
	</table>

	<h3>Data Kepindahan</h3>
	<table class="table table-striped table-middle">
		<tr>
			<th width="20%">Alamat Asal</th>
			<td width="1%">:</td>
			<td><textarea placeholder="Alamat Asal" class="form-control" name="alamat_asal" required><?= $_SESSION['alamat_asal']; ?></textarea></td>
		</tr>
		<tr>
			<th>Tanggal Pindah</th>
			<td>:</td>
			<td>
				<div class="input-group">
					<span class="input-group-addon">
						<span class="fa fa-table"></span>
					</span>
					<input type="text" class="form-control datepicker input-md" name="tanggal_pindah" size="20" value="<?= $_SESSION['tanggal_pindah']; ?>" readonly="readonly" />
				</div>
			</td>
		</tr>
		<tr>
			<th>Alasan Pindah</th>
			<td>:</td>
			<td>
				<select class="form-control selectpicker" name="alasan_pindah" required>
					<option <?= ($_SESSION['alasan_pindah'] == "Pekerjaan") ? "selected" : null; ?> value="Pekerjaan">Pekerjaan</option>
					<option <?= ($_SESSION['alasan_pindah'] == "Pendidikan") ? "selected" : null; ?> value="Pendidikan">Pendidikan</option>
					<option <?= ($_SESSION['alasan_pindah'] == "Keamanan") ? "selected" : null; ?> value="Keamanan">Keamanan</option>
					<option <?= ($_SESSION['alasan_pindah'] == "Kesehatan") ? "selected" : null; ?> value="Kesehatan">Kesehatan</option>
					<option <?= ($_SESSION['alasan_pindah'] == "Perumahan") ? "selected" : null; ?> value="Perumahan">Perumahan</option>
					<option <?= ($_SESSION['alasan_pindah'] == "Keluarga") ? "selected" : null; ?> value="Keluarga">Keluarga</option>
				</select>
			</td>
		</tr>
	</table>

	<button type="submit" class="btn btn-success">
		<i class="fa fa-save"></i> Simpan
	</button>
	<button type="button" class="btn btn-danger" onclick="javascript:history.back();">
		<i class="fa fa-arrow-circle-left"></i> Batal
	</button>
</form>

<?php include('../_partials/bottom.php') ?>

<script>
	$(document).ready(function() {
		$('#jenis_kepindahan').on('change', function(e) {
			let val = $(this).val()
			if (val == "Kepala Keluarga") {
				$('#group_nomor_keluarga').show()
				$('#nomor_keluarga').attr('required', true)
				$('#group_kk').hide()
				$('#id_keluarga').attr('required', false)
			} else if (val == "Anggota Keluarga") {
				$('#group_nomor_keluarga').hide()
				$('#nomor_keluarga').attr('required', false)
				$('#group_kk').show()
				$('#id_keluarga').attr('required', true)
			} else {
				$('#group_nomor_keluarga').hide()
				$('#nomor_keluarga').attr('required', false)
				$('#group_kk').hide()
				$('#id_keluarga').attr('required', false)
			}
		})
	})
</script>