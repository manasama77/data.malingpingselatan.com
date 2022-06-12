<?php include('../_partials/top.php') ?>
<?php
include('_partials/menu.php');
include('data-index.php');
include('../dasbor/data-index.php');
include('./_partials/Helper.php');
unset_session_form();
?>

<h1 class="page-header">Data Mutasi Datang</h1>

<?php
if (isset($_SESSION['success'])) {
?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong><?= $_SESSION['success']; ?></strong>
	</div>
<?php
}
unset($_SESSION['success']);
?>
<?php
if (isset($_SESSION['warning'])) {
?>
	<div class="alert alert-warning alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong><?= $_SESSION['warning']; ?></strong>
	</div>
<?php
}
unset($_SESSION['warning']);
?>
<table class="table table-striped table-condensed table-hover" id="datatable">
	<thead>
		<tr>
			<th>#</th>
			<th>NIK</th>
			<th>Nama Warga</th>
			<th>L/P</th>
			<th>Tgl Lahir</th>
			<th>Tanggal Mutasi</th>
			<th>Jenis Mutasi</th>
			<th>Alasan Mutasi</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor = 1; ?>
		<?php foreach ($data_mutasi as $mutasi) : ?>
			<tr>
				<td><?php echo $nomor++ ?>.</td>
				<td><?php echo $mutasi['nik_warga'] ?></td>
				<td><?php echo $mutasi['nama_warga'] ?></td>
				<td><?php echo ($mutasi['jenis_kelamin_warga'] == "L") ? "Laki-laki" : "Perempuan"; ?></td>
				<td>
					<?php
					if ($mutasi['tanggal_lahir_warga'] != '0000-00-00') {
						$tgl_lahir_obj = new DateTime($mutasi['tanggal_lahir_warga']);
						echo $tgl_lahir_obj->format('d-M-Y');
					}
					?>
				</td>
				<td>
					<?php
					if ($mutasi['tanggal_pindah'] != '0000-00-00') {
						$tgl_pindah_obj = new DateTime($mutasi['tanggal_pindah']);
						echo $tgl_pindah_obj->format('d-M-Y');
					}
					?>
				</td>
				<td><?php echo $mutasi['jenis_kepindahan'] ?></td>
				<td><?php echo $mutasi['alasan_pindah'] ?></td>
				<td>
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li>
								<!-- <a href="show.php?id_mutasi_masuk=<?php echo $mutasi['id_mutasi_masuk'] ?>"><i class="glyphicon glyphicon-sunglasses"></i> Detail</a> -->
								<a href="#" class="btn_detail" data-id="<?= $mutasi['id_mutasi_masuk'] ?>"><i class="glyphicon glyphicon-sunglasses"></i> Detail</a>
							</li>
							<li>
								<a href="cetak-show.php?id_mutasi_masuk=<?php echo $mutasi['id_mutasi_masuk'] ?>" target="_blank"><i class="glyphicon glyphicon-print"></i> Cetak</a>
							</li>
							<?php if ($_SESSION['user']['status_user'] != 'RW') : ?>
								<li class="divider"></li>
								<li>
									<a href="delete.php?id_mutasi_masuk=<?php echo $mutasi['id_mutasi_masuk'] ?>" onclick="return confirm('Yakin hapus data ini?')">
										<i class="glyphicon glyphicon-trash"></i> Hapus
									</a>
								</li>
							<?php endif; ?>
						</ul>
					</div>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<br><br>

