<?php
//error_reporting(E_ALL); ini_set('display_errors', 1);
//mysqli_report(MYSQLI_REPORT_ERROR);

$host = "localhost";
$user = "u2774448_malingpingselatan";
$pass = "malingpingselatan";
$database = "u2774448_malingpingselatan";

$db = mysqli_connect($host, $user, $pass, $database) or die("gagal koneksi ke database");
