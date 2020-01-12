<?php 
// Memulai session
session_start();
require 'fungsi.php';

// menampilkan data pengunjung dan data harga tiket
$harga = tampil("SELECT * FROM harga");
$pengunjung = tampil("SELECT * FROM pengunjung order by id_pengunjung desc limit 1");

// Proses Unggah bukti pembayaran
if(isset($_POST['unggah'])){

	//cek apakah bukti pembayaran berhasil ditambahkan atau sudah dikonfirmasi
	if(unggah($_POST) > 0 ){
		echo "
			<script>
			alert('Bukti pemesanan akan segera diproses!');
			document.location.href = 'homepembeli.php';
			</script>
		";
	} else {
		echo "
			<script>
			alert('Pesanan anda sudah dikonfirmasi oleh admin silahkan cetak tiket!');
			document.location.href ='homepembeli.php';
			</script>
		";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Pembeli</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='foto/2Logo-Botani-1.png' rel='shortcut icon'>
	<!-- My CSS -->
	<link rel="stylesheet" type="text/css" href="homepembeli.css">
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
<div class="container">    
	<div class="row py-5">	 	
			
			<!-- Card Pesanan -->
		    <div class="mb-3 col-xs-12 col-sm-12 col-md-6 col-xl-4">
			        <div class="pesan card">
			            <div class="card-body" id="1">
			                <a href="#1"><h2 class="text-center">Pemesanan</h2></a>
			                    <form method="POST" action="detailpembayaran.php" class="needs-validation" novalidate>
			                    	<div class="form-group">
			                    		
			                    		<!-- Menampilkan format hari saat ini dan menambahkan hari untuk range hari pada inputan -->
			                    		<?php 
			                    			$tgl=date('Y-m-d');
			                    			$tgl2 = date('Y-m-d', strtotime('+5 days', strtotime($tgl)));
		 	                    		?>
			                          	<label class="text-dark" for="tanggal">Tanggal Berkunjung</label>
			                            <input type="date" value="<?= $tgl; ?>" min="<?= $tgl; ?>" max="<?= $tgl2; ?>" class="form-control rounded-pill" id="tanggal" name="tgl" required>
			                            
			                            <!-- Required Bootsrap -->
			                            <div class="invalid-tooltip w-50 text-center mx-auto mt-1" style="position: relative;">
						                  Maksimal 5 hari dari sekarang!
						                </div>
			                        </div>
			                        <div class="form-group">
			                        	<label class="text-dark" for="jumlahtiket">Jumlah Tiket</label>
			                         	<input type="number" min="1" class="form-control rounded-pill" id="jumlahtiket" name="jumlahtiket" required>

			                        	<!-- Required Bootsrap -->
			                        	<div class="invalid-tooltip w-50 text-center mx-auto mt-1" style="position: relative;">
						                  Isi Jumlah Tiket!
						                </div>
			                        </div>
			                        <div class="form-group">
			                        		<hr class="w-75" style="background-color: #fff">
			                        	<div >
			                            	<button class="btn btn-info rounded-pill w-25 float-right" type="submit" name="submit">Ok</button>
										</div>
			                        </div>
		                        </form>
		                </div>
			        </div>
			</div>

			<!-- Card Sarana -->
			<div class="mb-3 col-xs-12 col-sm-12 col-md-6 col-xl-4">
			        <div class="sarana card" id="2">
			            <div class="card-body">
			                <a href="#2"><h2 class="text-center">Sarana</h2></a>
			                	<form>
			                        <div>
										<a class="tombol1 btn btn-primary rounded-pill d-block mx-auto" href="saranabelajar.php">Belajar</a>
									</div>
			                            <br><br>
			                        <div >
											<a class="tombol2 btn btn-primary rounded-pill d-block mx-auto" href= "saranarekreasi.php">Rekreasi</a>
									</div>
										<br><br>
									<div>
										<a class="tombol3 btn btn-primary rounded-pill d-block mx-auto" href="paketwisata.php">Paket Wisata</a>
									</div>
			                    </form>
		                </div>
		            </div>
		    </div>

		    <!-- Card Informasi -->
		    <div class="mb-3 col-xs-12 col-sm-12 col-md-6 col-xl-4">
		        <div class="info card">
		            <div class="card-body text-left" id="#3">
		                <a href="#3"><h2 class="text-center">informasi tiket</h2></a>
			            <form method="POST" action="fungsi.php">
							<div class="harga form-group p-3 rounded" >
								<h4 class="text-center">HARGA TIKET</h4>

								<!-- menampilakan seluruh data array dari variable harga dengan pengulangan -->
								<?php foreach ($harga as $data): ?>
									<td><label><?= $data['hari']; ?></label>
										<span class="mb-3 badge badge-info rounded-pill d-block">
										<?= $data['harga']; ?>
										</span>		
									</td>
								<?php endforeach; ?>
	                        </div>	
							<div class="jumlah form-group p-3 rounded">	
								<h4 class="text-center">JUMLAH PENGUNJUNG PER HARI</h4>
										
								<!-- menampilakan seluruh data array dari variable pengunjung dengan pengulangan -->
								<?php foreach ($pengunjung as $data): ?>
									<td><label><?= $data['tgl_pengunjung']; ?></label>
									<span class="badge badge-info rounded-pill d-block mx-auto"> <?= $data['jum_pengunjung']; ?></span></td>
								<?php endforeach; ?>
		                    </div>
		                    <div class="jamkerja form-group p-3 rounded">
		                        <h4 class="text-center">JAM KERJA</h4>
		                        <label class="mb-4">Senin - Kamis : <span class="badge badge-info rounded-pill"> 07.00 - 16.00 WIB</span></label>
	                            <label>Sabtu - Minggu : <span class="badge badge-info rounded-pill"> 07.00 - 16.00 WIB</span></label>
		                        <br>
		                        <span class="libur badge badge-danger rounded-pill d-block my-5 mx-auto">JUMAT LIBUR</span>
							</div>
			            </form>
			        </div>
			    </div>
			</div>    

	</div>
</div>
</content>
</section>

<!-- Cek Apakah memiliki pesanan yg belum lunas atau belum cetak -->
<?php if (isset($_SESSION['login'])) :?>
<?php 
	$id = $_SESSION['id'];
	$query = "SELECT * FROM pemesanan a, users b WHERE
				a.id_user = b.id_user AND
                (a.status_pembayaran = 0 OR a.status_cetak = 0) AND
                a.id_user = $id
                GROUP BY a.id_pemesanan";
	$hasil = mysqli_query($conn,$query);
	$data = mysqli_fetch_array($hasil);
	$cek = mysqli_num_rows($hasil);
?>

	<!-- Jika iya akan menampilkan tombol bukti byr, cetak dan detail -->
	<?php if ($cek > 0) :?>
	<div class = "content ml-5" id="unggah">
	    <div class= "content1 text-white ml-5">
	        <label for="buktipembayaran">Bukti Pembayaran</label>
	        <a data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-primary rounded-pill" href="">Unggah</a>
	    </div>
	    <br><br>
	    <div class = "content2 text-white ml-5">
	        <label for="bukti">Detail Pemesanan</label>
	        <a href="detailpemesanan.php" class="ml-4 btn btn-sm btn-primary rounded-pill">Detail</a>
	    </div>

	        <!-- cek apakah memiliki pesanan yg status cetaknya 0 dan pembayaran 1 -->
	    <?php 
	    $result = mysqli_query($conn,"SELECT * FROM pemesanan WHERE status_cetak = 0 AND status_pembayaran = 1 AND id_user = $id");
	    $cekcetak = mysqli_num_rows($result);

	        // jika cekcetak lebih besar dri 0 maka ada pesanan yang statusnya cetak 0 byr 1
	    if ($cekcetak > 0): ?>
	    <br><br>
	    <div class = "content3 text-white ml-5">
	        <label for="buktipemesanan">Bukti Pemesanan</label>
	        <a href="cetak.php" class="ml-4 btn btn-sm btn-primary rounded-pill">Cetak</a>
	        	<span class="badge badge-danger" style="position: absolute; margin: -7px -15px"><?= $cekcetak; ?></span>
	    </div>
	    <?php endif ?>

	</div>
	<?php endif; ?>	

<?php endif; ?>

<!-- Akhir Konten -->

<!-- Footer -->

<section>

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


<!-- Modal Unggah bukti pembayaran -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Unggah Bukti Pembayaran</h5>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
        	<div class="kotak1 p-5">
            <button class="btn btn-primary rounded-pill">
            	<input type="file" name="gambar">
            </button>
            <div class="kotak2 mt-5">
            <button class="float-left btn btn-primary rounded-pill w-25" type="submit" name="unggah" value="import">Unggah</button>
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