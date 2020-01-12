<?php 
session_start();
require 'fungsi.php';

  	if (isset($_POST['pesan'])) {
  		// cek apakah sudah login
  		if (!isset($_SESSION['login'])) {
  			echo "<script>
				  alert('Silahkan login terlebih dahulu');
				  document.location.href = 'login1.php';
			  </script>";
	  	}

  	// cek apakah sudah menekan tombol OK pada form homepembeli.php
  	}elseif (!isset($_POST['submit'])) {
  		echo "<script>
				  alert('Silahkan isi Form pemesanan untuk melihat detail pembayaran');
				  document.location.href = 'homepembeli.php';
			  </script>";
  	}

// Menampilkan data pemesanan yang memiliki status byr 0
if (isset($_POST["pesan"])) {
	$id = $_SESSION['id'];
	$query = "SELECT * FROM pemesanan a, users b WHERE a.id_user = b.id_user 
				AND a.id_user = '$id'
				AND a.status_pembayaran = 0";
	$result = mysqli_query($conn,$query);
	$data = mysqli_fetch_array($result);
	$cek = mysqli_num_rows($result);
	//cek apakah memiliki pesanan
	if ($cek > 0) {
		echo "
	    <script>
	      alert('Anda Masih Memiliki tanggungan Silahkan Unggah Bukti Pembayaran!!!');
	      document.location.href='homepembeli.php#unggah';
	    </script>
	    ";exit();
	}
		//cek apakah data pemesanan berhasil disimpan atau tidak dengan menampilkan pop up
		  if (pemesanan($_POST) > 0){
		    echo "
		    <script>
		      alert('Pemesanan Berhasil!!!');
		      document.location.href='detailpemesanan.php';
		    </script>
		    ";
		  } else {
		    echo "
		    <script>
		      alert('Pemesanan Gagal!!!');
		      document.location.href='homepembeli.php';
		    </script>
		    ";
		  }
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Detail Pembayaran</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='foto/2Logo-Botani-1.png' rel='shortcut icon'>
	<!-- My CSS -->
	<link rel="stylesheet" type="text/css" href="detailbayar.css">
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


	<div class="content">
	<div class="container">
		<div class="row dua">
			<div class="col-md-4">
        	</div>
        	<div class="col-md-4">
				<div class="card">
                      <div class="card-body">
							<table cellpadding="3">
								<tr>
									<th><label>Tanggal Pemesanan</label></th>
									<th>:</th>
									<th>
										<?php
										if(isset($_POST['submit'])){
										echo date('d-M-Y',strtotime($_POST['tgl']));}
										?>
									</th>
								</tr>
								<tr>
									<th><label>Jumlah Tiket</label></th>
									<th>:</th>
									<th>
									<?php
										if(isset($_POST['submit'])){
										echo $_POST['jumlahtiket'];}?>
									</th>
								</tr>
								<td colspan="3"><hr class="border border-dark"></td>
								<tr>
									<th><label>Total</label></th>
									<th>:</th>
									<th>
									<?php
										if(date('l',strtotime($_POST['tgl']))== "Friday"){
											  echo "<script>
											  alert('Hari Jumat libur guys');
											  document.location.href='homepembeli.php';
											  </script>";
											  exit;
										}elseif (date('l',strtotime($_POST['tgl']))== "Saturday" || date('l',strtotime($_POST['tgl']))== "Sunday") {
											$jumlah = $_POST['jumlahtiket'];
											$total = $jumlah * 20000;
											echo $total;
										}else{
											$jumlah = $_POST['jumlahtiket'];
											$total = $jumlah * 12000;
											echo $total;
										}
									?>
									</th>
								</tr>
							</table>
                      </div>
                </div>
        	</div>
        	<div class="col-md-4">
				<div class="card">
                      <div class="card-body py-0">
					  <form method="POST" action="" class="needs-validation" novalidate>
					  			<input type="hidden" name="tgl" value="<?= date('Y-m-d',strtotime($_POST['tgl'])); ?>">
					  			<input type="hidden" name="total" value="<?= $total; ?>">
					  			<input type="hidden" name="jumlah" value="<?= $jumlah; ?>">
                                <div class="form-group">
                                    <label class="text-dark" for="nama">Nama</label>
									<input required="" type="text" class="form-control rounded-pill" id="nama" name="nama" required>
									
									<!-- Required Bootstrap -->
										<div class="invalid-tooltip w-50 text-center mx-auto mt-1" style="position: relative;">
											Harap Masukkan Nama Terlebih Dahulu!
										</div>
										<div class="valid-tooltip w-50 text-center mx-auto mt-1" style="position: relative;">
											Nama Sudah Dimasukkan.
										</div>
                                </div>
                                <div class="form-group">
                                   <label class="text-dark" for="alamat">Alamat</label>
									<input required="" type="text" class="form-control rounded-pill" id="alamat" name="alamat" required>
									
									<!-- Required Bootstrap -->
									<div class="invalid-tooltip w-50 text-center mx-auto mt-1" style="position: relative;">
											Harap Masukkan Alamat Terlebih Dahulu!
										</div>
										<div class="valid-tooltip w-50 text-center mx-auto mt-1" style="position: relative;">
											Alamat Sudah Dimasukkan.
										</div>
                                </div>
								<div class="form-group">
                                    <label class="text-dark" for="no_telp">No. Telp</label>
									<input required="" type="text" class="form-control rounded-pill" id="no_telp" name="no_telp" required>
									
									<!-- Required Bootstrap -->
									<div class="invalid-tooltip w-50 text-center mx-auto mt-1" style="position: relative;">
											Harap Masukkan No. Telp Terlebih Dahulu!
										</div>
										<div class="valid-tooltip w-50 text-center mx-auto mt-1" style="position: relative;">
											No. Telp Sudah Dimasukkan.
										</div>
                                </div>
                                <div class="form-group">
                                    <hr>
                                        <a href="homepembeli.php" class="btn btn-primary rounded-pill w-25 float-left">Batal</a>
										<button class="float-right btn btn-primary rounded-pill w-25 float-right" type="submit" name="pesan">Pesan</button>
                                    <br><br>
                                </div>
                            </form>
                      </div>
                </div>
        	</div>
        </div>
		</div>
	</div>



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

<!-- end footer -->

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