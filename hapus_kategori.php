<?php 
require_once 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
	header("Location: index.php");
	exit;
}

$id_kategori = $_GET['id_kategori'];

// cek transaksi jika masih ada transaksi tidak dapat dihapus
$cek_transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_kategori = '$id_kategori'");
if (mysqli_num_rows($cek_transaksi)) {
	echo "
		<script>
			alert('Kategori gagal dihapus! Karena masih terdapat transaksi di dalamnya!')
			document.location.href='kategori.php?id_kategori=$id_kategori'
		</script>
	";
	exit;
}

$hapus_kategori = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori = '$id_kategori'");
if ($hapus_kategori) {
	echo "
		<script>
			alert('kategori berhasil dihapus!')
			document.location.href='tambah_kategori.php'
		</script>
	";
	exit;
} else {
	echo "
		<script>
			alert('kategori gagal dihapus!')
			document.location.href='kategori.php?id_kategori=$id_kategori'
		</script>
	";
	exit;
}

?>