<?php 
session_start();
require 'fungsi.php';
$id = $_SESSION['id'];
$idpemesanan = $_GET['id'];
if (isset($idpemesanan)) {
	$printpemesanan = tampil("SELECT * FROM pemesanan WHERE id_pemesanan = $idpemesanan");		
	echo "
		<script>
			alert('Silahkan Simpan Bukti Pemesanan terlebih dahulu sebelum mencetak!!!');
		</script>
	";
}

$print = "
	<script>
		window.print();
	</script>
";

if (isset($_POST['printdetail'])) {
	echo $print;
	mysqli_query($conn,"UPDATE pemesanan SET status_cetak = 1 WHERE id_pemesanan = $idpemesanan");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Print</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='foto/2Logo-Botani-1.png' rel='shortcut icon'>
	<!-- My CSS -->
	<link rel="stylesheet" type="text/css" href="cetak.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/all.css">
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
  	<script src="js/jquery-3.4.1.min.js"></script>
  	<script src="js/popper.min.js"></script>
  	<script src="js/bootstrap.js"></script>
  	<script src="js/all.js"></script>
</head>
<body>

<!-- Header -->

<section>
	<header class="transparan">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-dark mt-auto mb-2">
			  		<img src="foto/2Logo-Botani-1.png" height="90" width="90">
			  	<div class="nav-item">
				  	<h1 class="text-white text-uppercase font-weight-bolder ml-4 shadow-sm">Bukti Pemesanan Tiket Taman Botani</h1>
			  	</div>
			</nav>
		</div>
	</header>
</section>

<!-- Akhir Header -->

<!-- Konten -->

<section>	
	<content>
		<div class="container">    
			<?php foreach ($printpemesanan as $data): ?>
			<div class="container">
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
				<button name="printdetail" type="submit" class="btn btn-primary"><i class="fas fa-print"></i></button>
			</form>
			</div>
			</div>
			<br><br>
			<?php endforeach; ?>
		</div>
	</content>
</section>

<!-- Akhir Konten -->

</body>
</html>