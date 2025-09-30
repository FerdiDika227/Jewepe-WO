<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include "db.php";

// Ambil data pesanan join dengan katalog
$sql = "
    SELECT 
        o.order_id,
        o.name,
        o.email,
        o.phone_number,
        o.wedding_date,
        o.status,
        o.created_at,
        c.package_name
    FROM tb_order o
    JOIN tb_catalogues c ON o.catalogue_id = c.catalogue_id
    ORDER BY o.created_at DESC
";
$resultOrders = mysqli_query($conn, $sql);

// Data admin (sementara dari session)
$adminName = $_SESSION['name'];
$adminPhoto = "assets/images/logo1.png";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Pesanan - JEWEPE</title>
  <link rel="stylesheet" href="assets/css/admin.css">
  <link rel="stylesheet" href="assets/css/report.css">
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
        <a href="admin_order.php">📝 Manajemen Pesanan</a>
        <a href="admin_report.php" class="active">📊 Laporan Pesanan</a>
        <a href="admin_settings.php">⚙️ Manajemen Profil Web</a>
      </nav>
      <div class="logout">
        <a href="#" id="logoutBtn">🚪 Logout</a>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="content fade">
      <h1>Laporan Pesanan</h1>

      <div class="export-btn">
        <a href="export_report.php" class="btn-export">📄 Export PDF</a>
      </div>

      <table class="report-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Pemesan</th>
            <th>Email</th>
            <th>Nomor Telepon</th>
            <th>Tanggal Pernikahan</th>
            <th>Paket</th>
            <th>Status</th>
            <th>Tanggal Pesan</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (mysqli_num_rows($resultOrders) > 0) {
              $no = 1;
              while ($row = mysqli_fetch_assoc($resultOrders)) {
                  echo "<tr>
                          <td>{$no}</td>
                          <td>{$row['name']}</td>
                          <td>{$row['email']}</td>
                          <td>{$row['phone_number']}</td>
                          <td>{$row['wedding_date']}</td>
                          <td>{$row['package_name']}</td>
                          <td><span class='status {$row['status']}'>{$row['status']}</span></td>
                          <td>{$row['created_at']}</td>
                        </tr>";
                  $no++;
              }
          } else {
              echo "<tr><td colspan='8' style='text-align:center;'>Belum ada pesanan.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </main>

  </div>

  <!-- Animasi Fade -->
  <script src="assets/js/admin.js"></script>

  <!-- Konfirmasi Logout -->
  <script>
  document.getElementById("logoutBtn").addEventListener("click", function(e) {
    e.preventDefault();
    const confirmBox = document.createElement("div");
    confirmBox.classList.add("confirm-box");
    confirmBox.innerHTML = `
      <div class="confirm-content">
        <p>Apakah Anda yakin ingin logout?</p>
        <button id="yesBtn">Ya</button>
        <button id="noBtn">Tidak</button>
      </div>
    `;
    document.body.appendChild(confirmBox);

    document.getElementById("yesBtn").addEventListener("click", () => {
      window.location.href = "logout.php";
    });
    document.getElementById("noBtn").addEventListener("click", () => {
      document.body.removeChild(confirmBox);
    });
  });
  </script>

  <script>
    window.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".fade").forEach(el => el.classList.add("show"));
    });
  </script>

</body>
</html>
