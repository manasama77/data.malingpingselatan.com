<?php
include('../../config/koneksi.php');

// ambil dari database
$sql   = "SELECT * FROM mutasi_keluar LEFT JOIN warga ON warga.id_warga = mutasi_keluar.id_warga";
$query = mysqli_query($db, $sql);
