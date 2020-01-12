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
  <link rel="stylesheet" type="text/css" href="saranabelajar.css">
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
      <div class="left col-md-6 mt-5">
          <div class="card">
            <h4>1. Paket Pancing dan Bakar Ikan</h4>
            <h4>2. Paket Pancing Lobster Air Tawar</h4>
            <h4>3. Paket Memberi Makan 10 Jenis Hewan Cantik</h4>
            <h4>4. Paket Camping dan Outbound</h4>
            <h4>5. Wisata Flying Fox Jungle</h4>
            <h4>6. Wisata Flying Fox Tombro</h4>
            <h4>7. Paket Wisata Petik Buah</h4>
            <h4>8. Paket Wisata Alam</h4>
            <h4>9. Paket Ayo ke Sawah</h4>
            <h4>10. Paket Belajar Hidroponik</h4>
            <h4>11. Paket Belajar Ternak Kelinci</h4>
            <h4>12. Paket Budidaya Lobster Air Tawar</h4>
            <h4>13. Wisata Berkuda</h4>
            <h4>14. Wisata Permainan Air</h4>
            <h4>15. Paket Wisata Golf Cart</h4>
            <h4>16. Paket Pesta Kebun</h4>
            <h4>17. Paket Menginap di Villa</h4>
            <h4>18. Paket Muslimah Private Area</h4>
          
          </div>
      </div>
      <div class="right col-md-6 mt-5" style="padding-top: 0;">
          <div class="card">
            <div class="row" style="padding-top: 0">
            <div class="left col-md-6 mt-5">
            <div class="gambar1" style="padding-top: 0">
            <img height="150" src="foto/botani/36.jpg">
            </div>

            <div class="gambar2" style="padding-top: 0">
              <img height="150" src="foto/botani/21.jpg">
            </div>
            <div class="gambar3" style="padding-top: 0">
              <img height="150" src="foto/botani/31.jpg">
            </div>
            <div class="gambar4" style="padding-top: 0">
              <img height="150" src="foto/botani/DSC_1528.jpg">
            </div>
          </div>
          <div class="right col-md-6 mt-5">
            <div class="gambar5" style="padding-top: 0">
            <img height="150" src="foto/botani/175-BUNGA-DAISY-KUNING.jpg">
            </div>

            <div class="gambar6" style="padding-top: 0">
              <img height="150" src="foto/botani/rusa.jpg">
            </div>
            <div class="gambar7" style="padding-top: 0">
              <img height="150" src="foto/botani/DSC_0312-1.jpg">
            </div>
            <div class="gambar8" style="padding-top: 0">
              <img height="150" src="foto/botani/DSC_0136b.jpg">
            </div>
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
          
</body>
</html>