<?php include('../_partials/top.php') ?>

<button type="button" class="btn btn-info btn-sm" onclick="javascript:history.back()">
  <i class="fa fa-arrow-circle-left"></i> Kembali
</button>
<h1 class="page-header" align="center">Pindah Keluar</h1>
<?php include('list_keluarga.php') ?>

<?php
include('../../config/koneksi.php');
$sql_has_kk     = "SELECT * FROM warga_has_kartu_keluarga WHERE id_warga = '9' LIMIT 1";
$query_has_kk   = mysqli_query($db, $sql_has_kk);
$num_row_has_kk = mysqli_num_rows($query_has_kk);
$res_has_kk = mysqli_fetch_assoc($query_has_kk);
?>


<form action="store_keluar.php" method="post">
  <h3>Data Kepindahan</h3>
  <table class="table table-striped table-middle">
    <tr>
      <th width="20%">NIK / Nama Pemohon</th>
      <td width="1%">:</td>
      <td>
        <select class="form-control select2" name="id_warga" data-placeholder="NIK / Nama Pemohon" required>
          <option value=""></option>
          <?php foreach ($data_warga as $warga) : ?>
            <option value="<?php echo $warga['id_warga'] ?>">
              (<?php echo $warga['nik_warga'] ?>) <?php echo $warga['nama_warga'] ?>
            </option>
          <?php endforeach ?>
        </select>
      </td>
    </tr>
    <tr>
      <th width="20%">Tanggal Pindah</th>
      <td width="1%">:</td>
      <td>
        <div class="input-group">
          <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
          </span>
          <input type="text" class="form-control datepicker input-md" name="tanggal_pindah" size="20" readonly="readonly" />
        </div>
      </td>
    </tr>
    <tr>
      <th>Alasan Pindah</th>
      <td>:</td>
      <td>
        <select class="form-control" name="alasan_pindah" required>
          <option value="" selected disabled>- pilih -</option>
          <option value="Pekerjaan">Pekerjaan</option>
          <option value="Pendidikan">Pendidikan</option>
          <option value="Keamanan">Keamanan</option>
          <option value="Kesehatan">Kesehatan</option>
          <option value="Perumahan">Perumahan</option>
          <option value="Keluarga">Keluarga</option>
        </select>
      </td>
    </tr>
  </table>

  <h3>Data Daerah Tujuan</h3>
  <table class="table table-striped table-middle">
    <tr>
      <th width="20%">Alamat</th>
      <td width="1%">:</td>
      <td><textarea class="form-control" name="alamat_mutasi" required></textarea></td>
    </tr>
    <tr>
      <th>RT</th>
      <td>:</td>
      <td><input type="text" class="form-control" name="rt_mutasi" required></td>
    </tr>
    <tr>
      <th>RW</th>
      <td>:</td>
      <td><input type="text" class="form-control" name="rw_mutasi" required></td>
    </tr>
    <tr>
      <th>Desa/Kelurahan</th>
      <td>:</td>
      <td><input type="text" class="form-control" name="desa_kelurahan_mutasi" required></td>
    </tr>
    <tr>
      <th>Kecamatan</th>
      <td>:</td>
      <td><input type="text" class="form-control" name="kecamatan_mutasi" required></td>
    </tr>
    <tr>
      <th>Kabupaten/Kota</th>
      <td>:</td>
      <td><input type="text" class="form-control" name="kabupaten_kota_mutasi" required></td>
    </tr>
    <tr>
      <th>Provinsi</th>
      <td>:</td>
      <td><input type="text" class="form-control" name="provinsi_mutasi" required></td>
    </tr>
    <tr>
      <th>Negara</th>
      <td>:</td>
      <td><input type="text" class="form-control" name="negara_mutasi" value="Indonesia" required></td>
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