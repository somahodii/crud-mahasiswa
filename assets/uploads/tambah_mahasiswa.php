<?php
session_start();
include(__DIR__ . "/config/koneksi.php");

if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $gambar = '';

    if ($_FILES['foto']['name']) {
        $uploadDir = "uploads/";
        $uploadFile = $uploadDir . basename($_FILES["foto"]["name"]);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $uploadFile);
        $gambar = $_FILES['foto']['name'];
    }

    $sql = "INSERT INTO mahasiswa (nama, nim, jurusan, foto) VALUES ('$nama', '$nim', '$jurusan', '$gambar')";
    mysqli_query($koneksi, $sql);
    header("Location: data_mahasiswa.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Tambah Data Mahasiswa</h3>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Angkatan:</label>
            <input type="text" name="angkatan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>NIM</label>
            <input type="text" name="nim" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jurusan</label>
            <input type="text" name="jurusan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Foto/Gambar</label>
            <input type="file" name="foto" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
</body>
</html>
