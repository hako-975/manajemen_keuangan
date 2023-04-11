<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

$kategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_user = '$id_user'");

$saldo = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT (
SUM(CASE tipe_transaksi WHEN 'PEMASUKAN' THEN saldo ELSE 0 END) -
SUM(CASE tipe_transaksi WHEN 'PENGELUARAN' THEN saldo ELSE 0 END)
) as saldo
 FROM transaksi WHERE id_user = '$id_user'"));
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
		<h1>Dashboard</h1>
		<div class="card">
  		<h2>Total Saldo</h2>
  		<h3>Rp. <?= str_replace(",", ".", number_format($saldo['saldo'])); ?></h3>
  	</div>
  	<br>
  	<br>
  	<h2>Total Saldo Kategori</h2>
  	<div class="kategori">
  		<?php foreach ($kategori as $dk): ?>
	  		<?php 
	  			$id_kategori = $dk['id_kategori'];
					$saldo_kategori = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT (
					SUM(CASE tipe_transaksi WHEN 'PEMASUKAN' THEN saldo ELSE 0 END) -
					SUM(CASE tipe_transaksi WHEN 'PENGELUARAN' THEN saldo ELSE 0 END)
					) as saldo
					 FROM transaksi WHERE id_kategori = '$id_kategori' AND id_user = '$id_user'"));
	  		 ?>
	  		<div class="card">
	  			<h2><?= $dk['kategori']; ?></h2>
		  		<h3>Rp. <?= str_replace(",", ".", number_format($saldo_kategori['saldo'])); ?></h3>
	  		</div>
	  	<?php endforeach ?>
  	</div>
	</div>
	<script src="script.js"></script>
</body>
</html>