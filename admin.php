<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include "db.php"; 

// Hitung total katalog
$resultCatalogues = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tb_catalogues");
$totalCatalogues = mysqli_fetch_assoc($resultCatalogues)['total'] ?? 0;

// Hitung katalog publish & unpublish
$resultPublish = mysqli_query($conn, "SELECT status_publish, COUNT(*) AS jumlah FROM tb_catalogues GROUP BY status_publish");
$publishData = ['Y' => 0, 'N' => 0];
while ($row = mysqli_fetch_assoc($resultPublish)) {
    $publishData[$row['status_publish']] = $row['jumlah'];
}

// Hitung pesanan berdasarkan status (requested, approved, rejected)
$resultOrders = mysqli_query($conn, "SELECT status, COUNT(*) AS jumlah FROM tb_order GROUP BY status");
$orderData = ['requested' => 0, 'approved' => 0, 'rejected' => 0];
while ($row = mysqli_fetch_assoc($resultOrders)) {
    $orderData[$row['status']] = $row['jumlah'];
}

// Data admin
$adminName = $_SESSION['name'];
$adminPhoto = "assets/images/logo1.png";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - JEWEPE</title>
  <link rel="stylesheet" href="assets/css/admin.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <a href="admin_report.php">📊 Laporan Pesanan</a>
        <a href="admin_settings.php">⚙️ Manajemen Profil Web</a>
      </nav>
      <div class="logout">
        <a href="#" id="logoutBtn">🚪 Logout</a>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="content fade">
      <h1>Dashboard Admin</h1>

      <!-- Cards -->
      <div class="cards">
        <div class="card">
          <h2><?php echo $totalCatalogues; ?></h2>
          <p>Total Katalog</p>
          <small>Publish: <?php echo $publishData['Y']; ?> | Draft: <?php echo $publishData['N']; ?></small>
        </div>
        <div class="card">
          <h2><?php echo array_sum($orderData); ?></h2>
          <p>Total Pesanan</p>
          <small>
            Requested: <?php echo $orderData['requested']; ?> |
            Approved: <?php echo $orderData['approved']; ?> |
            Rejected: <?php echo $orderData['rejected']; ?>
          </small>
        </div>
      </div>

      <!-- Statistik Katalog -->
      <div class="chart-container">
        <h2>Statistik Katalog</h2>
        <canvas id="catalogueChart"></canvas>
      </div>

      <!-- Statistik Pesanan -->
      <div class="chart-container">
        <h2>Statistik Pesanan</h2>
        <canvas id="orderChart"></canvas>
      </div>
    </main>
  </div>

  <script src="assets/js/admin.js"></script>

  <!-- Chart.js -->
  <script>
    // Statistik Katalog
    new Chart(document.getElementById('catalogueChart').getContext('2d'), {
      type: 'doughnut',
      data: {
        labels: ['Publish', 'Unpublish'],
        datasets: [{
          label: 'Jumlah Katalog',
          data: [<?php echo $publishData['Y']; ?>, <?php echo $publishData['N']; ?>],
          backgroundColor: ['#4caf50', '#f44336'],
          borderWidth: 1
        }]
      }
    });

    // Statistik Pesanan
    new Chart(document.getElementById('orderChart').getContext('2d'), {
      type: 'doughnut',
      data: {
        labels: ['Requested', 'Approved', 'Rejected'],
        datasets: [{
          label: 'Jumlah Pesanan',
          data: [
            <?php echo $orderData['requested']; ?>,
            <?php echo $orderData['approved']; ?>,
            <?php echo $orderData['rejected']; ?>
          ],
          backgroundColor: ['#ff9800', '#6a82fb', '#f44336'],
          borderWidth: 1
        }]
      }
    });
  </script>

  <script>
  // Animasi fade agar konten muncul
  window.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".fade").forEach(el => el.classList.add("show"));
  });
</script>

</body>
</html>
