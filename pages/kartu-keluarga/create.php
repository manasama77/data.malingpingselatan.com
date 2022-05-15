<?php include('../_partials/top.php') ?>

<h1 class="page-header">Data Kartu Keluarga</h1>
<?php include('_partials/menu.php') ?>

<?php include('data-create.php') ?>
<button type="button" class="btn btn-info btn-sm" onclick="javascript:history.back()">
  <i class="fa fa-arrow-circle-left"></i> Kembali
</button>

<form action="store.php" method="post">
  <h3>A. Data Pribadi</h3>
  <table class="table table-striped table-middle">
    <tr>
      <th width="20%">Nomor Kartu Keluarga</th>
      <td width="1%">:</td>
      <td><input type="text" class="form-control" name="nomor_keluarga" required></td>
    </tr>
    <tr>
      <th>ID Kepala Keluarga</th>
      <td>:</td>
      <td>
        <select class="form-control selectlive" id="id_kepala_keluarga" name="id_kepala_keluarga" required>
          <option value="" selected disabled>Pilih Kepala Keluarga</option>
          <?php foreach ($data_warga as $warga) : ?>
            <option value="<?php echo $warga['id_warga'] ?>">
              <?php echo $warga['nama_warga'] ?> (NIK: <?php echo $warga['nik_warga'] ?>)
            </option>
          <?php endforeach ?>
        </select>
      </td>
    </tr>
  </table>

  <h3>B. Data Alamat</h3>
  <table class="table table-striped table-middle">
    <tr>
      <th width="20%">Alamat</th>
      <td width="1%">:</td>
      <td><textarea class="form-control" id="alamat_keluarga" name="alamat_keluarga"></textarea></td>
    </tr>
    <tr>
      <th>RT</th>
      <td>:</td>
      <td><input type="text" class="form-control" id="rt_keluarga" name="rt_keluarga" required></td>
    </tr>
    <tr>
      <th>RW</th>
      <td>:</td>
      <td><input type="text" class="form-control" id="rw_keluarga" name="rw_keluarga" required></td>
    </tr>
    <tr>
      <th>Kode Pos</th>
      <td>:</td>
      <td><input type="text" class="form-control" id="kode_pos_keluarga" name="kode_pos_keluarga"></td>
    </tr>

    <tr>
      <th>Desa/Kelurahan</th>
      <td>:</td>
      <td><input type="text" class="form-control" id="desa_kelurahan_keluarga" name="desa_kelurahan_keluarga" required></td>
    </tr>
    <tr>
      <th>Kecamatan</th>
      <td>:</td>
      <td><input type="text" class="form-control" id="kecamatan_keluarga" name="kecamatan_keluarga" required></td>
    </tr>
    <tr>
      <th>Kabupaten/Kota</th>
      <td>:</td>
      <td><input type="text" class="form-control" id="kabupaten_kota_keluarga" name="kabupaten_kota_keluarga" required></td>
    </tr>
    <tr>
      <th>Provinsi</th>
      <td>:</td>
      <td><input type="text" class="form-control" id="provinsi_keluarga" name="provinsi_keluarga" required></td>
    </tr>
    <tr>
      <th>Negara</th>
      <td>:</td>
      <td><input type="text" class="form-control" name="negara_keluarga" value="<?php echo $_SESSION['user']['negara_user'] ?>" required></td>
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
  $(document).ready(() => {
    $('#id_kepala_keluarga').on('change', () => {
      let id_kepala_keluarga = $('#id_kepala_keluarga :selected').val()
      if (id_kepala_keluarga != "") {
        autoFillData(id_kepala_keluarga)
      }
    })
  })

  function autoFillData(id_kepala_keluarga) {
    $.ajax({
      url: `ajax_kk.php`,
      method: 'GET',
      data: {
        id_kepala_keluarga: id_kepala_keluarga,
      },
      dataType: 'JSON'
    }).error(e => {
      console.log(e.responseText)
    }).done(e => {
      console.log(e)
      if (e.code == 200) {
        $('#alamat_keluarga').val(e.data.alamat_warga)
        $('#rt_keluarga').val(e.data.rt_warga)
        $('#rw_keluarga').val(e.data.rw_warga)
        $('#desa_kelurahan_keluarga').val(e.data.desa_kelurahan_warga)
        $('#kecamatan_keluarga').val(e.data.kecamatan_warga)
        $('#kabupaten_kota_keluarga').val(e.data.kabupaten_kota_warga)
        $('#provinsi_keluarga').val(e.data.provinsi_warga)
      }
    })
  }
</script>