<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

$kategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_user = '$id_user'");

?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <?php include_once 'include_head.php'; ?>
</head>
<body>
	<?php include_once 'include_nav.php'; ?>
	<div class="container">
	</div>
	<script src="script.js"></script>
</body>
</html>