<?php
session_start();
include(__DIR__ . "/config/koneksi.php");

$error = '';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username == '' || $password == '') {
        $error = "Username dan password tidak boleh kosong!";
    } else {
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);

        if ($data && password_verify($password, $data['password'])) {
            $_SESSION['username'] = $data['username'];
            $_SESSION['level'] = $data['role']; // ✅ Disamakan dengan index.php
            header("Location: index.php");
            exit;
        } else {
            $error = "Login gagal! Username atau password salah.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Dark Mode Toggle -->
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-bs-theme', 'dark');
        }
    </script>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0 p-4 rounded-4">
                <h4 class="text-center mb-4"><i class="bi bi-person-circle"></i> Login Sistem</h4>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <form method="post">
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="username" id="username" class="form-control" required autofocus>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="login" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right"></i> Masuk
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="toggleTheme()">
                            <i class="bi bi-moon-stars-fill"></i> Toggle Dark Mode
                        </button>
                    </div>
                </form>

                <div class="mt-3 text-center">
                    Belum punya akun? <a href="register.php">Daftar di sini</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleTheme() {
    let current = document.documentElement.getAttribute("data-bs-theme");
    let newTheme = (current === "dark") ? "light" : "dark";
    document.documentElement.setAttribute("data-bs-theme", newTheme);
    localStorage.setItem("theme", newTheme);
}
</script>
</body>
</html>
