<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name  = $_POST['package_name'] ?? '';
    $desc  = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? '';
    $image = $_FILES['image']['name'] ?? '';

    if (!empty($image)) {
        $target = "assets/images/" . basename($image);
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            die("Upload gambar gagal.");
        }
    } else {
        $image = "default.png";
    }

    $now = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tb_catalogues 
            (package_name, description, price, image, user_id, status_publish, created_at) 
            VALUES ('$name','$desc','$price','$image','{$_SESSION['user_id']}','Y','$now')";
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
  <title>Tambah Data Katalog</title>
  <link rel="stylesheet" href="assets/css/catalogue.css">
</head>
<body>
  <div class="form-container fade">
    <h2>Tambah Data Katalog</h2>
    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Nama Paket</label>
        <input type="text" name="package_name" required>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="description" required></textarea>
      </div>
      <div class="form-group">
        <label>Harga</label>
        <input type="number" name="price" required>
      </div>
      <div class="form-group">
        <label>Gambar</label>
        <input type="file" name="image" accept="image/*" required>
      </div>
      <div class="button-group">
        <button type="submit" class="btn submit">Simpan</button>
        <a href="admin_catalogue.php" class="btn back">Kembali</a>
      </div>
    </form>
  </div>

  <script>
    window.addEventListener("DOMContentLoaded", () => {
      document.querySelector(".fade").classList.add("show");
    });
  </script>
</body>
</html>
