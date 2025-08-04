<?php
include(__DIR__ . "/config/koneksi.php");

// Ambil data berdasarkan ID
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id=$id");
$data = mysqli_fetch_assoc($query);

// Simpan perubahan
if (isset($_POST['submit'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $nim = htmlspecialchars($_POST['nim']);
    $jurusan = htmlspecialchars($_POST['jurusan']);
    $angkatan = htmlspecialchars($_POST['angkatan']);

    $update = mysqli_query($koneksi, "UPDATE mahasiswa SET 
        nama='$nama', 
        nim='$nim', 
        jurusan='$jurusan', 
        angkatan='$angkatan' 
        WHERE id=$id");

    if ($update) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4>Edit Data Mahasiswa</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label>Nama:</label>
                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label>NIM:</label>
                    <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($data['nim'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label>Jurusan:</label>
                    <input type="text" name="jurusan" class="form-control" value="<?= htmlspecialchars($data['jurusan'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label>Angkatan:</label>
                    <input type="text" name="angkatan" class="form-control" value="<?= htmlspecialchars($data['angkatan'] ?? '') ?>" required>
                </div>
                <button type="submit" name="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
