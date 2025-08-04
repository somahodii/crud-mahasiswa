<?php
// Koneksi ke database
include("config/koneksi.php");

// Cek apakah parameter ID ada di URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Hapus data berdasarkan ID
    $query = "DELETE FROM mahasiswa WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data berhasil dihapus.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='index.php';</script>";
}
?>
