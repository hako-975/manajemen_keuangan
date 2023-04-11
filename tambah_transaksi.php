<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

$id_kategori = $_GET['id_kategori'];

$kategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_user = '$id_user'");

$data_kategori = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_user = '$id_user' AND id_kategori = '$id_kategori'"));


if (isset($_POST['btnTambah'])) {
	$tanggal_transaksi = $_POST['tanggal_transaksi'];
	$tipe_transaksi = $_POST['tipe_transaksi'];
	$saldo = $_POST['saldo'];
	$keterangan = nl2br($_POST['keterangan']);

	$tambah_transaksi = mysqli_query($koneksi, "INSERT INTO transaksi VALUES ('', '$tanggal_transaksi', '$tipe_transaksi', '$saldo', '$keterangan', '$id_kategori', '$id_user')");

	if ($tambah_transaksi) {
		echo "
			<script>
				alert('Transaksi berhasil ditambahkan!')
				window.location.href='kategori.php?id_kategori=$id_kategori'
			</script>
		";
		exit;
	} else {
		echo "
			<script>
				alert('Transaksi gagal ditambahkan!')
				window.location.href='kategori.php?id_kategori=$id_kategori'
			</script>
		";
		exit;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Tambah Transaksi Kategori - <?= $data_kategori['kategori']; ?></title>
  <?php include_once 'include_head.php'; ?>
</head>
<body>
	<?php include_once 'include_nav.php'; ?>
	<div class="container">
		<button type="button" onclick="return window.history.back()" class="button">Kembali</button>
		<h1>Tambah Transaksi Kategori - <?= $data_kategori['kategori']; ?></h1>
		<form method="post">
			<div class="form-group">
				<label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
				<input type="datetime-local" name="tanggal_transaksi" id="tanggal_transaksi" class="form-input" required value="<?= date('Y-m-d H:i'); ?>">
			</div>
			<div class="form-group">
				<label for="tipe_transaksi" class="form-label">Tipe Transaksi</label>
				<select name="tipe_transaksi" id="tipe_transaksi" class="form-input">
					<option value="PEMASUKAN">PEMASUKAN</option>
					<option value="PENGELUARAN">PENGELUARAN</option>
				</select>
			</div>
			<div class="form-group">
				<label for="saldo" class="form-label">Jumlah Saldo</label>
				<input type="number" name="saldo" id="saldo" class="form-input" required min="0">
			</div>
			<div class="form-group">
				<label for="keterangan" class="form-label">Keterangan</label>
				<textarea name="keterangan" id="keterangan" class="form-input" placeholder="(Opsional)"></textarea>
			</div>
			<div class="form-group">
				<button type="submit" name="btnTambah" class="button">Tambah</button>
			</div>
		</form>
	</div>
	<script src="script.js"></script>
</body>
</html>