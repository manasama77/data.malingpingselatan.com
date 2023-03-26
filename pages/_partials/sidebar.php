<?php
$uri_path     = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);

function is_active($page)
{
  $uri_path     = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $uri_segments = explode('/', $uri_path);

  if ($uri_segments[2] == $page) {
    echo 'active';
  } else {
    echo '';
  }
}
$uri_path     = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
echo '<pre>' . print_r($uri_segments[3], 1) . '</pre>';
exit;
function contain_peristiwa($type)
{
  $uri_path     = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $uri_segments = explode('/', $uri_path);

  $arr_explode = explode('-', $uri_segments[3]);
  if ($arr_explode[0] == "peristiwa") {
    return $type;
  }
  return null;
}
?>
<div class="nav navbar-sidebar">

  <ul class="nav nav-sidebar">
    <li class="<?php is_active('dasbor'); ?>">
      <a href="../dasbor"><i class="fa fa-home"></i> Dashbord</a>
    </li>
  </ul>
  <ul class="nav nav-sidebar">
    <li class="<?php is_active('warga'); ?>">
      <a href="../warga"><i class="fa fa-user"></i> Data Penduduk</a>
    </li>
    <li class="<?php is_active('kartu-keluarga'); ?>">
      <a href="../kartu-keluarga"><i class="fa fa-group"></i> Data Kartu Keluarga</a>
    </li>
  </ul>

  <div class="dropdown">
    <ul class="nav nav-sidebar">
      <li class="<?php is_active('mutasi'); ?>">
        <a href="#list" data-toggle="collapse"><i class="fa fa-exchange fa-fw"></i> Data Mutasi</a>
        <!--<a href="../mutasi"><i class="glyphicon glyphicon-export"></i> Data Mutasi</a>-->
      </li>
      <div id="list" class="collapse">
        <div class="list-group">
          <a href="../mutasi-datang" class="list-group-item"><i class="fa fa-long-arrow-right fa-fw"></i> Pindah Datang</a>
          <a href="../mutasi-keluar" class="list-group-item"><i class="fa fa-long-arrow-left fa-fw"></i> Pindah Keluar</a>
        </div>
      </div>
    </ul>
  </div>

  <div class="dropdown">
    <ul class="nav nav-sidebar">
      <li class="<?= contain_peristiwa("active"); ?>">
        <a href="#peristiwa" data-toggle="collapse"><i class="fa fa-newspaper-o fa-fw"></i> Peristiwa</a>
        <!--<a href="../mutasi"><i class="glyphicon glyphicon-export"></i> Data Mutasi</a>-->
      </li>
      <div id="peristiwa" class="collapse <?= contain_peristiwa("in"); ?>">
        <div class="list-group">
          <a href="../peristiwa-kelahiran" class="list-group-item <?php is_active('peristiwa-kelahiran'); ?>">Kelahiran</a>
          <a href="../peristiwa-kematian" class="list-group-item <?php is_active('peristiwa-kematian'); ?>">Kematian</a>
          <a href="../peristiwa-kerja-luar_negeri-atau-kota" class="list-group-item <?php is_active('peristiwa-kerja-luar_negeri-atau-kota'); ?>">Bekerja Luar Negeri / Kota</a>
          <a href="../peristiwa-belum-bekerja" class="list-group-item <?php is_active('peristiwa-belum-bekerja'); ?>">Belum Bekerja</a>
          <a href="../peristiwa-keterangan-usaha" class="list-group-item <?php is_active('peristiwa-keterangan-usaha'); ?>">Keterangan Usaha</a>
          <a href="../peristiwa-tidak-mampu-kesehatan-puskesmas" class="list-group-item <?php is_active('peristiwa-tidak-mampu-kesehatan-puskesmas'); ?>">Keterangan Tidak Mampu Untuk Kesehatan (PUSKESMAS)</a>
          <a href="../peristiwa-tidak-mampu-kesehatan-rsud" class="list-group-item <?php is_active('peristiwa-tidak-mampu-kesehatan-rsud'); ?>">Keterangan Tidak Mampu Untuk Kesehatan (RSUD)</a>
          <a href="../peristiwa-tidak-mampu-sekolah" class="list-group-item <?php is_active('peristiwa-tidak-mampu-sekolah'); ?>">Keterangan Tidak Mampu Untuk Sekolah</a>
          <a href="../peristiwa-tidak-mampu-umum" class="list-group-item <?php is_active('peristiwa-tidak-mampu-umum'); ?>">Keterangan Tidak Mampu Umum</a>
          <a href="../peristiwa-domisili" class="list-group-item <?php is_active('peristiwa-domisili'); ?>">Domisili</a>
          <a href="../peristiwa-surat-pengantar" class="list-group-item <?php is_active('peristiwa-surat-pengantar'); ?>">Surat Pengantar</a>
          <a href="../peristiwa-belum-mempunyai-rumah" class="list-group-item <?php is_active('peristiwa-belum-mempunyai-rumah'); ?>">Belum Mempunyai Rumah</a>
          <a href="../peristiwa-cerai" class="list-group-item <?php is_active('peristiwa-cerai'); ?>">SK Cerai</a>
          <a href="../peristiwa-permohonan-perubahan-data-penduduk" class="list-group-item <?php is_active('peristiwa-permohonan-perubahan-data-penduduk'); ?>">Permohonan Perubahan Data Penduduk</a>
          <a href="../peristiwa-skck" class="list-group-item <?php is_active('peristiwa-skck'); ?>">Surat Pengantar Catatan Kepolisian</a>
          <a href="../peristiwa-sk_dokumen_kependudukan_dalam_proses_pembuatan" class="list-group-item <?php is_active('peristiwa-sk_dokumen_kependudukan_dalam_proses_pembuatan'); ?>">Surat Keterangan Dokumen Kependudukan
            Dalam Proses Pembuatan</a>
          <a href="../peristiwa-sk_domisili_lembaga" class="list-group-item <?php is_active('peristiwa-sk_domisili_lembaga'); ?>">Surat Keterangan Domisili Perusahaan, Yayasan, Sekolah, Organisasi</a>
          <a href="../peristiwa-sk_domisili_usaha" class="list-group-item <?php is_active('peristiwa-sk_domisili_usaha'); ?>">Surat Keterangan Domisili Usaha</a>
          <a href="../peristiwa-sk_hilang" class="list-group-item <?php is_active('peristiwa-sk_hilang'); ?>">Surat Keterangan Hilang</a>
          <a href="../peristiwa-sk_hubungan_keluarga" class="list-group-item <?php is_active('peristiwa-sk_hubungan_keluarga'); ?>">Surat Keterangan Hubungan Keluarga</a>
          <a href="../peristiwa-sk_izin_keluarga" class="list-group-item <?php is_active('peristiwa-sk_izin_keluarga'); ?>">Surat Keterangan Izin Keluarga</a>
          <a href="../peristiwa-sk_pemakaman" class="list-group-item <?php is_active('peristiwa-sk_pemakaman'); ?>">Surat Keterangan Pemakaman</a>
          <a href="../peristiwa-belum-menikah" class="list-group-item <?php is_active('peristiwa-belum-menikah'); ?>">Belum Menikah</a>
          <a href="../peristiwa-sk_telah_menikah" class="list-group-item <?php is_active('peristiwa-sk_telah_menikah'); ?>">Surat Keterangan Telah Menikah</a>
          <a href="../peristiwa-sk_penghasilan" class="list-group-item <?php is_active('peristiwa-sk_penghasilan'); ?>">Surat Keterangan Penghasilan</a>
          <a href="../peristiwa-sk_tidak_memiliki_hubungan_keluarga" class="list-group-item <?php is_active('peristiwa-sk_tidak_memiliki_hubungan_keluarga'); ?>">Surat Keterangan Tidak Memiliki Hubungan Keluarga</a>
          <a href="../peristiwa-sk_penghasilan_orangtua" class="list-group-item <?php is_active('peristiwa-sk_penghasilan_orangtua'); ?>">Surat Keterangan Penghasilan Orang Tua</a>
          <a href="../peristiwa-surat_kuasa" class="list-group-item <?php is_active('peristiwa-surat_kuasa'); ?>">Surat Kuasa</a>
          <a href="../peristiwa-surat_pengantar_izin_keramaian" class="list-group-item <?php is_active('peristiwa-surat_pengantar_izin_keramaian'); ?>">Surat Pengantar Izin Keramaian</a>
          <a href="../peristiwa-surat_keterangan_izin_tebang" class="list-group-item <?php is_active('peristiwa-surat_keterangan_izin_tebang'); ?>">Surat Keterangan Izin Tebang</a>
          <a href="../peristiwa_sk_datang_wni" class="list-group-item <?php is_active('peristiwa_sk_datang_wni'); ?>">Surat Keterangan Datang WNI</a>
          <a href="../peristiwa_sk_pindah_wni" class="list-group-item <?php is_active('peristiwa_sk_pindah_wni'); ?>">Surat Keterangan Pindah WNI</a>
          <a href="../peristiwa_sk_identitas_sama" class="list-group-item <?php is_active('peristiwa_sk_identitas_sama'); ?>">Surat Pernyataan Identitas Sama</a>
        </div>
      </div>

    </ul>
  </div>

  <!--
<ul class="nav nav-sidebar">
  <li class="<?php is_active('galeri'); ?>">
    <a href="../galeri"><i class="glyphicon glyphicon-picture"></i> Galeri</a>
  </li>
</ul>
-->

  <ul class="nav nav-sidebar">
    <li class="<?php is_active('laporan'); ?>">
      <a href="../laporan"><i class="fa fa-file"></i> Laporan</a>
    </li>
  </ul>

  <?php if ($_SESSION['user']['status_user'] != 'Kasi_Pemerintahan') : ?>
    <ul class="nav nav-sidebar">
      <li class="<?php is_active('user'); ?>">
        <a href="../user"><i class="fa fa-user-secret"></i> User</a>
      </li>
    </ul>
  <?php endif; ?>

</div>