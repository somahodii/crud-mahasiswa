<?php
require 'db.php';
require('vendor/autoload.php'); // pastikan sudah install dompdf

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$html = '<h3>Data Mahasiswa</h3>
<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <tr>
        <th>NIM</th><th>Nama</th><th>Alamat</th><th>Fakultas</th>
    </tr>';

$result = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
while ($data = mysqli_fetch_assoc($result)) {
    $html .= "<tr>
        <td>{$data['nim']}</td>
        <td>{$data['nama']}</td>
        <td>{$data['alamat']}</td>
        <td>{$data['fakultas']}</td>
    </tr>";
}
$html .= '</table>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("data_mahasiswa.pdf", array("Attachment" => 0));
?>
