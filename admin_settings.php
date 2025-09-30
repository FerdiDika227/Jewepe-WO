<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include "db.php";

// Ambil data settings pertama (id = 1)
$result = mysqli_query($conn, "SELECT * FROM tb_settings LIMIT 1");
$settings = mysqli_fetch_assoc($result);

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $website_name   = $_POST['website_name'];
    $phone_number1  = $_POST['phone_number1'];
    $phone_number2  = $_POST['phone_number2'];
    $email1         = $_POST['email1'];
    $email2         = $_POST['email2'];
    $address        = $_POST['address'];
    $maps           = $_POST['maps'];
    $facebook_url   = $_POST['facebook_url'];
    $instagram_url  = $_POST['instagram_url'];
    $youtube_url    = $_POST['youtube_url'];
    $header_business_hour = $_POST['header_business_hour'];
    $time_business_hour   = $_POST['time_business_hour'];
    $updated_at     = date("Y-m-d H:i:s");

    if ($settings) {
        // update
        $sql = "UPDATE tb_settings SET 
                    website_name='$website_name',
                    phone_number1='$phone_number1',
                    phone_number2='$phone_number2',
                    email1='$email1',
                    email2='$email2',
                    address='$address',
                    maps='$maps',
                    facebook_url='$facebook_url',
                    instagram_url='$instagram_url',
                    youtube_url='$youtube_url',
                    header_business_hour='$header_business_hour',
                    time_business_hour='$time_business_hour',
                    updated_at='$updated_at'
                WHERE id={$settings['id']}";
    } else {
        // insert jika belum ada
        $sql = "INSERT INTO tb_settings 
                    (website_name, phone_number1, phone_number2, email1, email2, address, maps, facebook_url, instagram_url, youtube_url, header_business_hour, time_business_hour, created_at) 
                VALUES 
                    ('$website_name','$phone_number1','$phone_number2','$email1','$email2','$address','$maps','$facebook_url','$instagram_url','$youtube_url','$header_business_hour','$time_business_hour','$updated_at')";
    }

    if (!mysqli_query($conn, $sql)) {
        die("SQL Error: " . mysqli_error($conn));
    }

    header("Location: admin_settings.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Profil Web</title>
  <link rel="stylesheet" href="assets/css/admin.css">
  <link rel="stylesheet" href="assets/css/admin_settings.css">
</head>
<body>
<div class="admin-container fade">

  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="profile">
      <img src="assets/images/logo1.png" alt="Foto Admin">
      <h3><?php echo $_SESSION['name']; ?></h3>
    </div>
    <nav class="menu">
      <a href="admin.php">🏠 Dashboard</a>
      <a href="admin_catalogue.php">📦 Manajemen Katalog</a>
      <a href="admin_order.php">📝 Manajemen Pesanan</a>
      <a href="admin_report.php">📊 Laporan Pesanan</a>
      <a href="admin_settings.php" class="active">⚙️ Manajemen Profil Web</a>
    </nav>
    <div class="logout">
      <a href="#" id="logoutBtn">🚪 Logout</a>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="content fade">
    <h1>Manajemen Profil Web</h1>

    <div class="settings-form fade">
      <form method="post">
        <div class="form-group">
          <label>Nama Website</label>
          <input type="text" name="website_name" value="<?php echo $settings['website_name'] ?? ''; ?>" required>
        </div>
        <div class="form-group">
          <label>Nomor Telepon 1</label>
          <input type="text" name="phone_number1" value="<?php echo $settings['phone_number1'] ?? ''; ?>" required>
        </div>
        <div class="form-group">
          <label>Nomor Telepon 2</label>
          <input type="text" name="phone_number2" value="<?php echo $settings['phone_number2'] ?? ''; ?>">
        </div>
        <div class="form-group">
          <label>Email 1</label>
          <input type="email" name="email1" value="<?php echo $settings['email1'] ?? ''; ?>" required>
        </div>
        <div class="form-group">
          <label>Email 2</label>
          <input type="email" name="email2" value="<?php echo $settings['email2'] ?? ''; ?>">
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <textarea name="address" required><?php echo $settings['address'] ?? ''; ?></textarea>
        </div>
        <div class="form-group">
          <label>Maps Embed</label>
          <textarea name="maps"><?php echo $settings['maps'] ?? ''; ?></textarea>
        </div>
        <div class="form-group">
          <label>Facebook URL</label>
          <input type="text" name="facebook_url" value="<?php echo $settings['facebook_url'] ?? ''; ?>">
        </div>
        <div class="form-group">
          <label>Instagram URL</label>
          <input type="text" name="instagram_url" value="<?php echo $settings['instagram_url'] ?? ''; ?>">
        </div>
        <div class="form-group">
          <label>Youtube URL</label>
          <input type="text" name="youtube_url" value="<?php echo $settings['youtube_url'] ?? ''; ?>">
        </div>
        <div class="form-group">
          <label>Header Business Hour</label>
          <input type="text" name="header_business_hour" value="<?php echo $settings['header_business_hour'] ?? ''; ?>">
        </div>
        <div class="form-group">
          <label>Detail Business Hour</label>
          <textarea name="time_business_hour"><?php echo $settings['time_business_hour'] ?? ''; ?></textarea>
        </div>
        <div class="button-group">
          <button type="submit" class="btn">Simpan</button>
        </div>
      </form>
    </div>
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
  // Tambahkan efek fade supaya konten muncul
  window.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".fade").forEach(el => el.classList.add("show"));
  });
</script>

</body>
</html>
