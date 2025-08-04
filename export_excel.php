<?php
require 'db.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=mahasiswa.xls");

$result = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
echo "<table border='1'>
<tr>
    <th>NIM</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Fakultas</th>
</tr>";

while($data = mysqli_fetch_assoc($result)){
    echo "<tr>
        <td>{$data['nim']}</td>
        <td>{$data['nama']}</td>
        <td>{$data['alamat']}</td>
        <td>{$data['fakultas']}</td>
    </tr>";
}
echo "</table>";
?>
