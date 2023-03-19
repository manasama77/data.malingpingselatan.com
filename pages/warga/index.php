<?php include('../_partials/top.php') ?>

<h1 class="page-header">Data Warga</h1>
<?php include('_partials/menu.php') ?>

<?php include('data-index.php') ?>
<?php include('../dasbor/data-index.php') ?>

<?php
$batas = 10;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$prev = $halaman - 1;
$next = $halaman + 1;

$sql_all_data = "select * from warga ";
$query_all_data = mysqli_query($db, $sql_all_data);
$jumlah_data = mysqli_num_rows($query_all_data);
$total_halaman = ceil($jumlah_data / $batas);

$sql = "select * from warga ";
if (isset($_GET['keyword'])) {
  $keyword = $_GET['keyword'];

  $sql .= "where nik_warga like '%$keyword%' ";
  $sql .= "or nama_warga like '%$keyword%' ";

  if (strtoupper($keyword) == "LAKI" || strtoupper($keyword) == "LAKI-LAKI" || strtoupper($keyword) == "LAKI - LAKI") {
    $keyword_kelamin = "L";
  } elseif (strtoupper($keyword) == "PEREMPUAN") {
    $keyword_kelamin = "P";
  } else {
    $keyword_kelamin = null;
  }

  if ($keyword_kelamin) {
    $sql .= "or jenis_kelamin_warga = '$keyword_kelamin' ";
  }

  if ((int) $keyword) {
    if ($keyword > 100) {
      $sql .= "or YEAR(tanggal_lahir_warga) = $keyword ";
    } else {
      $current_year = date('Y');
      $keyword_usia = $current_year - $keyword;
      $sql .= "or YEAR(tanggal_lahir_warga) = $keyword_usia ";
    }
  }

  $sql .= "or pendidikan_terakhir_warga like '%$keyword%' ";
  $sql .= "or pekerjaan_warga like '%$keyword%' ";
  $sql .= "or status_warga like '%$keyword%' ";
} else {
  $keyword = null;
}

$sql .= "limit $halaman_awal, $batas";

echo $sql;

$query = mysqli_query($db, $sql);
$jumlah_data_filtered = mysqli_num_rows($query);
?>
<div class="row" style="margin-bottom: 30px;">
  <form action="./index.php" method="get">
    <div class="col-lg-6">
      <div class="input-group">
        <input type="text" name="keyword" class="form-control" placeholder="Masukan kata kunci..." value="<?= $keyword ?? null; ?>">
        <span class="input-group-btn">
          <button class="btn btn-warning" type="submit">Pencarian</button>
          <a class="btn btn-default" href="./">Clear</a>
        </span>
      </div>
    </div>
  </form>
</div>

<div class="table-responsive">
  <table class="table table-striped table-condensed table-hover" style="min-height: 500px;">
    <thead>
      <tr>
        <th>#</th>
        <th>NIK</th>
        <th>Nama Warga</th>
        <th>L/P</th>
        <th>Usia</th>
        <th>Pendidikan</th>
        <th>Pekerjaan</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = ($halaman * $batas) - $batas + 1;
      while ($row = mysqli_fetch_assoc($query)) {
      ?>
        <tr>
          <td>
            <?= $no++; ?>
          </td>
          <td>
            <?= $row['nik_warga']; ?>
          </td>
          <td>
            <?= $row['nama_warga']; ?>
          </td>
          <td>
            <?= $row['jenis_kelamin_warga'] == "L" ? "Laki-Laki" : "Perempuan"; ?>
          </td>
          <td>
            <?php
            $tgl_lahir = new DateTime($row['tanggal_lahir_warga']);
            $now = new DateTime();
            $interval = $now->diff($tgl_lahir);
            echo $interval->y . " Thn";
            ?>
          </td>
          <td>
            <?= $row['pendidikan_terakhir_warga']; ?>
          </td>
          <td>
            <?= $row['pekerjaan_warga']; ?>
          </td>
          <td>
            <?= $row['status_warga']; ?>
          </td>
          <td>
            <div class="btn-group pull-right">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cogs"></i> <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li>
                  <a href="show.php?id_warga=<?php echo $row['id_warga'] ?>"><i class="glyphicon glyphicon-sunglasses"></i> Detail</a>
                </li>
                <li>
                  <a href="cetak-show.php?id_warga=<?php echo $row['id_warga'] ?>" target="_blank"><i class="glyphicon glyphicon-print"></i> Cetak</a>
                </li>
                <?php if ($_SESSION['user']['status_user'] != 'RW') : ?>
                  <li role="separator" class="divider"></li>
                  <li>
                    <a href="edit.php?id_warga=<?php echo $row['id_warga'] ?>"><i class="glyphicon glyphicon-edit"></i> Ubah</a>
                  </li>
                  <li>
                    <a href="../mutasi/create.php?id_warga=<?php echo $row['id_warga'] ?>"><i class="glyphicon glyphicon-export"></i> Mutasi</a>
                  </li>
                <?php endif; ?>
              </ul>
            </div>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<ul class="pagination">
  <li class=" page-item <?= ($halaman == 1) ? "disabled" : null ?>">
    <a class="page-link" <?= ($halaman > 1) ? "href='?halaman=$prev&keyword=$keyword'" : null ?>>Previous</a>
  </li>
  <li class="page-item <?= ($jumlah_data_filtered < $batas) ? "disabled" : null ?>">
    <a class="page-link" <?= ($jumlah_data_filtered < $batas) ? null : "href='?halaman=$next&keyword=$keyword'" ?>>Next</a>
  </li>
</ul>

<div class="well">
  <dl class="dl-horizontal">
    <dt>Total Warga</dt>
    <dd><?php echo $jumlah_warga['total'] ?> orang</dd>

    <dt>Jumlah Laki-laki</dt>
    <dd><?php echo $jumlah_warga_l['total'] ?> orang</dd>

    <dt>Jumlah Perempuan</dt>
    <dd><?php echo $jumlah_warga_p['total'] ?> orang</dd>

    <dt>Warga < 17 tahun</dt>
    <dd><?php echo $jumlah_warga_kd_17['total'] ?> orang</dd>

    <dt>Warga >= 17 tahun</dt>
    <dd><?php echo $jumlah_warga_ld_17['total'] ?> orang</dd>
  </dl>
</div>

<?php include('../_partials/bottom.php') ?>