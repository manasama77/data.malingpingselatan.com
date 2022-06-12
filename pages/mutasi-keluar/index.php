<?php include('../_partials/top.php') ?>

<h1 class="page-header">Data Mutasi Keluar</h1>
<?php include('_partials/menu.php') ?>

<?php include('data-index.php') ?>
<?php include('../dasbor/data-index.php') ?>

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
      <th>Alamat Tujuan</th>
      <th>Alasan Pindah</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $nomor = 1; ?>
    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
      <tr>
        <td><?php echo $nomor++ ?>.</td>
        <td><?php echo $row['nik_warga'] ?></td>
        <td><?php echo $row['nama_warga'] ?></td>
        <td><?php echo ($row['jenis_kelamin_warga'] == "L") ? "Laki-laki" : "Perempuan" ?></td>
        <td><?php echo $row['alamat_tujuan'] ?></td>
        <td><?php echo $row['alasan_pindah'] ?></td>
        <td>
          <!-- Single button -->
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
              <li>
                <a href="#" data-id="<?php echo $row['id_mutasi_keluar'] ?>" class="detail"><i class="glyphicon glyphicon-sunglasses"></i> Detail</a>
              </li>
              <li>
                <a href="cetak-show.php?id_mutasi_keluar=<?php echo $row['id_mutasi_keluar'] ?>" target="_blank"><i class="glyphicon glyphicon-print"></i> Cetak</a>
              </li>
              <?php if ($_SESSION['user']['status_user'] != 'RW') : ?>
                <li class="divider"></li>
                <li>
                  <a href="delete.php?id_mutasi_keluar=<?php echo $row['id_mutasi_keluar'] ?>" onclick="return confirm('Yakin hapus data ini?')">
                    <i class="glyphicon glyphicon-trash"></i> Hapus
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </div>
        </td>
      </tr>
    <?php endwhile ?>
  </tbody>
</table>

<br><br>

<div class="well">
  <dl class="dl-horizontal">
    <dt>Total Mutasi</dt>
    <dd><?php echo $jumlah_mutasi_keluar['total'] ?> orang</dd>

    <dt>Jumlah Laki-laki</dt>
    <dd><?php echo $jumlah_mutasi_keluar_l['total'] ?> orang</dd>

    <dt>Jumlah Perempuan</dt>
    <dd><?php echo $jumlah_mutasi_keluar_p['total'] ?> orang</dd>

    <dt>Warga < 17 tahun</dt>
    <dd><?php echo $jumlah_mutasi_keluar_kd_17['total'] ?> orang</dd>

    <dt>Warga >= 17 tahun</dt>
    <dd><?php echo $jumlah_mutasi_keluar_ld_17['total'] ?> orang</dd>
  </dl>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detail Mutasi Keluar</h4>
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
    $('.detail').on('click', function(e) {
      e.preventDefault()
      let id_mutasi_keluar = $(this).data('id')
      showDetail(id_mutasi_keluar)
    })
  })

  function showDetail(id) {
    $.ajax({
      url: `data-show.php`,
      method: 'get',
      dataType: 'json',
      data: {
        id_mutasi_keluar: id
      }
    }).fail(e => {
      console.log(e.responseText)
    }).done(e => {
      if (e.code == 404) {
        alert(`${e.message}`)
      } else if (e.code == 200) {
        console.log(e.data)
        let htmlnya = ``

        htmlnya += `
        <h3>Data Kepindahan</h3>
          <table class="table table-striped table-middle">
            <tr>
              <th width="20%">NIK / Nama Pemohon</th>
              <td width="1%">:</td>
              <td>
                ${e.data.nik_warga}
              </td>
            </tr>
            <tr>
              <th width="20%">Tanggal Pindah</th>
              <td width="1%">:</td>
              <td>
                ${moment(e.data.tanggal_pindah).format('DD MMMM YYYY')}
              </td>
            </tr>
            <tr>
              <th>Alasan Pindah</th>
              <td>:</td>
              <td>
                ${e.data.alasan_pindah}
              </td>
            </tr>
          </table>

          <h3>Data Daerah Tujuan</h3>
          <table class="table table-striped table-middle">
            <tr>
              <th width="20%">Alamat</th>
              <td width="1%">:</td>
              <td>
                ${e.data.alamat_tujuan}
              </td>
            </tr>
            <tr>
              <th>RT</th>
              <td>:</td>
              <td>
                ${e.data.rt_tujuan}
              </td>
            </tr>
            <tr>
              <th>RW</th>
              <td>:</td>
              <td>
                ${e.data.rw_tujuan}
              </td>
            </tr>
            <tr>
              <th>Desa/Kelurahan</th>
              <td>:</td>
              <td>
                ${e.data.desa_kelurahan_tujuan}
              </td>
            </tr>
            <tr>
              <th>Kecamatan</th>
              <td>:</td>
              <td>
                ${e.data.kecamatan_tujuan}
              </td>
            </tr>
            <tr>
              <th>Kabupaten/Kota</th>
              <td>:</td>
              <td>
                ${e.data.kabupaten_kota_tujuan}
              </td>
            </tr>
            <tr>
              <th>Provinsi</th>
              <td>:</td>
              <td>
                ${e.data.provinsi_tujuan}
              </td>
            </tr>
            <tr>
              <th>Negara</th>
              <td>:</td>
              <td>
                ${e.data.negara_tujuan}
              </td>
            </tr>
          </table>
				`

        $('#v_detail').html(htmlnya)
        $('#modal_detail').modal('show')
      }
    })
  }
</script>