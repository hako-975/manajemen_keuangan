<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_kategori = $_GET['id_kategori'];

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

$kategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_user = '$id_user'");

$data_kategori = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_user = '$id_user' AND id_kategori = '$id_kategori'"));

$transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_kategori = '$id_kategori'");

$saldo_kategori = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT (
SUM(CASE tipe_transaksi WHEN 'PEMASUKAN' THEN saldo ELSE 0 END) -
SUM(CASE tipe_transaksi WHEN 'PENGELUARAN' THEN saldo ELSE 0 END)
) as saldo
 FROM transaksi WHERE id_kategori = '$id_kategori'"));

?>

<!DOCTYPE html>
<html>
<head>
  <title>Kategori - <?= $data_kategori['kategori']; ?></title>
  <?php include_once 'include_head.php'; ?>
</head>
<body>
	<?php include_once 'include_nav.php'; ?>
	<div class="container">
		<h1>Kategori - <?= $data_kategori['kategori']; ?></h1>
		<h2>Saldo Kategori <?= $data_kategori['kategori']; ?>: Rp. <?= str_replace(",", ".", number_format($saldo_kategori['saldo'])); ?></h2>
		<a href="tambah_transaksi.php?id_kategori=<?= $id_kategori; ?>" class="button bg-blue">Transaksi</a>
		<a href="ubah_kategori.php?id_kategori=<?= $id_kategori; ?>" class="button">Ubah</a>
		<a onclick="return confirm('Apakah Anda ingin menghapus kategori <?= $data_kategori['kategori']; ?>?')" href="hapus_kategori.php?id_kategori=<?= $id_kategori; ?>" class="button bg-red">Hapus</a>
		<br>
		<br>
		<table border="1" cellpadding="20" cellspacing="0">
			<thead>
				<tr>
					<th>No.</th>
					<th>Tanggal Transaksi</th>
					<th>Tipe Transaksi</th>
					<th>Saldo</th>
					<th>Keterangan</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; ?>
				<?php foreach ($transaksi as $dt): ?>
					<tr>
						<td><?= $i++; ?></td>
						<td><?= $dt['tanggal_transaksi']; ?></td>
						<td><?= $dt['tipe_transaksi']; ?></td>
						<td>Rp. <?= str_replace(",", ".", number_format($dt['saldo'])); ?></td>
						<td><?= $dt['keterangan']; ?></td>
						<td>
							<a href="ubah_transaksi.php?id_kategori=<?= $dt['id_kategori']; ?>&id_transaksi=<?= $dt['id_transaksi']; ?>" class="button">Ubah</a>
  						<a href="hapus_transaksi.php?id_kategori=<?= $dt['id_kategori']; ?>&id_transaksi=<?= $dt['id_transaksi']; ?>" class="button bg-red" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi?')">Hapus</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<script src="script.js"></script>
</body>
</html>