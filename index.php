<?php
session_start();
include(__DIR__ . "/config/koneksi.php");

// Redirect jika belum login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$isAdmin = isset($_SESSION['level']) && $_SESSION['level'] === 'admin';

// Pencarian
$keyword = isset($_GET['cari']) ? $_GET['cari'] : '';
$sql = "SELECT * FROM mahasiswa WHERE 
        nim LIKE '%$keyword%' OR 
        nama LIKE '%$keyword%' OR 
        alamat LIKE '%$keyword%' OR 
        jurusan LIKE '%$keyword%'";
$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body.dark-mode {
            background-color: #121212;
            color: #fff;
        }
        .dark-mode .table {
            color: #fff;
        }
    </style>
</head>
<body class="p-4">
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><i class="fas fa-graduation-cap"></i> Dashboard Mahasiswa</h2>
        <div>
            <span class="me-2">Halo, <?= $_SESSION['username'] ?> (<?= $_SESSION['level'] ?>)</span>
            <a href="logout.php" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
            <button class="btn btn-sm btn-dark" onclick="toggleDarkMode()"><i class="fas fa-moon"></i></button>
        </div>
    </div>

    <!-- Form tambah -->
    <form method="post" class="row g-2 mb-4">
        <div class="col-md-2">
            <input type="text" name="nim" class="form-control" placeholder="NIM" required>
        </div>
        <div class="col-md-2">
            <input type="text" name="nama" class="form-control" placeholder="Nama" required>
        </div>
        <div class="col-md-2">
            <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
        </div>
        <div class="col-md-2">
            <input type="text" name="jurusan" class="form-control" placeholder="Jurusan" required>
        </div>
        <div class="col-md-2">
            <button type="submit" name="simpan" class="btn btn-success w-100">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </form>

    <!-- Proses tambah -->
    <?php
    if (isset($_POST['simpan'])) {
        $nim     = $_POST['nim'];
        $nama    = $_POST['nama'];
        $alamat  = $_POST['alamat'];
        $jurusan = $_POST['jurusan'];

        $query = "INSERT INTO mahasiswa (nim, nama, alamat, jurusan) VALUES ('$nim', '$nama', '$alamat', '$jurusan')";
        if (mysqli_query($koneksi, $query)) {
            echo "<div class='alert alert-success'>Data berhasil disimpan.</div>";
            echo "<meta http-equiv='refresh' content='1'>";
        } else {
            echo "<div class='alert alert-danger'>Gagal menyimpan data.</div>";
        }
    }
    ?>

    <!-- Pencarian -->
    <form method="get" class="input-group mb-3">
        <input type="text" name="cari" class="form-control" placeholder="Cari data mahasiswa..." value="<?= $keyword ?>">
        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
    </form>

    <!-- Ekspor -->
    <div class="mb-2">
        <a href="export_pdf.php" class="btn btn-sm btn-outline-danger"><i class="fas fa-file-pdf"></i> Cetak PDF</a>
        <a href="export_excel.php" class="btn btn-sm btn-outline-success"><i class="fas fa-file-excel"></i> Ekspor Excel</a>
    </div>

    <!-- Tabel -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jurusan</th>
                    <?php if ($isAdmin): ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nim'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td><?= $row['jurusan'] ?></td>
                        <?php if ($isAdmin): ?>
                            <td>
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')"><i class="fas fa-trash"></i></a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
}
</script>
</body>
</html>
