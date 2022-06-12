<?php
function unset_session_form()
{
    unset($_SESSION['nomor_keluarga']);
    unset($_SESSION['id_keluarga']);
    unset($_SESSION['jenis_kepindahan']);
    unset($_SESSION['nik_warga']);
    unset($_SESSION['nama_warga']);
    unset($_SESSION['tempat_lahir_warga']);
    unset($_SESSION['tanggal_lahir_warga']);
    unset($_SESSION['jenis_kelamin_warga']);
    unset($_SESSION['agama_warga']);
    unset($_SESSION['pendidikan_terakhir_warga']);
    unset($_SESSION['pekerjaan_warga']);
    unset($_SESSION['alamat_tujuan']);
    unset($_SESSION['rt_warga']);
    unset($_SESSION['rw_warga']);
    unset($_SESSION['kelurahan']);
    unset($_SESSION['kecamatan']);
    unset($_SESSION['kokab']);
    unset($_SESSION['provinsi']);
    unset($_SESSION['negara']);
    unset($_SESSION['alamat_asal']);
    unset($_SESSION['tanggal_pindah']);
    unset($_SESSION['alasan_pindah']);
}

function cek_session()
{
    $_SESSION['nomor_keluarga']            = ($_SESSION['nomor_keluarga']) ?? null;
    $_SESSION['id_keluarga']               = ($_SESSION['id_keluarga']) ?? null;
    $_SESSION['jenis_kepindahan']          = ($_SESSION['jenis_kepindahan']) ?? null;
    $_SESSION['nik_warga']                 = ($_SESSION['nik_warga']) ?? null;
    $_SESSION['nama_warga']                = ($_SESSION['nama_warga']) ?? null;
    $_SESSION['tempat_lahir_warga']        = ($_SESSION['tempat_lahir_warga']) ?? null;
    $_SESSION['tanggal_lahir_warga']       = ($_SESSION['tanggal_lahir_warga']) ?? null;
    $_SESSION['jenis_kelamin_warga']       = ($_SESSION['jenis_kelamin_warga']) ?? null;
    $_SESSION['agama_warga']               = ($_SESSION['agama_warga']) ?? null;
    $_SESSION['pendidikan_terakhir_warga'] = ($_SESSION['pendidikan_terakhir_warga']) ?? null;
    $_SESSION['pekerjaan_warga']           = ($_SESSION['pekerjaan_warga']) ?? null;
    $_SESSION['alamat_tujuan']             = ($_SESSION['alamat_tujuan']) ?? null;
    $_SESSION['rt_warga']                  = ($_SESSION['rt_warga']) ?? null;
    $_SESSION['rw_warga']                  = ($_SESSION['rw_warga']) ?? null;
    $_SESSION['kelurahan']                 = ($_SESSION['kelurahan']) ?? null;
    $_SESSION['kecamatan']                 = ($_SESSION['kecamatan']) ?? null;
    $_SESSION['kokab']                     = ($_SESSION['kokab']) ?? null;
    $_SESSION['provinsi']                  = ($_SESSION['provinsi']) ?? null;
    $_SESSION['negara']                    = ($_SESSION['negara']) ?? null;
    $_SESSION['alamat_asal']               = ($_SESSION['alamat_asal']) ?? null;
    $_SESSION['tanggal_pindah']            = ($_SESSION['tanggal_pindah']) ?? null;
    $_SESSION['alasan_pindah']             = ($_SESSION['alasan_pindah']) ?? null;
}

function set_session_from_post()
{
    $_SESSION['nomor_keluarga']            = ($_POST['nomor_keluarga']) ?? null;
    $_SESSION['id_keluarga']               = ($_POST['id_keluarga']) ?? null;
    $_SESSION['jenis_kepindahan']          = ($_POST['jenis_kepindahan']) ?? null;
    $_SESSION['nik_warga']                 = ($_POST['nik_warga']) ?? null;
    $_SESSION['nama_warga']                = ($_POST['nama_warga']) ?? null;
    $_SESSION['tempat_lahir_warga']        = ($_POST['tempat_lahir_warga']) ?? null;
    $_SESSION['tanggal_lahir_warga']       = ($_POST['tanggal_lahir_warga']) ?? null;
    $_SESSION['jenis_kelamin_warga']       = ($_POST['jk']) ?? null;
    $_SESSION['agama_warga']               = ($_POST['agama_warga']) ?? null;
    $_SESSION['pendidikan_terakhir_warga'] = ($_POST['pendidikan_terakhir_warga']) ?? null;
    $_SESSION['pekerjaan_warga']           = ($_POST['pekerjaan_warga']) ?? null;
    $_SESSION['alamat_tujuan']             = ($_POST['alamat_tujuan']) ?? null;
    $_SESSION['rt_warga']                  = ($_POST['rt_warga']) ?? null;
    $_SESSION['rw_warga']                  = ($_POST['rw_warga']) ?? null;
    $_SESSION['kelurahan']                 = ($_POST['kelurahan']) ?? null;
    $_SESSION['kecamatan']                 = ($_POST['kecamatan']) ?? null;
    $_SESSION['kokab']                     = ($_POST['kokab']) ?? null;
    $_SESSION['provinsi']                  = ($_POST['provinsi']) ?? null;
    $_SESSION['negara']                    = ($_POST['negara']) ?? null;
    $_SESSION['alamat_asal']               = ($_POST['alamat_asal']) ?? null;
    $_SESSION['tanggal_pindah']            = ($_POST['tanggal_pindah']) ?? null;
    $_SESSION['alasan_pindah']             = ($_POST['alasan_pindah']) ?? null;
}
