<?php
if ($_SESSION['user']['role'] !== 'admin') {
    echo "Akses ditolak! Hanya admin yang boleh mengakses halaman ini.";
    exit();
}
?>
