<?php 
session_start();
require 'fungsi.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sarana Rekreasi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='foto/2Logo-Botani-1.png' rel='shortcut icon'>
  <!-- My CSS -->
  <link rel="stylesheet" type="text/css" href="saranarekreasi.css">
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
    <a class="btn btn-info" href="homepembeli.php">Halaman Utama</a>
    <div class="row">
      <div class="col-md-6 mt-5">
          <div class="card">
            <h4>FLYING FOX</h4>
            <img height="150" width="250" src="foto/botani/31.jpg">
            <p>Di Taman Botani Sukorambi terdapat wahana yang bisa Anda rasakan untuk memacu adrenalin. Yaitu Flying Fox Jungle dan Flying Fox Tombro. Dengan dilengkapi berbagai alat pengaman, wahana ini layak dicoba bagi Anda yang menyukai petualangan ekstrim.</p>
          </div>
      </div>
      <div class="col-md-6 mt-5">
          <div class="card">
            <h4>KOLAM RENANG</h4>
            <img height="150" width="250" src="foto/botani/21.jpg">
            <p>Fasilitas kolam renang di Taman Botani Sukorambi ini memiliki 5 kolam renang, antara lain : Kolam Renang Dewasa, Kolam Renang Remaja, Kolam Renang Anak, Kolam Renang Pelangi 1 dan Kolam Renang Pelangi 2.</p>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mt-5">
          <div class="card">
            <h4>ANEKA PERMAINAN</h4>
            <img height="150" width="250" src="foto/botani/36.jpg">
            <p>Taman rekreasi yang berada di daerah Sukorambi ini juga menjadi pilihan tepat untuk outbond. Di sini, pengunjung bisa request permainan yang ingin dilakukan bersama kelompok masing-masing.</p>
          </div>
      </div>
      <div class="col-md-6 mt-5">
          <div class="card card-150">
            <h4>PONDOK BACA</h4>
            <img height="150" width="250" src="foto/botani/DSC_1528.jpg">
            <p>Pondok baca ini menyediakan berbagai koleksi bacaan. Mulai dari buku tentang agama, ilmu pengetahuan, tanaman dan buku lainnya. Suasana yang nyaman dan sunyi membuat masyarakat yang membaca bisa fokus. Bahkan, ada dua ruangan untuk memanjakan, dilantai dasar dan atas.</p>
          </div>
      </div>
      <div class="col-md-6 mt-5">
          <div class="card card-150">
            <h4>RUMAH POHON</h4>
            <img height="150" width="250" src="foto/botani/Rumah-Pohon4.jpg">
            <p>Rumah Pohon menjadi salah satu wahana di Taman Botani Sukorambi yang pantang dilewatkan. Dengan tinggi sekitar 5 meter dari permukaan tanah, pengunjung bisa melihat panorama Taman Botani Sukorambi dari ketinggian.</p>
          </div>
      </div>
        <div class="col-md-6 mt-5">
          <div class="card card-150">
            <h4>MUSLIMAH PRIVATE AREA</h4>
            <img height="150" width="250" src="foto/botani/MPA-1536x1031.jpg">
            <p>Pengunjung bebas meminjam MPA. Setiap jam dikenakan Rp 100.000.Di dalam MPA terdapat kolam renang dengan kedalaman bervariasi, musala,kamar mandi dengan fasilitas air panas, dan tempat meeting.Pengunjung yang hendak meminjam MPA harus menandatangani sejumlah pernyataan kepada pengelola.</p>
          </div>
      </div>
      <div class="col-md-6 mt-5">
          <div class="card card-150">
            <h4>PERMAINAN AIR</h4>
            <img height="150" width="250" src="foto/botani/35.jpg">
            <p>Di Wahana permainan air. Di bagian bawah, terdapat danau buatan dengan sebuah pulau mungil di tengahnya.Bagi yang ingin merasakan sensasi mendayung perahu, pengunjung bisa mencoba wahana ini. Di danau buatan ini, terdapat dua buah perahu yang bisa disewa oleh pengunjung.</p>
          </div>
      </div>
      <div class="col-md-6 mt-5">
          <div class="card card-150">
            <h4>BERKUDA</h4>
            <img height="150" width="250" src="foto/botani/kuda-lagi.jpg">
            <p>Pengunjung bisa berkeliling Taman Botani Sukorambi dengan menunggang kuda yang sudah disediakan pengelola, dengan didampingi oleh pawang kuda. Untuk sekali menunggang kuda, pengunjung hanya dikenakan tarif Rp 10 ribu.</p>
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