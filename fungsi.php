<?php 
//koneksi database
$conn = mysqli_connect("localhost","root","","tamanbotani");

//fungsi untuk menampilkan data dari database
function tampil($query){
	global $conn;
	$result = mysqli_query($conn,$query);
	$rows = [];
	while ($row  = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
		return $rows;
	}
	
//fungsi untuk menyimpan data registrasi pembeli ke dalam database
function registrasi($data){
	global $conn;
 	$nama = htmlspecialchars($data["nama"]);
 	$jenkel = htmlspecialchars($data["jeniskelamin"]);
 	$email = htmlspecialchars($data["email"]);
 	$password = htmlspecialchars($data["pwd"]);
 	$pin = htmlspecialchars($data["pin"]);

 	//query insert data
 	$query = "INSERT INTO users values ('','$nama','$jenkel','$email','$password','$pin','1','default.jpg')";
 	mysqli_query($conn,$query);
 	return mysqli_affected_rows($conn);
 }

//fungsi untuk menyimpan data registrasi admin ke dalam database
function registrasiadmin($data){
	global $conn;
 	$nama = htmlspecialchars($data["nama"]);
 	$jenkel = htmlspecialchars($data["jeniskelamin"]);
 	$email = htmlspecialchars($data["email"]);
 	$password = htmlspecialchars($data["pwd"]);
 	$pin = htmlspecialchars($data["pin"]);

 	//query insert data
 	$query = "INSERT INTO users values ('','$nama','$jenkel','$email','$password','$pin','2','default.jpg')";
 	mysqli_query($conn,$query);
 	return mysqli_affected_rows($conn);
 }

 //fungsi untuk menyimpan data pemesanan admin ke dalam database
function pemesanan($data){
	global $conn;
	$id = $_SESSION['id'];
	$tanggal = htmlspecialchars($data["tgl"]);
	$total = htmlspecialchars($data["total"]);
	$jumlah = htmlspecialchars($data["jumlah"]);
 	$nama_pemesan = htmlspecialchars($data["nama"]);
 	$alamat = htmlspecialchars($data["alamat"]);
 	$no_telp = htmlspecialchars($data["no_telp"]);
 	//query insert data
 	$query = "INSERT INTO pemesanan values ('','$nama_pemesan','$alamat','$tanggal','$jumlah','$total','$no_telp','','','','$id')";
 	mysqli_query($conn,$query);
 	return mysqli_affected_rows($conn);
 }


 //fungsi untuk menyimpan data pengunjung ke dalam database
function pengunjung($data){
	global $conn;
 	$tgl_pengunjung = htmlspecialchars($data["tanggal"]);
 	$jum_pengunjung = htmlspecialchars($data["jumlah_pengunjung"]);

 	//query insert data
 	$query = "INSERT INTO pengunjung values ('','$tgl_pengunjung','$jum_pengunjung')";
 	mysqli_query($conn,$query);
 	return mysqli_affected_rows($conn);
 }

//fungsi untuk menghapus data dalam database
 function hapus($id){
 	global $conn;
 	mysqli_query($conn, "DELETE FROM pengunjung WHERE id_pengunjung = $id");
 	return mysqli_affected_rows($conn);
 }

 //fungsi untuk menyimpan data harga ke dalam database
function harga($data){
	global $conn;
 	$hari = htmlspecialchars($data["hari"]);
 	$harga = htmlspecialchars($data["harga"]);

 	//query insert data
 	$query = "INSERT INTO harga values ('','$hari','$harga')";
 	mysqli_query($conn,$query);
 	return mysqli_affected_rows($conn);
 }

//fungsi untuk menghapus data dalam database
function hapusharga($id){
 	global $conn;
 	mysqli_query($conn, "DELETE FROM harga WHERE id_harga = $id");
 	return mysqli_affected_rows($conn);
 }

		
//fungsi untuk mengubah (edit) data pengunjung dalam database
 function ubah($data){
 	global $conn;
 	$id_pengunjung = htmlspecialchars($data["id"]);
 	$tgl_pengunjung = htmlspecialchars($data["tanggal"]);
 	$jum_pengunjung = htmlspecialchars($data["jumlah_pengunjung"]);

 	//query update data
 	$query = "UPDATE pengunjung SET
 				tgl_pengunjung = '$tgl_pengunjung',
 				jum_pengunjung = '$jum_pengunjung'
 				where id_pengunjung = '$id_pengunjung'
 				";
 	$result = mysqli_query($conn,$query);
 	return mysqli_affected_rows($conn);
 }

//fungsi untuk mengubah data harga dalam database
 function ubahharga($data){
 	global $conn;
 	$id_harga = htmlspecialchars($data["id"]);
 	$hari = htmlspecialchars($data["hari"]);
 	$harga = htmlspecialchars($data["harga"]);

 	//query update data
 	$query = "UPDATE harga SET
 				hari = '$hari',
 				harga = '$harga'
 				where id_harga = '$id_harga'
 				";
 	$result = mysqli_query($conn,$query);
 	return mysqli_affected_rows($conn);
 }

 //fungsi untuk mengubah data akun dalam database
 function ubah_akun($data){
	global $conn;
	$id_user = $_SESSION['id'];
	$nama = htmlspecialchars($data["nama"]);
	$jeniskelamin = htmlspecialchars($data["jeniskelamin"]);
	$email = htmlspecialchars($data["email"]);
	$pwd = htmlspecialchars($data["pwd"]);
	$pin = htmlspecialchars($data["pin"]);

	//query update data
	$query = "UPDATE users SET
				nama = '$nama',
				jenkel = '$jeniskelamin',
				email = '$email',
				password = '$pwd',
				pin = '$pin'
				where id_user = '$id_user'
				";
	$result = mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
}



//fungsi untuk mengunggah bukti pembayaran  ke dalam database
function unggah($data){
	global $conn;
	$iduser = $_SESSION['id'];
 	//upload gambar
 	$gambar = upload();
 	if (!$gambar) {
 		return false;
 	}
 	//query update tabel pemesanan data bukti pembayaran dimana status pembayaran 0
 	$query = "UPDATE pemesanan SET
 				bukti_pembayaran = '$gambar'
 				where id_user = '$iduser' AND status_pembayaran = 0
 				";
 	$result = mysqli_query($conn,$query);
 	return mysqli_affected_rows($conn);
 }

function upload() {
	$namafile = $_FILES['gambar']['name'];
	$ukuranfile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpname = $_FILES['gambar']['tmp_name'];
	//cek apakah tidak ada gambar yang diupload
	if ($error === 4) {
		echo "
			<script>
			alert('Silahkan masukkan bukti pembayaran!');
			</script>";
		return false;
	}

	//cek apakah yang diupload adalah gambar
	$ekstensigambarvalid = ['jpg', 'jpeg', 'png'];
	$ekstensigambar = explode('.', $namafile);
	$ekstensigambar = strtolower(end($ekstensigambar));
	if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
		echo "
			<script>
			alert('Format file tidak didukung!');
			document.location.href = 'homepembeli.php';
			</script>";
			exit;
	}

	//cek jika ukurannya terlalu besar
	if ($ukuranfile > 1000000) {
		echo "
			<script>
			alert('Ukuran Gambar Terlalu Besar!');
			document.location.href = 'homepembeli.php';
			</script>";
			exit;
	}

	$namagambar = uniqid();
	$namagambar	.= '.';
	$namagambar	.= $ekstensigambar;
	//lolos pengecekan, gambar siap diupload
	move_uploaded_file($tmpname, 'admin/fotobuktipembayaran/'.$namagambar);
	return $namagambar;
}