<div class="well">
	<dl class="dl-horizontal">
		<dt>Total Mutasi</dt>
		<dd><?php echo $jumlah_mutasi_masuk['total'] ?> orang</dd>

		<dt>Jumlah Laki-laki</dt>
		<dd><?php echo $jumlah_mutasi_masuk_l['total'] ?> orang</dd>

		<dt>Jumlah Perempuan</dt>
		<dd><?php echo $jumlah_mutasi_masuk_p['total'] ?> orang</dd>

		<dt>Warga < 17 tahun</dt>
		<dd><?php echo $jumlah_mutasi_masuk_kd_17['total'] ?> orang</dd>

		<dt>Warga >= 17 tahun</dt>
		<dd><?php echo $jumlah_mutasi_masuk_ld_17['total'] ?> orang</dd>
	</dl>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Detail Mutasi Datang</h4>
			</div>
			<div class="modal-body" id="v_detail">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php include('../_partials/bottom.php') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js" integrity="sha512-x/vqovXY/Q4b+rNjgiheBsA/vbWA3IVvsS8lkQSX1gQ4ggSJx38oI2vREZXpTzhAv6tNUaX81E7QBBzkpDQayA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment-with-locales.min.js" integrity="sha512-vFABRuf5oGUaztndx4KoAEUVQnOvAIFs59y4tO0DILGWhQiFnFHiR+ZJfxLDyJlXgeut9Z07Svuvm+1Jv89w5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/locale/id.min.js" integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	$(document).ready(function() {
		$('.btn_detail').on('click', function(e) {
			e.preventDefault()
			showDetail($(this).data('id'))
		})
	})

	function showDetail(id) {
		$.ajax({
			url: `data-show.php`,
			method: 'get',
			dataType: 'json',
			data: {
				id_mutasi_masuk: id
			}
		}).fail(e => {
			console.log(e.responseText)
		}).done(e => {
			if (e.code == 400) {
				alert(`${e.message}`)
			} else if (e.code == 200) {
				let htmlnya = ``

				htmlnya += `
					<table class="table table-striped table-middle">
						<tr>
							<th width="20%">Jenis Kepindahan</th>
							<td width="1%">:</td>
							<td id="jenis_kepindahan">${e.data.jenis_kepindahan}</td>
						</tr>
					</table>
				`

				let group_kepala = ``
				let group_anggota = ``
				if (e.data.jenis_kepindahan == "Kepala Keluarga") {
					group_kepala = `
						<tr>
							<th width="20%">Nomor Kartu Keluarga</th>
							<td width="1%">:</td>
							<td id="nomor_keluarga">${e.data.nomor_keluarga}</td>
						</tr>
					`
				} else if (e.data.jenis_kepindahan == "Anggota Keluarga") {
					group_anggota = `
						<tr>
							<th width="20%">Nomor Kartu Keluarga</th>
							<td width="1%">:</td>
							<td id="nomor_keluarga">${e.data.nomor_keluarga}</td>
						</tr>
						<tr>
							<th width="20%">Kepala Keluarga</th>
							<td width="1%">:</td>
							<td id="nomor_keluarga">(${e.data.nik_kepala_keluarga}) ${e.data.nama_kepala_keluarga}</td>
						</tr>
					`
				}

				htmlnya += `
					<h3>Data Pribadi</h3>
					<table class="table table-striped table-middle">
						${group_kepala}
						${group_anggota}
						<tr>
							<th width="20%">NIK Warga</th>
							<td width="1%">:</td>
							<td id="nik_kepala_keluarga">${e.data.nik_warga}</td>
						</tr>
						<tr>
							<th>Nama Warga</th>
							<td>:</td>
							<td id="nama_kepala_keluarga">${e.data.nama_warga}</td>
						</tr>
						<tr>
							<th>Tempat Lahir</th>
							<td>:</td>
							<td id="tempat_lahir_warga">${e.data.tempat_lahir_warga}</td>
						</tr>
						<tr>
							<th>Tanggal Lahir</th>
							<td>:</td>
							<td id="tanggal_lahir_warga">${moment(e.data.tanggal_lahir_warga).format('DD MMMM YYYY')}</td>
						</tr>
						<tr>
							<th>Jenis Kelamin</th>
							<td>:</td>
							<td id="jk">${(e.data.jenis_kelamin_warga == "L") ? "Laki-laki" : "Perempuan"}</td>
						</tr>
						<tr>
							<th>Agama</th>
							<td>:</td>
							<td id="agama_warga">${e.data.agama_warga}</td>
						</tr>
						<tr>
							<th>Pendidikan Terakhir</th>
							<td>:</td>
							<td id="pendidikan_terakhir_warga">${e.data.pendidikan_terakhir_warga}</td>
						</tr>
						<tr>
							<th>Pekerjaan</th>
							<td>:</td>
							<td id="pekerjaan_warga">${e.data.pekerjaan_warga}</td>
						</tr>
					</table>

					<h3>Data Daerah Tujuan</h3>
					<table class="table table-striped table-middle">
						<tr>
							<th width="20%" style="vertical-align: top !important;">Alamat Tujuan</th>
							<td width="1%" style="vertical-align: top !important;">:</td>
							<td id="alamat_asal" style="vertical-align: top !important;">
								${e.data.alamat_tujuan.replace(/(?:\r\n|\r|\n)/g, '<br>')}
							</td>
						</tr>
						<tr>
							<th width="20%">RT</th>
							<td width="1%">:</td>
							<td id="rt_warga">${e.data.rt_warga}</td>
						</tr>
						<tr>
							<th>RW</th>
							<td>:</td>
							<td id="rw_warga">${e.data.rw_warga}</td>
						</tr>
						<tr>
							<th>Desa/Kelurahan</th>
							<td>:</td>
							<td id="kelurahan">${e.data.desa_kelurahan_warga}</td>
						</tr>
						<tr>
							<th>Kecamatan</th>
							<td>:</td>
							<td id="kecamatan">${e.data.kecamatan_warga}</td>
						</tr>
						<tr>
							<th>Kabupaten/Kota</th>
							<td>:</td>
							<td id="kokab">${e.data.kabupaten_kota_warga}</td>
						</tr>
						<tr>
							<th>Provinsi</th>
							<td>:</td>
							<td id="provinsi">${e.data.provinsi_warga}</td>
						</tr>
						<tr>
							<th>Negara</th>
							<td>:</td>
							<td id="negara">${e.data.negara_warga}</td>
						</tr>
					</table>

					<h3>Data Kepindahan</h3>
					<table class="table table-striped table-middle">
						<tr>
							<th width="20%" style="vertical-align: top !important;">Alamat Asal</th>
							<td width="1%" style="vertical-align: top !important;">:</td>
							<td id="alamat_asal" style="vertical-align: top !important;">
								${e.data.alamat_asal.replace(/(?:\r\n|\r|\n)/g, '<br>')}
							</td>
						</tr>
						<tr>
							<th>Tanggal Pindah</th>
							<td>:</td>
							<td id="tanggal_pindah">${moment(e.data.tanggal_pindah).format('DD MMMM YYYY')}</td>
						</tr>
						<tr>
							<th>Alasan Pindah</th>
							<td>:</td>
							<td id="alasan_pindah">${e.data.alasan_pindah}</td>
						</tr>
					</table>
			`

				$('#v_detail').html(htmlnya)
				$('#modal_detail').modal('show')
			}
		})
	}
</script>