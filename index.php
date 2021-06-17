<?php
require 'functions.php';

if( isset($_GET['cari']) ) {
	$keyword = $_GET['keyword'];
	$sql = "SELECT * FROM barang
				WHERE
			 nama LIKE '%$keyword%' OR
			 jenis LIKE '%$keyword%' OR
			 harga LIKE '%$keyword%' OR
			 domisili LIKE '%$keyword%'
			";
	$barang = query($sql);
} else {
	$barang = query("SELECT * FROM barang");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Administrator</title>
</head>
<body>

<h1>Halaman Administrator</h1>

<a href="tambah.php">Tambah Data Barang</a>
<br><br>

<form action="" method="get">
	<input type="search" name="keyword" placeholder="masukkan keyword pencarian.." size="40" autocomplete="off" id="keyword">
	<button type="submit" name="cari" id="cari">Cari!</button>
</form>

<br>

<div id="container">
<table border="1" cellspacing="0" cellpadding="5">
	<tr>
		<th>#</th>
		<th>Aksi</th>
		<th>Gambar</th>
		<th>Nama</th>
		<th>Jenis</th>
		<th>Harga</th>
		<th>Domisili</th>
	</tr>
	
	<?php if( empty($barang) ) : ?>
		<tr>
			<td colspan="7" align="center">data barang tidak ditemukan</td>
		</tr>
	<?php endif; ?>

	<?php $i = 1; ?>
	<?php foreach( $barang as $row ) : ?>
	<tr>
		<td><?= $i; ?></td>
		<td><a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> | <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?')">hapus</a></td>
		<td>
			<img src="img/<?= $row["gambar"]; ?>" width="50">
		</td>
		<td><?= $row["nama"]; ?></td>
		<td><?= $row["jenis"]; ?></td>
		<td><?= $row["harga"]; ?></td>
		<td><?= $row["domisili"]; ?></td>
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
</table>
</div>

<script src="jquery-3.1.1.min.js"></script>
<script src="script.js"></script>
</body>
</html>