//fungsi untuk mengubah foto profil
function ubahfoto($data){
	global $conn;
	$iduser = $_SESSION['id'];
 	//upload foto
 	$foto = uploadfoto();
 	if (!$foto) {
 		return false;
 	}
 	//query update foto profil
 	$query = "UPDATE users SET
 				foto = '$foto'
 				where id_user = '$iduser'
 				";
 	$result = mysqli_query($conn,$query);
 	return mysqli_affected_rows($conn);
 }

function uploadfoto() {
	$namafile = $_FILES['foto']['name'];
	$ukuranfile = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];
	$tmpname = $_FILES['foto']['tmp_name'];
	//cek apakah tidak ada foto yang diupload
	if ($error === 4) {
		echo "
			<script>
			alert('Pilih Foto Profil!');
			</script>";
		return false;
	}

	//cek apakah yang diupload adalah gambar
	$ekstensifotovalid = ['jpg', 'jpeg', 'png'];
	$ekstensifoto = explode('.', $namafile);
	$ekstensifoto = strtolower(end($ekstensifoto));
	if (!in_array($ekstensifoto, $ekstensifotovalid)) {
		echo "
			<script>
			alert('Yang Anda Upload Bukan Foto!');
			document.location.href = 'akun.php';
			</script>";
			exit;
	}

	//cek jika ukurannya terlalu besar
	if ($ukuranfile > 1000000) {
		echo "
			<script>
			alert('Ukuran foto Terlalu Besar!');
			document.location.href = 'akun.php';
			</script>";
			exit;
	}

	$namafoto = uniqid();
	$namafoto	.= '.';
	$namafoto	.= $ekstensifoto;
	//lolos pengecekan, foto siap diupload
	move_uploaded_file($tmpname, 'admin/fotoprofil/'.$namafoto);
	return $namafoto;
}


