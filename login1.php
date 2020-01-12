<?php 
//memulai session
session_start();

//memanggil file fungsi.php
require 'fungsi.php';

//cek apakah sudah login atau belum
if (isset($_SESSION['login'])) {
	header('location:homepembeli.php');
}

if (isset($_POST['submit'])) {

$email = $_POST['email'];
$password = $_POST['pwd'];

//menjalankan query
$result = mysqli_query($conn,"SELECT * FROM users WHERE email = '$email'");

//mengecek banyak baris pada database (Adakah pada database email yang telah diinputkan ) 
	if (mysqli_num_rows($result) == 1) {
		//menampung data dari $result yang berupa array
		//array bisa memanggil data array dengan index dan string
		//assoc berupa string
		$data = mysqli_fetch_array($result);
		$id = $data['id_user'];
		$nama = $data['nama'];
		$pass = $data['password'];
		$level = $data['id_akses'];
		if ($password == $pass) {
			$_SESSION['login'] = true;
		    $_SESSION['nama'] = $nama;
		    $_SESSION['id'] = $id;
		    $_SESSION['level'] = $level;
			if ($level == 1) {
				echo "<script>
			  		alert('Login Berhasil!!!');
			  		document.location.href='homepembeli.php';
			  		  </script>";
			  	exit;
			}elseif ($level == 2) {
				echo "<script>
			  		alert('Admin Login Berhasil!!!');
			  		document.location.href='admin/index.php';
			  		  </script>";
			  	exit;
			}
		  echo "<script>
		  alert('Password Salah!!!');
		  document.location.href='login1.php';
		  </script>";
		}
		echo "<script>
		  alert('Password Salah!!!');
		  document.location.href='login1.php';
		  </script>";
	}
$error = true;
echo "<script>
  alert('Email Salah');
  document.location.href='login1.php';
  </script>";
}


 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Masuk</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='foto/2Logo-Botani-1.png' rel='shortcut icon'>
	<!-- My CSS -->
	<link rel="stylesheet" type="text/css" href="login1.css">
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
	<div class="container">    
	    <div class="konten container">
			<div class="row">

				<!-- Colom Gambar -->
				<div class="left col-sm-12 col-md-12 col-xl-6">
					<img src="foto/taman-botani-sukorambi.png" class="gambar1 card-img-top">
					<img src="foto/2444221531.jpg" class="gambar2 card-img-top">
				</div>

				<!-- Colom Konten -->
				<div class="right col-sm-12 col-md-12 col-xl-6 p-5">
					<h1 class="text-center">Masuk</h1>

					<!-- Form Konten -->
					<form method="POST" action="" class="needs-validation" novalidate>
						
						<!-- Input Email -->
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control rounded-pill" id="email" required="" name="email">

							<!-- Required Bootstrap -->
							<div class="invalid-tooltip w-50 text-center mx-auto mt-1" style="position: relative;">
								 Harap Masukkan Email Terlebih Tahulu!
							</div>
							<div class="valid-tooltip w-50 text-center mx-auto mt-1" style="position: relative;">
								Email Sudah Dimasukkan.
							</div>
						</div>
						
						<!-- Input Kata Sandi -->
						<div class="form-group">
							<label for="pwd">Kata Sandi</label>
							<input type="password" class="form-control rounded-pill" id="pwd" required="" name="pwd">

							<!-- Required Bootstrap -->
							<div class="invalid-tooltip w-50 text-center mx-auto mt-1" style="position: relative;">
								 Harap Masukkan Kata Sandi Terlebih Dahulu!
							</div>
							<div class="valid-tooltip w-50 text-center mx-auto mt-1" style="position: relative;">
								Kata Sandi Sudah Dimasukkan.
							</div>
						</div>

						<!-- Button -->
						<div class="form-group">
							<br><hr>
							<div >
								<button class="btn btn-primary rounded-pill" type="submit" name="submit">Masuk</button>
							</div>
								<br><br>
							<div>
							<a href="lupapassword1.php" class="float-left">Lupa Password?</a>
							<a href="registrasipembeli.php" class="float-right">Registrasi</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</content>
</section>

<!-- Akhir Konten -->

<!-- Footer -->

<footer>
    <div class="container text-center text-white">
        <div class="row">
            <div class="col-md-4">
                <div class="mt-3">
                  Kontak Kami  
                  <a href="https://wa.me/6285100707600"><i class="fab fa-whatsapp"></i></a>
                  <a href="mailto:info@tamanbotanisukorambi.com"><i class="fas fa-envelope-square"></i></a>
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
                  <a href="http://www.facebook.com/Taman-Botani-Sukorambi-TBS-270378679664307/?epa=SEARCH_BOX"><i class="fab fa-facebook-f"></i></a>
                  <a href="http://instagram.com/taman.botani.sukorambi?igshid=u5xscy48nuw4"><i class="fab fa-instagram"></i></a>
                </div>
            </div>      
        </div>
    </div>
</footer>
</section> 

<!-- Akhir Footer -->
          
</body>
</html>