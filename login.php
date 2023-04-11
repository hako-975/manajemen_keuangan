<?php 
require_once 'koneksi.php';
if (isset($_POST['btnLogin'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query_login = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
  if ($data_user = mysqli_fetch_assoc($query_login)) {
    if (password_verify($password, $data_user['password'])) {
      $_SESSION['id_user'] = $data_user['id_user'];
      header("Location: index.php");
      exit;
    } else {
      echo "
        <script>
          alert('gagal username atau password salah!')
          window.location.href='login.php'
        </script>
      ";
      exit;
    }
  } else {
    echo "
      <script>
        alert('gagal username atau password salah!')
        window.location.href='login.php'
      </script>
    ";
    exit;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Form Login</title>
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
    <h4 class="text-center margin-0">Form Login</h4> <br>
    <form method="post">
      <div>
        <label for="username">Username</label>
        <input type="text" id="username" class="input" name="username" required>
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" id="password" class="input" name="password" required>
      </div>
      <div class="text-right">
        <button type="submit" name="btnLogin" class="button">Login</button>
      </div>
    </form>
    <hr>
    <a href="registrasi.php" class="link">registrasi</a>
  </div>
  <script src="script.js"></script>
</body>
</html>
