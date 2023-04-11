<nav>
  <ul>
    <li><a href="index.php">Manajemen Keuangan</a></li>
    <?php foreach ($kategori as $dk): ?>
    	<li><a href="kategori.php?id_kategori=<?= $dk['id_kategori']; ?>"><?= $dk['kategori']; ?></a></li>
    <?php endforeach ?>
    <li><a href="tambah_kategori.php">Tambah Kategori</a></li>
    <li class="right"><a href="logout.php">Logout</a></li>
  </ul>
</nav>