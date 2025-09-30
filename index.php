<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wedding Organizer JEWEPE</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  <!-- Navbar -->
  <header>
      <div class="logo">
        <img src="assets/images/logo1.png" alt="Logo JEWEPE">
      </div>
      <nav>
          <a href="index.php">Beranda</a>
          <a href="contact.php">Kontak</a>
          <a href="login.php">Login</a>
      </nav>
  </header>

  <!-- Hero Section -->
  <section class="hero">
      <h1>Wedding Organizer JEWEPE</h1>
      <p>Selamat datang di website <br> JEWEPE Wedding Organized</p>
  </section>

  <!-- Paket Section -->
  <section class="paket">
    <h2>Pilihan Paket</h2>
    <?php
      $sql = "SELECT * FROM tb_catalogues WHERE status_publish='Y'";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
    ?>
      <div class="paket-item fade">
          <img src="assets/images/<?php echo $row['image']; ?>" alt="<?php echo $row['package_name']; ?>">
          <div>
              <h3><?php echo $row['package_name']; ?></h3>
              <p><?php echo $row['description']; ?></p>
              <p><strong>Harga: Rp <?php echo number_format($row['price'],0,",","."); ?></strong></p>
              <a href="order.php?catalogue_id=<?php echo $row['catalogue_id']; ?>" class="btn">Pesan</a>
          </div>
      </div>
    <?php } ?>
  </section>

  <!-- Testimoni -->
  <section class="testimoni">
      <h2>Testimoni Pelanggan</h2>
      <div class="testimoni-list">
          <div class="card fade">"Terima kasih JEWEPE! Acara kami terasa mewah dan elegan." <br><strong>– Rina & Andi</strong></div>
          <div class="card fade">"Paket Ajib 2 sesuai budget, pelayanan ramah & dekorasi cantik." <br><strong>– Siti & Budi</strong></div>
          <div class="card fade">"Ajib 3 hemat tapi tetap elegan, semua lancar." <br><strong>– Dewi & Raka</strong></div>
      </div>
  </section>

  <!-- Footer -->
  <footer>
      <div class="footer-top">
          <div>
              <h3>Wedding Organizer JEWEPE</h3>
              <p>Penyewaan Tenda & Catering Terbaik</p>
              <p><a href="http://www.jewepewedding.co.id">www.jewepewedding.co.id</a></p>
              <p></p>
              <div class="socials">
                <a href="https://instagram.com/" target="_blank">
                  <img src="assets/images/ig.png" alt="Instagram">
                </a>
                <a href="https://facebook.com/" target="_blank">
                  <img src="assets/images/fb.png" alt="Facebook">
                </a>
                <a href="https://linkedin.com/" target="_blank">
                  <img src="assets/images/in.png" alt="LinkedIn">
                </a>
                <a href="https://youtube.com/" target="_blank">
                  <img src="assets/images/yt.png" alt="YouTube">
                </a>
              </div>

          </div>
          <div>
              <h4>Company</h4>
              <ul>
                  <li><a href="#">About us</a></li>
                  <li><a href="#">Contact</a></li>
                  <li><a href="#">Refund Policy</a></li>
                  <li><a href="#">Privacy Policy</a></li>
              </ul>
          </div>
          <div>
              <h4>Get Help</h4>
              <ul>
                  <li><a href="#">Support</a></li>
                  <li><a href="#">Docs</a></li>
                  <li><a href="#">Blog</a></li>
                  <li><a href="#">Community</a></li>
              </ul>
          </div>
      </div>
      <div class="footer-bottom">
          <p>Copyright © 2025 JEWEPE | Product From JEWEPE Family</p>
      </div>
  </footer>

  <script src="assets/js/script.js"></script>
</body>
</html>
