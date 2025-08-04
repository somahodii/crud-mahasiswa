<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "db_crud"; // pastikan nama DB benar

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
