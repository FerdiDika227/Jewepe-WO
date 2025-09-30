<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';
require 'vendor/autoload.php'; // Jika pakai Composer
// Jika download manual: require 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Ambil data pesanan
$query = "
    SELECT o.order_id, o.name AS nama_customer, o.email, o.phone_number, 
           o.wedding_date, o.status, c.package_name AS nama_catalogue, 
           o.created_at AS tanggal
    FROM tb_order o
    LEFT JOIN tb_catalogues c ON o.catalogue_id = c.catalogue_id
    ORDER BY o.created_at DESC
";
$result = mysqli_query($conn, $query);

// Buat konten HTML untuk PDF
$html = '
<h2 style="text-align:center;">Laporan Pesanan JEWEPE</h2>
<table border="1" cellspacing="0" cellpadding="6" width="100%">
    <thead>
        <tr style="background:#f2f2f2;">
            <th>No</th>
            <th>Nama Customer</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Tanggal Wedding</th>
            <th>Paket</th>
            <th>Tanggal Pesan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>';
$no = 1;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $statusColor = "#000";
        if ($row['status'] === "approved") $statusColor = "green";
        elseif ($row['status'] === "rejected") $statusColor = "red";
        elseif ($row['status'] === "requested") $statusColor = "orange";

        $html .= "
            <tr>
                <td>{$no}</td>
                <td>{$row['nama_customer']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone_number']}</td>
                <td>{$row['wedding_date']}</td>
                <td>{$row['nama_catalogue']}</td>
                <td>{$row['tanggal']}</td>
                <td style='color:{$statusColor}; font-weight:bold;'>{$row['status']}</td>
            </tr>
        ";
        $no++;
    }
} else {
    $html .= "<tr><td colspan='8' style='text-align:center;'>Belum ada data pesanan</td></tr>";
}
$html .= '
    </tbody>
</table>
';

// Konfigurasi Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Load HTML ke Dompdf
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Output sebagai download
$dompdf->stream("laporan_pesanan.pdf", ["Attachment" => 1]);
exit;
