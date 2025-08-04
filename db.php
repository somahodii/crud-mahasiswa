<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_crud";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Gagal koneksi: " . mysqli_connect_error());
}

session_start();
?>
