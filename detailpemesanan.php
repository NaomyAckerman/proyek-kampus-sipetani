<?php 
//untuk menghubungkan dengan file fungsi
require 'fungsi.php';
session_start();
  if (!isset($_SESSION['login'])) {
   echo "<script>
  alert('Silahkan Login Terlebih dahulu');
  document.location.href='login1.php';
  </script>";
  }

//variabel untuk menampilkan data
$harga = tampil("SELECT * FROM harga");
$iduser = $_SESSION['id'];
$pemesanan = tampil("SELECT * FROM pemesanan WHERE 
					id_user = '$iduser' AND
					status_pembayaran = 0
					order by id_pemesanan desc limit 1");

// cek apakah memiliki pemesanan baru
if ($pemesanan == null) {
	echo "<script>
		  alert('Anda tidak memiliki pemesanan');
		  document.location.href='homepembeli.php';
		  </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Detail Pemesanan</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='foto/2Logo-Botani-1.png' rel='shortcut icon'>
	<!-- My CSS -->
	<link rel="stylesheet" type="text/css" href="detailpemesanan.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/all.css">
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
  	<script src="js/jquery-3.4.1.min.js"></script>
  	<script src="js/popper.min.js"></script>
  	<script src="js/bootstrap.js"></script>
  	<script src="js/all.js"></script>
  	<script src="js/required.js"></script>
</head>
<body>

<!-- Header -->

<section>
	<header class="transparan">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-dark mt-auto mb-2">
			  	<a href="homepembeli.php">
			  		<img src="foto/2Logo-Botani-1.png" height="90" width="90">
			  	</a>
			  	<div class="nav-item">
				  	<h1 class="text-white text-uppercase font-weight-bolder ml-4 shadow-sm">taman botani</h1>
			  	</div>

			  		<!-- jika session login sudah login / true makan akan menjalakan isi dari if -->
			  	<?php if (isset($_SESSION['login'])) :?>
			  		<div class="ml-auto dropdown">

			  			<!-- fungsi untuk memanggil data user yg sedang login saat ini bedasarkan session user id -->
			    <?php
			    	$id = $_SESSION['id'];
					$pengguna = tampil("SELECT * FROM users WHERE id_user = $id");
				?>

						<!-- Menampilakan data array pada var $pengguna dengan looping -->
					  <?php foreach ($pengguna as $data) { ?>
              				<a  href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                			<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $data['nama'] ?></span>
                			<img class="rounded-circle" src="admin/fotoprofil/<?= $data['foto']; ?>">
              				</a>
					  <?php } ?>

				            <!-- Dropdown - User Information -->
				            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
				            <a class="dropdown-item" href="akun.php">
				                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
				                  Pengaturan profil
				            </a>
				            <div class="dropdown-divider"></div>
				                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
				                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
				                  Keluar
				                </a>
				            </div>
			  		</div>

			  		<!-- jika bukan session login maka tampilkan yg ada didalam elseif -->
			  	<?php elseif (!isset($_SESSION['login'])) :?>
			  	<div class="ml-auto">
                    <a href= "login1.php">
                    <button class="btn btn-light rounded-pill " type="submit">Masuk <i class="fas fa-user"></i></button>
                    </a>
                 </div>
			  	<?php endif; ?>

			</nav>
		</div>
	<div class="transparan2">
	</div>
	</header>
</section>

<!-- Header Akhir -->

<!-- Konten -->

<section>
	<div class="content">
		<div class="container">
			<div class="row">
	        	
	        	<!-- Detail Pemesanan -->
	        	<div class="col-md-4 offset-md-4">
					<div class="card" style="background-color: rgba(136,228,182,0.6);">
	                      <div class="card-body">
								<table cellpadding="3">
									<?php foreach ($pemesanan as $data) :?>
									<tr>
										<th><label>Nama</label></th>
										<th>:</th>
										<th>
											<?= $data["nama_pemesan"]; ?>
										</th>
									</tr>
									<tr>
										<th><label>Alamat</label></th>
										<th>:</th>
										<th>
											<?= $data["alamat"]; ?>
										</th>
									</tr>
									<tr>
										<th><label>No.Telp</label></th>
										<th>:</th>
										<th>
											<?= $data["no_telp"]; ?>
										</th>
									</tr>
									<tr>
										<th><label>Tanggal Berkunjung</label></th>
										<th>:</th>
										<th>
											<?= $data["tanggal_berkunjung"]; ?>
										</th>
									</tr>
									<tr>
										<th><label>Jumlah Tiket</label></th>
										<th>:</th>
										<th>
											<?= $data["jumlah_tiket"]; ?>
										</th>
									</tr>
									<td colspan="3"><hr class="border border-dark"></td>
									<tr>
										<th><label>Total Pembayaran</label></th>
										<th>:</th>
										<th>
											<?= $data["total_pembayaran"]; ?>
										</th>
									</tr>
								<?php endforeach; ?>
								</table>
	                      </div>
	                </div>
	        	</div>
	        	
	        	<!-- Info -->
			    <div class="col-md-4">
					<div class="card" style="background-color: rgba(136,228,182,0.6);">
				        <div class="card-body text-left ">
				            <form method="POST" action="fungsi.php">
				                <div class="form-group p-3 rounded text-center" style="background-color:silver;">
				        	        <h2>TERIMA KASIH</h2>
				                    <h5>Telah Melakukan Pemesanan Tiket</h5>
				                </div>
				            	<div class="form-group p-3 rounded text-center" style="background-color: silver;">
				                    <h5>Silahkan Melakukan Pembayaran Tiket Ke No. Rekening Berikut :</h5>
				                  	<span class="badge badge-primary rounded-pill mx-auto my-3 d-block w-50">12345678</span>
				                </div>
				                <div class="form-group p-3 rounded text-center" style="background-color: silver;">
				                    <h5>Anda Dapat Mencetak Bukti Pemesanan, Setelah Mengunggah Bukti Pembayaran.</h5>
				                	<a href="homepembeli.php" class="btn btn-primary my-3">Silahkan Unggah Bukti Pembayaran</a>
				                </div>
				            </form>
				       	</div>
				    </div>
				</div>
			</div>
		</div>
	</div>
<section>

<!-- Akhir Konten -->

<!-- Footer -->

<footer>
    <div class="container text-center text-white">
        <div class="row">
            <div class="col-md-4">
                <div class="mt-3">
                  Kontak Kami  
                  <i class="fab fa-whatsapp"></i>
                  <i class="fas fa-phone-square-alt"></i>
                  <i class="fas fa-envelope-square"></i>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-3">
                    <h4>Taman Botani</h4>
                </div>
 	        </div>
            <div class="col-md-4">
                <div class="mt-3">
                  Ikuti Kami
                  <i class="fab fa-facebook-f"></i>
                  <i class="fab fa-instagram"></i>
                </div>
            </div>			
        </div>
    </div>
</footer>
</section> 

<!-- Akhir Footer -->

<!-- Modal Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin keluar dari akun ini?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        	<div class="text-center">
        	<img class="img-fluid mb-2" src="foto/logout.ico">
        	<p>Pilih "Keluar" untuk melakukan proses keluar akun</p>
        	</div>
        	<br>
	        <div class="text-right">
	          <button class="btn btn-secondary mx-2 text-light" type="button" data-dismiss="modal">Batal</button>
	          <a class="btn btn-primary" href="logout.php">Keluar</a>
	        </div>
        </div>
      </div>
    </div>
</div>

</body>
</html>