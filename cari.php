
<?php
// sleep(1);
require 'functions.php';
$keyword = $_GET['keyword'];
$sql = "SELECT * FROM barang
			WHERE
		 nrp LIKE '%$keyword%' OR
		 nama LIKE '%$keyword%' OR
		 email LIKE '%$keyword%' OR
		 jurusan LIKE '%$keyword%'
		";
$mahasiswa = query($sql);
?>

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
		<td><a href="ubah.php?id=<?php echo $row["id"]; ?>">ubah</a> | <a href="hapus.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('yakin?')">hapus</a></td>
		<td>
			<img src="img/<?= $row["gambar"]; ?>" width="50">
		</td>
		<td><?= $row["nrp"]; ?></td>
		<td><?= $row["nama"]; ?></td>
		<td><?= $row["email"]; ?></td>
		<td><?= $row["jurusan"]; ?></td>
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
</table>