<?php
include(__DIR__ . "/config/koneksi.php");

// Sort (opsional)
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$query = "SELECT * FROM mahasiswa ORDER BY $sort ASC";
$data = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h2 class="mb-3">Data Mahasiswa</h2>
  <a href="tambah_mahasiswa.php" class="btn btn-success mb-3">+ Tambah Mahasiswa</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th><a href="?sort=id">No</a></th>
        <th><a href="?sort=nama">Nama</a></th>
        <th><a href="?sort=nim">NIM</a></th>
        <th><a href="?sort=jurusan">Jurusan</a></th>
        <th><a href="?sort=angkatan">Angkatan</a></th>
        <th>Foto</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) { ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['nim'] ?></td>
        <td><?= $row['jurusan'] ?></td>
        <td><?= $row['angkatan'] ?></td>
        <td>
          <?php if ($row['foto']): ?>
            <img src="uploads/<?= $row['foto'] ?>" width="60">
          <?php else: ?>
            -
          <?php endif; ?>
        </td>
        <td>
          <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>
