<?php 
require_once 'koneksi.php';
if (isset($_POST['btnRegistrasi'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $verifikasi_password = $_POST['verifikasi_password'];
  // check username 
  $query_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
  if (mysqli_num_rows($query_user) > 0) {
    echo "
      <script>
        alert('Username sudah digunakan!')
        window.history.back();
      </script>
    ";
    exit;
  }

  if ($password != $verifikasi_password) {
    echo "
      <script>
        alert('password tidak sama dengan verifikasi password!')
        window.history.back();
      </script>
    ";
    exit;
  }
  $password = password_hash($password, PASSWORD_DEFAULT);

  $insert_user = mysqli_query($koneksi, "INSERT INTO user (username, password) VALUES ('$username', '$password')");
  if ($insert_user) {
    echo "
      <script>
        alert('Registrasi berhasil!')
        window.location.href='login.php'
      </script>
    ";
    exit;
  } else {
    echo "
      <script>
        alert('Registrasi gagal!')
        window.history.back();
      </script>
    ";
    exit;
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Form Registrasi</title>
  <link rel="icon" href="img/logo.png">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-auth">
  <div class="form-login-registrasi">
    <img src="img/logo.png" alt="logo" class="logo">
    <br>
    <h3 class="text-center margin-0">Manajemen Keuangan</h3>
    <h4 class="text-center margin-0">Form Registrasi</h4> <br>
    <form method="post">
      <div>
        <label for="username">Username</label>
        <input type="text" id="username" class="input" name="username" required>
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" id="password" class="input" name="password" required>
      </div>
      <div>
        <label for="verifikasi_password">Verifikasi Password</label>
        <input type="password" id="verifikasi_password" class="input" name="verifikasi_password" required>
      </div>
      <div class="text-right">
        <button type="submit" name="btnRegistrasi" class="button">Registrasi</button>
      </div>
    </form>
    <hr>
    <a href="login.php" class="link">login</a>
  </div>
</body>
</html>
