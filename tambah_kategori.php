<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

$kategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_user = '$id_user'");


if (isset($_POST['btnTambah'])) {
	$kategori = htmlspecialchars(ucwords(strtolower($_POST['kategori'])));

	$cek_nama_kategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE kategori = '$kategori'");
  if (mysqli_num_rows($cek_nama_kategori) > 0) {
    echo "
      <script>
        alert('kategori sudah ada!')
        window.history.back();
      </script>
    ";
    exit;
  }

	$tambah_kategori = mysqli_query($koneksi, "INSERT INTO kategori VALUES ('', '$kategori', '$id_user')");

	if ($tambah_kategori) {
		echo "
			<script>
				alert('Kategori berhasil ditambahkan!')
				window.location.href='index.php'
			</script>
		";
		exit;
	} else {
		echo "
			<script>
				alert('Kategori gagal ditambahkan!')
				window.location.href='index.php'
			</script>
		";
		exit;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Tambah Kategori</title>
  <?php include_once 'include_head.php'; ?>
</head>
<body>
	<?php include_once 'include_nav.php'; ?>
	<div class="container">
		<button type="button" onclick="return window.history.back()" class="button">Kembali</button>
		<h1>Tambah Kategori</h1>
		<form method="post">
			<div class="form-group">
				<label for="kategori" class="form-label">Kategori</label>
				<input type="text" name="kategori" id="kategori" class="form-input" required>
			</div>
			<div class="form-group">
				<button type="submit" name="btnTambah" class="button">Tambah</button>
			</div>
		</form>
	</div>
	<script src="script.js"></script>
</body>
</html>