<?php 
require 'functions.php';

$id = $_GET["id"];
$row = query("SELECT * FROM barang WHERE id = $id")[0];


if( isset($_POST["ubah"]) ) {
	if( ubah($_POST) > 0 ) {
		echo "<script>
				alert('data berhasil diubah!');
				document.location.href = 'index.php';
			  </script>";
	} else {
		echo "<script>
				alert('data gagal diubah!');
				document.location.href = 'index.php';
			  </script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ubah Data Barang</title>
	<style>
		ul li { list-style: none; }
	</style>
</head>
<body>
	<h1>Ubah Data Barang</h1>
	<form action="" method="post" enctype="multipart/form-data>
		<input type="hidden" name="id" value="<?= $row["id"]; ?>">
		<ul>
			<li>
				<label for="nama">Nama : </label>
				<input type="text" name="nama" id="nama" value="<?= $row["nama"]; ?>">
			</li>
			<li>
				<label for="jenis">Jenis : </label>
				<input type="text" name="jenis" id="jenis" value="<?= $row["jenis"]; ?>">
			</li>
			<li>
				<label for="harga">Harga : </label>
				<input type="text" name="harga" id="harga" value="<?= $row["harga"]; ?>">
			</li>
			<li>
				<label for="domisili">Domisili : </label>
				<input type="text" name="domisili" id="domisili" value="<?= $row["domisili"]; ?>">
			</li>
			<li>
				<label for="gambar">Gambar : </label>
				<input type="file" name="gambar" id="gambar" value="<?= $row["gambar"]; ?>">
			</li>
			<li>
				<button type="submit" name="ubah">Ubah Data!</button>
			</li>
		</ul>
	</form>
</body>
</html>