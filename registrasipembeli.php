<?php
session_start();
require 'fungsi.php';

if (isset($_SESSION['login'])) {
	header('location:homepembeli.php');
}

//code simpan
if (isset($_POST["submit"])) {
//cek apakah data berhasil disimpan atau tidak dengan menampilkan pop up
  if (registrasi($_POST) > 0){
    echo "
    <script>
      alert('Registrasi Berhasil!!!');
      document.location.href='login1.php';
    </script>
    ";
  } else {
    echo "
    <script>
      alert('Registrasi Gagal!!!');
      document.location.href='registrasipembeli.php';
    </script>
    ";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registrasi Pembeli</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='foto/2Logo-Botani-1.png' rel='shortcut icon'>
	<!-- My CSS -->
	<link rel="stylesheet" type="text/css" href="registrasipembeli.css">
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

<!-- Akhir Header -->

<!-- Konten -->

<section>
	<content>
	    <div class="konten container">
			<div class="row">
				
				<!-- Colom Gambar -->
				<div class="left col-sm-12 col-md-12 col-xl-6">
					<img src="foto/taman-botani-sukorambi.png" class="gambar1 card-img-top">
					<img src="foto/2444221531.jpg" class="gambar2 card-img-top">
				</div>
				
				<!-- Colom Konten -->
				<div class="right col-sm-12 col-md-12 col-xl-6 p-5">
					<h1 class="text-center">Registrasi</h1>
					<form method="POST" action="" class="needs-validation" novalidate>
						
						<!-- Input Nama -->
						<div>
							<label for="nama">Nama</label>
							<input type="text" class="gerak form-control rounded-pill" id="nama" required="" name="nama">
						</div>

						<!-- Input Jenis Kelamin -->
						<div class="form-group">
							<label for="jeniskelamin" class="my-3">Jenis Kelamin</label><br>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="Laki-laki" value="Laki - Laki" name="jeniskelamin" required="">
								<label for="Laki-laki" class="custom-control-label">Laki-laki</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="perempuan" value="Perempuan" name="jeniskelamin" required="">
								<label for="perempuan" class="custom-control-label">Perempuan</label>
							</div>
						</div>

						<!-- Input Email -->
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="gerak form-control rounded-pill" id="email" required="" name="email">
						</div>

						<!-- Input Kata Sandi -->
						<div class="form-group">
							<label for="pwd">Kata Sandi</label>
							<input type="password" class="gerak form-control rounded-pill" id="pwd" name="pwd" required="">
						</div>

						<!-- Input PIN -->
						<div>
							<label for="pin">PIN</label>
							<input type="text" class="gerak form-control rounded-pill" id="pin" required="" name="pin">
						</div>

						<!-- Button -->
						<div>
							<br><hr>
							<div >
								<button class="btn btn-primary rounded-pill" type="submit" name="submit">Registrasi</button>
							</div>
							<div class="mt-3">
								<a href="lupapassword1.php" class="float-left">Lupa Password?</a>
								<a href="registrasipembeli.php" class="float-right">Registrasi</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</content>
</section>

<!-- Akhir Konten -->

<!-- Footer -->
<section>
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
          
</body>
</html>