<?php
require 'db.php';
$error = $sukses = "";
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role     = $_POST['role'];

    if ($username && $password && $role) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $q = mysqli_query($koneksi, "INSERT INTO users (username, password, role) VALUES ('$username', '$hash', '$role')");
        $sukses = $q ? "Berhasil daftar. Silakan login." : "Gagal daftar.";
    } else {
        $error = "Harap isi semua field.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 450px;">
    <h3 class="text-center">Registrasi</h3>
    <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <?php if ($sukses) echo "<div class='alert alert-success'>$sukses</div>"; ?>
    <form method="POST">
        <div class="mb-3"><input class="form-control" name="username" placeholder="Username" required></div>
        <div class="mb-3"><input type="password" class="form-control" name="password" placeholder="Password" required></div>
        <div class="mb-3">
            <select class="form-control" name="role" required>
                <option value="">Pilih Role</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>
        <button class="btn btn-success w-100" name="register">Daftar</button>
    </form>
    <div class="text-center mt-3"><a href="login.php">Sudah punya akun? Login</a></div>
</div>
</body>
</html>
