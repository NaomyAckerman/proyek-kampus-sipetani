<?php 
session_start();
require 'fungsi.php';
if (!isset($_SESSION['login'])) {
	header('location:homepembeli.php');
}

$id = $_SESSION['id'];

//variabel untuk menampilkan data
$pengguna = tampil("SELECT * FROM users WHERE id_user = $id");

//Ubah data
if (isset($_POST["submit"])) {
//cek apakah data berhasil diubah atau tidak dengan menampilkan pop up
  if (ubah_akun($_POST) > 0){
  	if ($_SESSION['level'] == 1 ) {
  		echo "
	    <script>
	      alert('Data berhasil diubah!!!');
	      document.location.href='homepembeli.php';
	    </script>
	    ";
  	} elseif ($_SESSION['level'] == 2 ) {
  		echo "
	    <script>
	      alert('Data berhasil diubah!!!');
	      document.location.href='admin/index.php';
	    </script>
	    ";
  	}
    
  } else {
  	if ($_SESSION['level'] == 1 ) {
  		echo "
	    <script>
	      alert('Data Tidak Ada yang diubah!!!');
	      document.location.href='homepembeli.php';
	    </script>
	    ";
  	} elseif ($_SESSION['level'] == 2 ) {
  		echo "
	    <script>
	      alert('Data Tidak Ada yang diubah!!!');
	      document.location.href='admin/index.php';
	    </script>
	    ";
  	}
  }
}

	
// Ganti Foto Profil
if(isset($_POST['gantifoto'])){
	//cek apakah foto berhasil ditambahkan atau tidak
	if(ubahfoto($_POST) > 0 ){
		echo "
			<script>
			alert('Foto berhasil ditambahkan!');
			document.location.href = 'akun.php';
			</script>
		";
	} else {
		echo "
			<script>
			alert('Foto gagal ditambahkan!');
			document.location.href ='akun.php';
			</script>
		";
	}

}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Setting Akun</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='foto/2Logo-Botani-1.png' rel='shortcut icon'>
	<!-- My CSS -->
	<link rel="stylesheet" type="text/css" href="akun.css">
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

<!-- Kontent -->


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
				<div class="right col-sm-12 col-md-12 col-xl-6">
					<h1 class="text-center">Pengaturan Akun</h1>

					<!-- Form Konten -->
					<?php foreach ($pengguna as $data): ?>
					<form method="POST" action="" class="ml-auto form1 needs-validation" novalidate>
						<!-- Input Nama -->
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" class="gerak form-control rounded-pill" id="nama" required="" name="nama" value="<?= $data["nama"]; ?>">
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
							<input type="email" class="gerak form-control rounded-pill" id="email" required="" name="email" value="<?= $data["email"]; ?>">
						</div>

						<!-- Input Kata Sandi -->
						<div class="form-group">
							<label for="pwd">Kata Sandi</label>
							<input type="password" class="gerak form-control rounded-pill" id="pwd" name="pwd" value="<?= $data["password"]; ?>">
						</div>

						<!-- Input Pin -->
						<div class="form-group">
							<label for="pin">Pin</label>
							<input type="text" class="gerak form-control rounded-pill" id="pin" required="" name="pin" value="<?= $data["pin"]; ?>">
						</div>

						<!-- Button Ubah -->
						<div class="text-left">
								<button class="btn btn-primary rounded-pill w-25" type="submit" name="submit">Ubah</button>

							<!-- Button Ganti Foto -->
							<div class="text-right float-right">
								<a data-toggle="modal" data-target="#exampleModal" class="btn btn-primary rounded-pill" href="">Foto</a>
							</div>
						</div>
					</form>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</content>
</section>

<!-- Akhir Kontent -->

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

<!-- Modal Ganti Foto Profil -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ganti Foto Profil</h5>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data" class="form2">
        	<div class="kotak1 p-5">
            <button class="btn btn-primary rounded-pill">
            	<input type="file" name="foto">
            </button>
            <div class="kotak2 mt-5">
            <button class="float-left btn btn-primary rounded-pill w-25" type="submit" name="gantifoto">Ganti</button>
            </div>
            <div class="kotak2 mt-5">
            <button type="submit" class="float-right btn btn-danger rounded-pill w-25" data-dismiss="modal">Batal</button>
            </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>