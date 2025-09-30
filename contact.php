<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kontak - Wedding Organizer JEWEPE</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/contact.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <!-- Navbar (sama seperti index.php) -->
  <header>
      <div class="logo">
        <img src="assets/images/logo1.png" alt="Logo JEWEPE">
      </div>
      <nav>
          <a href="index.php">Beranda</a>
          <a href="contact.php" class="active">Kontak</a>
          <a href="login.php">Login</a>
      </nav>
  </header>

  <!-- Section Kontak -->
  <section class="contact-header fade">
    <div>
      <h1>Hubungi Kami</h1>
      <p>Kami siap melayani pertanyaan, saran, atau kebutuhan Anda terkait layanan Wedding Organizer JEWEPE.</p>
      <div class="contact-buttons">
        <a href="mailto:info@jewepewo.com" class="btn">Kirim Pesan</a>
        <a href="https://wa.me/6281297485841" target="_blank" class="btn-outline">Pesan Sekarang</a>
      </div>
    </div>
    <img src="assets/images/cs1.png" alt="Customer Service JEWEPE">
  </section>

  <!-- Info Cards -->
  <section class="contact-info">
    <div class="info-card fade">
      <i class="fas fa-map-marker-alt"></i>
      <h3>Alamat Kami</h3>
      <p>Gg. Mushola Al-Muchtar No.82, RT.011/RW.17,<br>
         Bahagia, Kec. Babelan,<br>
         Kabupaten Bekasi, Jawa Barat 17610</p>
      <a href="https://maps.app.goo.gl/y1c5KysZt2ompkN97" target="_blank">Lihat di Maps →</a>

    </div>

    <div class="info-card fade">
      <i class="fas fa-phone"></i>
      <h3>Telepon Kami</h3>
      <p>Telp/WhatsApp: 0812-9748-5841</p>
      <a href="https://wa.me/6281297485841" target="_blank">Chat WhatsApp →</a>
    </div>

    <div class="info-card fade">
      <i class="fas fa-envelope"></i>
      <h3>Email Kami</h3>
      <p>info@jewepewo.com</p>
      <p>Jam Operasional:<br>
         Senin - Jumat: 08.00 - 20.00 WIB<br>
         Sabtu - Minggu: 07.30 - 15.00 WIB</p>
      <a href="mailto:info@jewepewo.com">Kirim Email →</a>
    </div>
  </section>

  <!-- Footer (sama seperti index.php) -->
  <footer>
      <div class="footer-top">
          <div>
              <h3>Wedding Organizer JEWEPE</h3>
              <p>Penyewaan Tenda & Catering Terbaik</p>
              <p><a href="http://www.jewepewedding.co.id">www.jewepewedding.co.id</a></p>
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

  <!-- Animasi Fade -->
  <script>
    const faders = document.querySelectorAll('.fade');
    const appearOnScroll = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("show");
        observer.unobserve(entry.target);
      });
    }, { threshold: 0.2 });
    faders.forEach(fader => { appearOnScroll.observe(fader); });
  </script>

</body>
</html>
