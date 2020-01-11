<?php 
session_start();
require 'fungsi.php';
if (isset($_SESSION['login'])) {

	$id = $_SESSION['id'];
	$pemesanan = tampil("SELECT * FROM pemesanan WHERE id_user = $id AND status_pembayaran = 1 AND status_cetak = 0");
	if ($pemesanan ==  false) {
		header("location:homepembeli.php");
	}
}else{
	header("location:homepembeli.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Cetak Bukti Pemesanan</title>
	<link rel="stylesheet" type="text/css" href="cetak.css">
	<link rel="stylesheet" type="text/css" href="assets/dist/css/bootstrap.min.css">	
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
</head>
<body>
	<?php foreach ($pemesanan as $data): ?>
<div class="container">
	<h1><center>Bukti Pemesanan Tiket Taman Botani</center><h1>
	<br>
	<div class="content">
	<form method="POST" action="">
	<table>
		<tr>
			<td><label for="nama_pemesan">Nama Pemesan</label></td>
			<td>:</td>
			<td><Input type="text" name="nama_pemesan" value="<?= $data["nama_pemesan"]; ?>"> </td>
		</tr>	

		<tr>
			<td><label for="alamat">Alamat</label></td>
			<td>:</td>
			<td><input type="text" name="alamat" value="<?= $data['alamat']; ?>"> </td>
		</tr>

		<tr>
			<td><label for="tanggal_berkunjung">Tanggal Berkunjung</label></td>
			<td>:</td>
			<td><input type="text" name="tanggal_berkunjung" value="<?= $data['tanggal_berkunjung']; ?>"> </td>
		</tr>	

		<tr>
			<td><label for="no_telp">No. Telepon</label></td>
			<td>:</td>
			<td><input type="text" name="no_telp" value="<?= $data['no_telp']; ?>"> </td>
		</tr>

		<tr>
			<td><label for="jumlah_tiket">Jumlah tiket</label></td>
			<td>:</td>
			<td><input type="text" name="jumlah_tiket" required value="<?= $data['jumlah_tiket']; ?>"> </td>
		</tr>
		
		<tr>
			<td><label for="total_pembayaran">Total pembayaran</label></td>
			<td>:</td>
			<td><input type="text" name="total_pembayaran" value="<?= $data['total_pembayaran']; ?>"> </td>
		</tr>
	</table>
	<a class="btn btn-success" name="" href="print.php?id=<?= $data['id_pemesanan'] ?>" target="_blank"><i class="fas fa-eye"></i></a>
	<a class="btn btn-primary" name="" href="homepembeli.php"><i class="fas fa-home"></i></a>
	</form>
	</div>
</div>
	<br><br>
	<?php endforeach; ?>
</body>
</html>