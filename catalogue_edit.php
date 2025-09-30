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
if ($id == 0) { die("ID katalog tidak ditemukan."); }

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_catalogues WHERE catalogue_id='$id'"));
if (!$data) { die("Data katalog tidak ditemukan."); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name  = $_POST['package_name'];
    $desc  = $_POST['description'];
    $price = $_POST['price'];

    if ($_FILES['image']['name'] != "") {
        $image = $_FILES['image']['name'];
        $target = "assets/images/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $update = "UPDATE tb_catalogues 
                   SET package_name='$name', description='$desc', price='$price', image='$image', updated_at=NOW()
                   WHERE catalogue_id='$id'";
    } else {
        $update = "UPDATE tb_catalogues 
                   SET package_name='$name', description='$desc', price='$price', updated_at=NOW()
                   WHERE catalogue_id='$id'";
    }

    if (!mysqli_query($conn, $update)) {
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
  <title>Edit Data Katalog</title>
  <link rel="stylesheet" href="assets/css/catalogue.css">
</head>
<body>
  <div class="form-container fade">
    <h2>Edit Data Katalog</h2>
    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Nama Paket</label>
        <input type="text" name="package_name" value="<?php echo $data['package_name']; ?>" required>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="description" required><?php echo $data['description']; ?></textarea>
      </div>
      <div class="form-group">
        <label>Harga</label>
        <input type="number" name="price" value="<?php echo $data['price']; ?>" required>
      </div>
      <div class="form-group">
        <label>Gambar (kosongkan jika tidak diubah)</label><br>
        <img src="assets/images/<?php echo $data['image']; ?>" width="120" style="margin-bottom:10px;"><br>
        <input type="file" name="image" accept="image/*">
      </div>
      <div class="button-group">
        <button type="submit" class="btn submit">Update</button>
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
