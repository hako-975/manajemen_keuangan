<?php 
require_once 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
	header("Location: index.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

$id_kategori = $_GET['id_kategori'];
$id_transaksi = $_GET['id_transaksi'];
$hapus_transaksi = mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi' AND id_kategori = '$id_kategori' AND id_user = '$id_user'");
if ($hapus_transaksi) {
	echo "
		<script>
			alert('transaksi berhasil dihapus!')
			document.location.href='kategori.php?id_kategori=$id_kategori'
		</script>
	";
	exit;
} else {
	echo "
		<script>
			alert('transaksi gagal dihapus!')
			document.location.href='kategori.php?id_kategori=$id_kategori'
		</script>
	";
	exit;
}

?>