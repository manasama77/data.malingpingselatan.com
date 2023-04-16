<?php include('../_partials/top.php') ?>

<h1 class="page-header">Data Warga</h1>
<?php include('_partials/menu.php') ?>

<?php include('data-show.php') ?>
<button type="button" class="btn btn-info btn-sm" onclick="javascript:history.back()">
  <i class="fa fa-arrow-circle-left"></i> Kembali
</button>

<form action="update.php" method="post">
  <h3>A. Data Pribadi</h3>
  <table class="table table-striped table-middle">
    <tr>
      <th width="20%">NIK</th>
      <td width="1%">:</td>
      <td><input type="text" class="form-control" name="nik_warga" value="<?php echo $data_warga[0]['nik_warga'] ?>"></td>
    </tr>
    <tr>
      <th>Nama Warga</th>
      <td>:</td>
      <td><input type="text" class="form-control" name="nama_warga" value="<?php echo $data_warga[0]['nama_warga'] ?>"></td>
    </tr>
    <tr>
      <th>Tempat, Tanggal Lahir</th>
      <td>:</td>
      <td>
        <div class="row">
          <div class="col-sm-3">
            <input type="text" class="form-control" name="tempat_lahir_warga" value="<?php echo $data_warga[0]['tempat_lahir_warga'] ?>" required>
          </div>
          <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon">
                <span class="fa fa-table"></span>
              </span>
              <input type="text" class="form-control datepicker input-md" name="tgl_kelahiran" value="<?php echo ($data_warga[0]['tanggal_lahir_warga'] == "0000-00-00") ? null : $data_warga[0]['tanggal_lahir_warga'] ?>" readonly="readonly" />
            </div>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <th>Golongan Darah</th>
      <td>:</td>
      <td>
        <div class="row">
          <div class="col-sm-2">
            <input type="text" class="form-control" name="golongan_darah" minlength="1" maxlength="3" value="<?= $data_warga[0]['golongan_darah']; ?>">
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <th>Jenis Kelamin</th>
      <td>:</td>
      <td>
        <?php if ($data_warga[0]['jenis_kelamin_warga'] == 'L') { ?>

          <div class="radio">
            <label class="radio"><input type="radio" name="jenis_kelamin_warga" value="L" checked="checked"> Laki - laki</label>
          </div>
          <div class="radio">
            <label class="radio"><input type="radio" name="jenis_kelamin_warga" value="P"> Perempuan</label>
          </div>
        <?php } else { ?>
          <div class="radio">
            <label class="radio"><input type="radio" name="jenis_kelamin_warga" value="L"> Laki - laki</label>
          </div>
          <div class="radio">
            <label class="radio"><input type="radio" name="jenis_kelamin_warga" value="P" checked="checked"> Perempuan</label>
          </div>
        <?php } ?>
        </div>
        </div>
      </td>
    </tr>
  </table>

  <h3>B. Data Alamat</h3>
  <table class="table table-striped table-middle">
    <tr>
      <th width="20%">Alamat KTP</th>
      <td width="1%">:</td>
      <td><textarea class="form-control" name="alamat_ktp_warga"><?php echo $data_warga[0]['alamat_ktp_warga'] ?></textarea></td>
    </tr>
    <tr>
      <th>Alamat</th>
      <td>:</td>
      <td><textarea class="form-control" name="alamat_warga"><?php echo $data_warga[0]['alamat_warga'] ?></textarea></td>
    </tr>
    <!-- <tr>
      <th>Dusun</th>
      <td>:</td>
      <td>
        <select class="form-control selectpicker" name="dusun_warga" required>
          <option value="<?php echo $data_warga[0]['dusun_warga'] ?>" selected><?php echo $data_warga[0]['dusun_warga'] ?></option>
          <option value="Dukuh">Dukuh</option>
          <option value="Tarikolot">Tarikolot</option>
        </select>
      </td>
    </tr> -->

    <tr>
      <th>RT</th>
      <td>:</td>
      <td>
        <input type="number" class="form-control" name="rt_warga" value="<?php echo $data_warga[0]['rt_warga'] ?>" required />
      </td>
    </tr>
    <tr>
      <th>RW</th>
      <td>:</td>
      <td>
        <input type="number" class="form-control" name="rw_warga" value="<?php echo $data_warga[0]['rw_warga'] ?>" required />
      </td>
    </tr>
    <tr>
      <th>Desa/Kelurahan</th>
      <td>:</td>
      <td><input type="text" class="form-control" name="desa_kelurahan_warga" value="<?php echo $data_warga[0]['desa_kelurahan_warga'] ?>"></td>
    </tr>
    <tr>
      <th>Kecamatan</th>
      <td>:</td>
      <td><input type="text" class="form-control" name="kecamatan_warga" value="<?php echo $data_warga[0]['kecamatan_warga'] ?>"></td>
    </tr>
    <tr>
      <th>Kabupaten/Kota</th>
      <td>:</td>
      <td><input type="text" class="form-control" name="kabupaten_kota_warga" value="<?php echo $data_warga[0]['kabupaten_kota_warga'] ?>"></td>
    </tr>
    <tr>
      <th>Provinsi</th>
      <td>:</td>
      <td><input type="text" class="form-control" name="provinsi_warga" value="<?php echo $data_warga[0]['provinsi_warga'] ?>"></td>
    </tr>
    <tr>
      <th>Negara</th>
      <td>:</td>
      <td><input type="text" class="form-control" name="negara_warga" value="<?php echo $data_warga[0]['negara_warga'] ?>"></td>
    </tr>

  </table>

  <h3>C. Data Lain-lain</h3>
  <table class="table table-striped table-middle">
    <tr>
      <th width="20%">Agama</th>
      <td width="1%">:</td>
      <td>
        <select class="form-control selectlive" name="agama_warga" required>
          <option value="<?php echo $data_warga[0]['agama_warga'] ?>" selected><?php echo $data_warga[0]['agama_warga'] ?></option>
          <option value="Islam">Islam</option>
          <option value="Protestan">Protestan</option>
          <option value="Katolik">Katolik</option>
          <option value="Hindu">Hindu</option>
          <option value="Budha">Budha</option>
          <option value="Konghucu">Konghucu</option>
        </select>
      </td>
    </tr>
    <tr>
      <th>Pendidikan Terakhir</th>
      <td>:</td>
      <td>
        <select class="form-control selectlive" name="pendidikan_terakhir_warga" required>
          <option value="<?php echo $data_warga[0]['pendidikan_terakhir_warga'] ?>" selected><?php echo $data_warga[0]['pendidikan_terakhir_warga'] ?></option>
          <option value="Tidak Sekolah">Tidak Sekolah</option>
          <option value="Tidak Tamat SD">Tidak Tamat SD</option>
          <option value="SD">SD</option>
          <option value="SMP">SMP</option>
          <option value="SMA">SMA</option>
          <option value="D1">D1</option>
          <option value="D2">D2</option>
          <option value="D3">D3</option>
          <option value="S1">S1</option>
          <option value="S2">S2</option>
          <option value="S3">S3</option>
        </select>
      </td>
    </tr>
    <tr>
      <th>Pekerjaan</th>
      <td>:</td>
      <td><input type="text" class="form-control" name="pekerjaan_warga" value="<?php echo $data_warga[0]['pekerjaan_warga'] ?>"></td>
    </tr>
    <tr>
      <th>Status Penduduk</th>
      <td>:</td>
      <td>
        <select class="form-control selectpicker" name="status_warga" required>
          <option value="">- pilih -</option>
          <option <?= ($data_warga[0]['status_warga'] == "Tinggal Tetap") ? "selected" : "" ?> value="Tinggal Tetap">Tinggal Tetap</option>
          <option <?= ($data_warga[0]['status_warga'] == "Meninggal") ? "selected" : "" ?> value="Meninggal">Meninggal</option>
          <option <?= ($data_warga[0]['status_warga'] == "Pindah Datang") ? "selected" : "" ?> value="Pindah Datang">Pindah Datang</option>
          <option <?= ($data_warga[0]['status_warga'] == "Pindah Keluar") ? "selected" : "" ?> value="Pindah Keluar">Pindah Keluar</option>
          <option <?= ($data_warga[0]['status_warga'] == "Kontrak") ? "selected" : "" ?> value="Kontrak">Kontrak</option>
        </select>
      </td>
    </tr>
    <tr>
      <th>Status Perkawinan</th>
      <td>:</td>
      <td>
        <select class="form-control" name="status_perkawinan" required>
          <option value="" selected disabled>- pilih -</option>
          <option <?= ($data_warga[0]['status_perkawinan'] == "Belum Kawin") ? "selected" : "" ?> value="Belum Kawin">Belum Kawin</option>
          <option <?= ($data_warga[0]['status_perkawinan'] == "Kawin") ? "selected" : "" ?> value="Kawin">Kawin</option>
          <option <?= ($data_warga[0]['status_perkawinan'] == "Cerai Hidup") ? "selected" : "" ?> value="Cerai Hidup">Cerai Hidup</option>
          <option <?= ($data_warga[0]['status_perkawinan'] == "Cerai Mati") ? "selected" : "" ?> value="Cerai Mati">Cerai Mati</option>
        </select>
      </td>
    </tr>
    <tr>
      <th>Tanggal Perkawinan</th>
      <td>:</td>
      <td>
        <div class="row">
          <div class="col-sm-3">
            <input type="date" class="form-control input-md" name="tanggal_perkawinan" value="<?= $data_warga[0]['tanggal_perkawinan']; ?>" />
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <th>Status hubungan dalam keluarga</th>
      <td>:</td>
      <td>
        <input type="text" class="form-control" name="status_hubungan_dalam_keluarga" maxlength="100" value="<?= $data_warga[0]['status_hubungan_dalam_keluarga']; ?>" required>
      </td>
    </tr>
    <tr>
      <th>Nama Orang Tua</th>
      <td>:</td>
      <td>
        <div class="row">
          <div class="col-sm-6">
            <div class="input-group">
              <div class="input-group-addon">
                Ayah
              </div>
              <input type="text" class="form-control" name="nama_ayah" placeholder="Nama Ayah" value="<?= $data_warga[0]['nama_ayah']; ?>" required>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="input-group">
              <div class="input-group-addon">
                Ibu
              </div>
              <input type="text" class="form-control" name="nama_ibu" placeholder="Nama Ibu" value="<?= $data_warga[0]['nama_ibu']; ?>" required>
            </div>
          </div>
        </div>
      </td>
    </tr>
  </table>

  <button type="submit" class="btn btn-success">
    <i class="fa fa-save"></i> Simpan
  </button>
  <button type="button" class="btn btn-danger" onclick="javascript:history.back()">
    <i class="fa fa-arrow-circle-left"></i> Batal
  </button>
  <input type="hidden" name="id_warga" value="<?php echo $data_warga[0]['id_warga'] ?>">
</form>

<?php include('../_partials/bottom.php') ?>