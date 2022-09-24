<?php
$uri_path     = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
function is_active($page)
{
  $uri_path     = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $uri_segments = explode('/', $uri_path);

  echo $uri_segments[3];

  if ($uri_segments[3] == $page) {
    echo 'active';
  } else {
    echo '';
  }
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
      <li class="<?php is_active('peristiwa'); ?>">
        <a href="#peristiwa" data-toggle="collapse"><i class="fa fa-newspaper-o fa-fw"></i> Peristiwa</a>
        <!--<a href="../mutasi"><i class="glyphicon glyphicon-export"></i> Data Mutasi</a>-->
      </li>
      <div id="peristiwa" class="collapse">
        <div class="list-group">
          <a href="../peristiwa-kelahiran" class="list-group-item">Kelahiran</a>
          <a href="../peristiwa-kematian" class="list-group-item">Kematian</a>
          <a href="../peristiwa-kerja-luar_negeri-atau-kota" class="list-group-item">Bekerja Luar Negeri / Kota</a>
          <a href="../peristiwa-belum-bekerja" class="list-group-item">Belum Bekerja</a>
          <a href="../peristiwa-keterangan-usaha" class="list-group-item">Keterangan Usaha</a>
          <a href="../peristiwa-tidak-mampu-kesehatan-puskesmas" class="list-group-item">Keterangan Tidak Mampu Untuk Kesehatan (PUSKESMAS)</a>
          <a href="../peristiwa-tidak-mampu-kesehatan-rsud" class="list-group-item">Keterangan Tidak Mampu Untuk Kesehatan (RSUD)</a>
          <a href="../peristiwa-tidak-mampu-sekolah" class="list-group-item">Keterangan Tidak Mampu Untuk Sekolah</a>
          <a href="../peristiwa-tidak-mampu-umum" class="list-group-item">Keterangan Tidak Mampu Umum</a>
          <a href="../peristiwa-domisili" class="list-group-item">Domisili</a>
          <a href="../peristiwa-surat-pengantar" class="list-group-item">Surat Pengantar</a>
          <a href="../peristiwa-belum-mempunyai-rumah" class="list-group-item">Belum Mempunyai Rumah</a>
          <a href="../peristiwa-cerai" class="list-group-item">SK Cerai</a>
          <a href="../peristiwa-permohonan-perubahan-data-penduduk" class="list-group-item">Permohonan Perubahan Data Penduduk</a>
          <a href="../peristiwa-skck" class="list-group-item">Surat Pengantar Catatan Kepolisian</a>
          <a href="../peristiwa-sk_dokumen_kependudukan_dalam_proses_pembuatan" class="list-group-item">Surat Keterangan Dokumen Kependudukan
            Dalam Proses Pembuatan</a>
          <a href="../peristiwa-sk_domisili_lembaga" class="list-group-item">Surat Keterangan Domisili Perusahaan, Yayasan, Sekolah, Organisasi</a>
          <a href="../peristiwa-sk_domisili_usaha" class="list-group-item">Surat Keterangan Domisili Usaha</a>
          <a href="../peristiwa-sk_hilang" class="list-group-item">Surat Keterangan Hilang</a>
          <a href="../peristiwa-sk_hubungan_keluarga" class="list-group-item">Surat Keterangan Hubungan Keluarga</a>
          <a href="../peristiwa-sk_izin_keluarga" class="list-group-item">Surat Keterangan Izin Keluarga</a>
          <a href="../peristiwa-sk_pemakaman" class="list-group-item">Surat Keterangan Pemakaman</a>
          <a href="../peristiwa-belum-menikah" class="list-group-item">Belum Menikah</a>
          <a href="../peristiwa-sk_telah_menikah" class="list-group-item">Surat Keterangan Telah Menikah</a>
          <a href="../peristiwa-sk_penghasilan" class="list-group-item">Surat Keterangan Penghasilan</a>
          <a href="../peristiwa-sk_tidak_memiliki_hubungan_keluarga" class="list-group-item">Surat Keterangan Tidak Memiliki Hubungan Keluarga</a>
          <a href="../peristiwa-sk_penghasilan_orangtua" class="list-group-item">Surat Keterangan Penghasilan Orang Tua</a>
          <a href="../peristiwa-surat_kuasa" class="list-group-item">Surat Kuasa</a>
          <a href="../peristiwa-surat_pengantar_izin_keramaian" class="list-group-item">Surat Pengantar Izin Keramaian</a>
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

  <?php if ($_SESSION['user']['status_user'] != 'Kasi_Pemerintahan') : ?>
    <ul class="nav nav-sidebar">
      <li class="<?php is_active('user'); ?>">
        <a href="../user"><i class="fa fa-user-secret"></i> User</a>
      </li>
    </ul>
  <?php endif; ?>

</div>