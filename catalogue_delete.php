<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include "db.php";

$id = $_GET['id'] ?? 0;
$confirm = $_GET['confirm'] ?? 'no';

if ($id == 0) { die("ID katalog tidak ditemukan."); }

if ($confirm === 'yes') {
    $sql = "DELETE FROM tb_catalogues WHERE catalogue_id='$id'";
    if (!mysqli_query($conn, $sql)) {
        die("SQL Error: " . mysqli_error($conn));
    }
    header("Location: admin_catalogue.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hapus Katalog</title>
  <link rel="stylesheet" href="assets/css/catalogue.css">
</head>
<body>
  <div class="delete-box fade">
    <h2>Konfirmasi Hapus</h2>
    <p>Apakah Anda yakin ingin menghapus katalog ini?</p>
    <div class="button-group">
      <a href="catalogue_delete.php?id=<?php echo $id; ?>&confirm=yes" class="btn submit">Ya, Hapus</a>
      <a href="admin_catalogue.php" class="btn back">Batal</a>
    </div>
  </div>

  <script>
    window.addEventListener("DOMContentLoaded", () => {
      document.querySelector(".fade").classList.add("show");
    });
  </script>
</body>
</html>
