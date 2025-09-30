<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - JEWEPE</title>
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <div class="login-container fade">
    <h2>Login Admin</h2>
    <form action="login_process.php" method="post">
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" required>
      </div>
      <div class="button-group">
        <button type="submit" class="btn login">Login</button>
        <a href="index.php" class="btn back">Kembali</a>
      </div>
    </form>

  </div>
  <script src="assets/js/login.js"></script>
</body>
</html>
