<?php 

// Koneksi ke database ("host", "root")
$conn = mysqli_connect("localhost", "root", "", "phpdasar");


function query($sql){
    global $conn;
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
};

function tambah($data){
    global $conn;

    $nama = htmlspecialchars($data['nama']);
	$jenis = htmlspecialchars($data['jenis']);
	$harga = htmlspecialchars($data['harga']);
    $domisili = htmlspecialchars($data['domisili']);

    // Upload Gambar
    $gambar = upload();
    if(!$gambar){
        return false;
    }

    $query = "INSERT INTO barang 
                VALUES
            ('', '$nama', '$jenis', '$harga', '$domisili', '$gambar')
            ";
        
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
}

function upload(){
    $namaFile= $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek apakah tidak ada gambar yang diupload
    if($error === 4){
        echo "<script>
			alert('pilih gambar terlebih dahulu!');
		</script>";
        return false;
    }

    // Cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpeg', 'jpg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
			alert('yang anda upload bukan gambar!');
		</script>";
        return false;
    }

    // Cek jika ukurannya terlalu besar
    if($ukuranFile > 1000000){
        echo "<script>
			alert('ukuran gambar terlalu besar!');
		</script>";
        return false;
    }

    // Lolos pengecekan, gambar siap diupload
    move_uploaded_file($tmpName, 'img/' . $namaFile);

    return $namaFile;


}

function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM barang WHERE id = $id");

	return mysqli_affected_rows($conn);
}

function ubah($data) {
	global $conn;

	$id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
	$jenis = htmlspecialchars($data["jenis"]);
	$harga = htmlspecialchars($data["harga"]);
    $domisili = htmlspecialchars($data["domisili"]);
    $gambar = htmlspecialchars($data["gambar"]);

	$sql = "UPDATE barang SET
				nama = '$nama',
				jenis = '$jenis',
				harga = '$harga',
                domisili = '$domisili',
                gambar = '$gambar'
			WHERE
				id = $id
			";

	mysqli_query($conn, $sql);

	return mysqli_affected_rows($conn);
}

function cari($keyword){
    $query = "SELECT * FROM barang WHERE 
                                        nama LIKE '%$keyword%' OR 
                                        jenis LIKE '%$keyword%' OR 
                                        harga LIKE '%$keyword%' OR 
                                        domisili LIKE '%$keyword%'
    ";
    return query($query);
}
?>