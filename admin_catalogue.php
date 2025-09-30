<?php
// Debug aktif (matikan di produksi)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Jalankan session hanya jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include "db.php"; 

// Ambil data katalog
$sql = "SELECT * FROM tb_catalogues ORDER BY catalogue_id DESC";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}

// Data admin
$adminName  = $_SESSION['name'];
$adminPhoto = "assets/images/logo1.png"; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Katalog - Admin JEWEPE</title>
  <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
  <div class="admin-container fade">

    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="profile">
        <img src="<?php echo $adminPhoto; ?>" alt="Foto Admin">
        <h3><?php echo htmlspecialchars($adminName); ?></h3>
      </div>
      <nav class="menu">
        <a href="admin.php">🏠 Dashboard</a>
        <a href="admin_catalogue.php" class="active">📦 Manajemen Katalog</a>
        <a href="admin_order.php">📝 Manajemen Pesanan</a>
        <a href="admin_report.php">📊 Laporan Pesanan</a>
        <a href="admin_settings.php">⚙️ Manajemen Profil Web</a>
      </nav>
      <div class="logout">
        <a href="logout.php" id="logoutBtn">🚪 Logout</a>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="content">
      <h1>Manajemen Katalog</h1>

      <div class="action-bar">
        <a href="catalogue_add.php" class="btn add">+ Tambah Data</a>
      </div>

      <table class="data-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama Paket</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row['catalogue_id']; ?></td>
            <td><?php echo htmlspecialchars($row['package_name']); ?></td>
            <td style="max-width:300px; white-space:pre-wrap;">
              <?php echo htmlspecialchars($row['description']); ?>
            </td>
            <td>Rp <?php echo number_format($row['price'],0,",","."); ?></td>
            <td>
              <img src="assets/images/<?php echo htmlspecialchars($row['image']); ?>" 
                   width="80" style="border-radius:6px;">
            </td>
            <td>
              <div class="btn-group">
                <a href="catalogue_edit.php?id=<?php echo $row['catalogue_id']; ?>" class="btn small edit">Edit</a>
                <a href="catalogue_delete.php?id=<?php echo $row['catalogue_id']; ?>" class="btn small delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
              </div>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>
  </div>

  <script src="assets/js/admin.js"></script>
</body>
</html>
