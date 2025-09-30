<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include "db.php";

// ambil data pesanan join katalog
$sql = "SELECT o.*, c.package_name 
        FROM tb_order o
        JOIN tb_catalogues c ON o.catalogue_id = c.catalogue_id
        ORDER BY o.order_id DESC";
$result = mysqli_query($conn, $sql);

// data admin dari session
$adminName  = $_SESSION['name'];
$adminPhoto = "assets/images/logo1.png";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Pesanan - Admin JEWEPE</title>
  <link rel="stylesheet" href="assets/css/admin.css">
  <style>
    /* tambahan kecil untuk status */
    .status-requested { color: #ff9800; font-weight: bold; }
    .status-approved  { color: #4caf50; font-weight: bold; }
    .status-rejected  { color: #f44336; font-weight: bold; }
  </style>
</head>
<body>
  <div class="admin-container fade">

    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="profile">
        <img src="<?php echo $adminPhoto; ?>" alt="Foto Admin">
        <h3><?php echo $adminName; ?></h3>
      </div>
      <nav class="menu">
        <a href="admin.php">🏠 Dashboard</a>
        <a href="admin_catalogue.php">📦 Manajemen Katalog</a>
        <a href="admin_order.php" class="active">📝 Manajemen Pesanan</a>
        <a href="admin_report.php">📊 Laporan Pesanan</a>
        <a href="admin_settings.php">⚙️ Manajemen Profil Web</a>
      </nav>
      <div class="logout">
        <a href="logout.php" id="logoutBtn">🚪 Logout</a>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="content fade">
      <h1>Manajemen Pesanan</h1>

      <table class="data-table fade">
        <thead>
          <tr>
            <th>ID</th>
            <th>Paket</th>
            <th>Nama Pemesan</th>
            <th>Email</th>
            <th>No. Telepon</th>
            <th>Tanggal Pernikahan</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['package_name']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone_number']; ?></td>
            <td><?php echo $row['wedding_date']; ?></td>
            <td>
              <span class="status-<?php echo $row['status']; ?>">
                <?php echo ucfirst($row['status']); ?>
              </span>
            </td>
            <td>
                <form method="post" action="order_update.php">
                    <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                    <select name="status" onchange="this.form.submit()">
                        <option value="requested" <?php if($row['status']=='requested') echo 'selected'; ?>>Requested</option>
                        <option value="approved" <?php if($row['status']=='approved') echo 'selected'; ?>>Approved</option>
                        <option value="rejected" <?php if($row['status']=='rejected') echo 'selected'; ?>>Rejected</option>
                    </select>
                </form>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>
  </div>

  <script src="assets/js/admin.js"></script>
  <script>
    // tambahkan animasi fade
    window.addEventListener("DOMContentLoaded", function() {
      document.querySelectorAll(".fade").forEach(el => el.classList.add("show"));
    });
  </script>
</body>
</html>
