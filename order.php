<?php include "db.php"; ?>
<?php
$catalogue_id = $_GET['catalogue_id'];
$paket = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_catalogues WHERE catalogue_id=$catalogue_id"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pesan Paket <?php echo $paket['package_name']; ?></title>
  <link rel="stylesheet" href="assets/css/order.css">
</head>
<body>
  <div class="order-container fade">
    <h2>Detail Paket</h2>
    <div class="paket-detail fade">
      <img src="assets/images/<?php echo $paket['image']; ?>" alt="<?php echo $paket['package_name']; ?>">
      <div class="paket-info">
        <h3><?php echo $paket['package_name']; ?></h3>
        <p><?php echo $paket['description']; ?></p>
        <p class="price"><strong>Harga: Rp <?php echo number_format($paket['price'],0,",","."); ?></strong></p>
      </div>
    </div>

    <h3 class="fade">Form Pemesanan</h3>
    <form id="orderForm" class="order-form fade">
        <input type="hidden" name="catalogue_id" value="<?php echo $paket['catalogue_id']; ?>">

        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" name="name" required>
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" required>
        </div>

        <div class="form-group">
          <label>No. Telepon</label>
          <input type="text" name="phone_number" required>
        </div>

        <div class="form-group">
          <label>Tanggal Pernikahan</label>
          <input type="date" name="wedding_date" required>
        </div>

        <div class="button-group">
          <button type="submit" class="btn">Kirim Pesanan</button>
          <a href="index.php" class="btn back">Kembali</a>
        </div>
    </form>
  </div>

  <!-- Popup -->
  <div id="popup" class="popup">
    <div class="popup-content">
      <p>📩 Permintaan Anda sedang diproses.<br>Untuk info lebih lanjut, periksa email dari admin kami.</p>
      <a href="index.php" class="btn">Kembali ke Home</a>
    </div>
  </div>

  <script src="assets/js/order.js"></script>
</body>
</html>
