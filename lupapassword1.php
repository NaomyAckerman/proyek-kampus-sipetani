<?php 
session_start();
require 'fungsi.php';
require 'PHPMailer-5.2.13/PHPMailerAutoload.php';

if (isset($_SESSION['login'])) {
	header("location:homepembeli.php");
}


// untuk lupa password
if (isset($_POST['reset'])) {
	$email = $_POST['email'];
	$pin = $_POST['pin'];
	$result = mysqli_query($conn,"SELECT * FROM users WHERE email = '$email'");
	$cek = mysqli_num_rows($result);
	if ($cek == 1) {
		$data = mysqli_fetch_array($result);
		if ($pin == $data['pin']) {
			
			$pasbaru = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 6);
			
			mysqli_query($conn,"UPDATE users SET password = '$pasbaru' WHERE email = '$email'");
			$mail = new PHPMailer;
			//$mail->SMTPDebug = 3;                               // Enable verbose debug output

			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'goldeneagle0319@gmail.com';                 // SMTP username
			$mail->Password = 'golden0319';                           // SMTP password
			$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 465;                                    // TCP port to connect to

			// $mail->From = 'AdminDeveloper@gmail.com';
			$mail->FromName = 'SIPetani-Official';
			$mail->addAddress($email, 'User');     // Add a recipient
			// $mail->addAddress('ellen@example.com');               // Name is optional
			$mail->addReplyTo('goldeneagle0319@gmail.com', 'Admin');
			$mail->addCC('goldeneagle0319@gmail.com');
			$mail->addBCC('goldeneagle0319@gmail.com');

			$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'SIPetani-Official Admin';
			$mail->Body    = '<center><h1>Password Berhasi Direset</h1><br>
								<h1 style="color : blue;">'.$pasbaru.'</h1><br>
								<a href="http://localhost/SIPetani/homepembeli.php">
								<h6>Pesan Tiket SIPetani<h6>
								</a>
							  </center>';
			$mail->AltBody = 'bisa This is the body in plain text for non-HTML mail clients';

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    header('location:lupapassword1.php?message=berhasil');
			}
		}else{
			echo "
			<script>
			alert('PIN anda salah!');
			document.location.href = 'lupapassword1.php';
			</script>";
		}
	}else{
		echo "
			<script>
			alert('Email tidak terdaftar!');
			document.location.href = 'lupapassword1.php';
			</script>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Lupa Password</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='foto/2Logo-Botani-1.png' rel='shortcut icon'>
	<!-- My CSS -->
	<link rel="stylesheet" type="text/css" href="lupapassword1.css">
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
	<?php if (isset($_GET['message'])): ?>
		<h3 class="mx-auto w-75 text-center alert alert-success alert-di">Password berhasil direset, silahkan cek diemail anda, kemudian langsung lakukan login 
		<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		<a class="btn btn-primary d-block mx-auto mt-2 w-25" href="http://www.gmail.com">cek email</a>
		</h3>
		<br>
	<?php endif ?>
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
					<h1 class="text-center">Lupa Password</h1>

					<!-- Form Konten -->
					<form method="POST" action="" class="needs-validation" novalidate>
						
						<!-- Input PIN -->
						<div class="form-group">
							<label for="pin">PIN</label>
							<input type="text" class="form-control rounded-pill" id="pin" required="" name="pin">
							<!-- Required Bootstrap -->
							<div class="invalid-tooltip w-50 text-center mx-auto mt-1" style="position: relative;">
								Harap Masukkan PIN Terlebih Tahulu!
							</div>
							<div class="valid-tooltip w-50 text-center mx-auto mt-1" style="position: relative;">
								PIN Sudah Dimasukkan.
							</div>
						</div>
						
						<!-- Input Email -->
						<div class="form-group">
							<label for="email">Email</label>
							<input type="Email" class="form-control rounded-pill" id="email" required="" name="email">

							<!-- Required Bootstrap -->
							<div class="invalid-tooltip w-50 text-center mx-auto mt-1" style="position: relative;">
								 Harap Masukkan Email Terlebih Tahulu!
							</div>
							<div class="valid-tooltip w-50 text-center mx-auto mt-1" style="position: relative;">
								Email Sudah Dimasukkan.
							</div>
						</div>

						<!-- Button -->
						<div class="form-group">
							<br><hr>
							<div >
								<button class="btn btn-primary rounded-pill" type="submit" name="reset">Ganti Password</button>
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