//fungsi cari data users
function cari($keyword) {
	global $conn;
	$keyword = $keyword['keyword'];
	$query = "SELECT * FROM users
				where
				id_user LIKE '%$keyword%' OR
				nama LIKE '%$keyword%' OR 
				jenkel LIKE '%$keyword%' OR
				email LIKE '%$keyword%' OR
				id_akses LIKE '%$keyword%'
			";
	return tampil($query);
}

//fungsi cari data pemesanan
function caripemesanan($keywordpemesanan) {
	global $conn;
	$keywordpemesanan = $keywordpemesanan['keywordpemesanan'];
	$query = "SELECT * FROM pemesanan
				where
				id_pemesanan LIKE '%$keywordpemesanan%' OR
				nama_pemesan LIKE '%$keywordpemesanan%' OR 
				alamat LIKE '%$keywordpemesanan%' OR
				tanggal_berkunjung LIKE '%$keywordpemesanan%' OR
				jumlah_tiket LIKE '%$keywordpemesanan%' OR
				total_pembayaran LIKE '%$keywordpemesanan%' OR
				no_telp LIKE '%$keywordpemesanan%' OR
				status_pembayaran LIKE '%$keywordpemesanan%' OR
				status_cetak LIKE '%$keywordpemesanan%' OR
				id_user LIKE '%$keywordpemesanan%'
			";
	return tampil($query);
}

//fungsi cari data pengunjung
function caripengunjung($keywordpengunjung) {
	global $conn;
	$keywordpengunjung = $keywordpengunjung['keywordpengunjung'];
	$query = "SELECT * FROM pengunjung
				where
				id_pengunjung LIKE '%$keywordpengunjung%' OR
				tgl_pengunjung LIKE '%$keywordpengunjung%' OR 
				jum_pengunjung LIKE '%$keywordpengunjung%'
			";
	return tampil($query);
}

//fungsi cari data harga
function cariharga($keywordharga) {
	global $conn;
	$keywordharga = $keywordharga['keywordharga'];
	$query = "SELECT * FROM harga
				where
				id_harga LIKE '%$keywordharga%' OR
				hari LIKE '%$keywordharga%' OR 
				harga LIKE '%$keywordharga%'
			";
	return tampil($query);
}

//fungsi cari data konfirmasi
function carikonfirmasi($keywordkonfirmasi) {
	global $conn;
	$keywordkonfirmasi = $keywordkonfirmasi['keywordkonfirmasi'];
	$query = "SELECT * FROM pemesanan
				where
				bukti_pembayaran != 0 AND
				id_pemesanan LIKE '%$keywordkonfirmasi%' OR
				nama_pemesan LIKE '%$keywordkonfirmasi%' OR 
				total_pembayaran LIKE '%$keywordkonfirmasi%' OR
				status_pembayaran LIKE '%$keywordkonfirmasi%'
			";
	return tampil($query);
}


?>