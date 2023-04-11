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

if (isset($_POST['btnUbah'])) {
	$kategori = htmlspecialchars(ucwords(strtolower($_POST['kategori'])));

	// check kategori 
	$old_kategori = $data_kategori['kategori'];
	if ($kategori != $old_kategori) {
		$cek_kategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE kategori = '$kategori'");
		if (mysqli_num_rows($cek_kategori)) {
			echo "
				<script>
					alert('kategori sudah ada!')
					window.history.back();
				</script>
			";
			exit;
		}
	}

	$ubah_kategori = mysqli_query($koneksi, "UPDATE kategori SET kategori = '$kategori' WHERE id_kategori = '$id_kategori' AND id_user = '$id_user'");

	if ($ubah_kategori) {
		echo "
			<script>
				alert('Kategori berhasil diubah!')
				window.location.href='kategori.php?id_kategori=$id_kategori'
			</script>
		";
		exit;
	} else {
		echo "
			<script>
				alert('Kategori gagal diubah!')
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
  <title>Ubah Kategori - <?= $data_kategori['kategori']; ?></title>
  <?php include_once 'include_head.php'; ?>
</head>
<body>
	<?php include_once 'include_nav.php'; ?>
	<div class="container">
		<button type="button" onclick="return window.history.back()" class="button">Kembali</button>
		<h1>Ubah Kategori - <?= $data_kategori['kategori']; ?></h1>
		<form method="post">
			<div class="form-group">
				<label for="kategori" class="form-label">Kategori</label>
				<input type="text" name="kategori" id="kategori" class="form-input" required value="<?= $data_kategori['kategori']; ?>">
			</div>
			<div class="form-group">
				<button type="submit" name="btnUbah" class="button">Ubah</button>
			</div>
		</form>
	</div>
	<script src="script.js"></script>
</body>
</html>