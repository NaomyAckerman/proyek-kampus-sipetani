<?php 
session_start();
if (!isset($_SESSION['login'])) {
   echo "<script>
  alert('Akun tidak ada');
  document.location.href='../registrasiadmin.php';
  </script>";
}else if ($_SESSION['level'] == 1) {
  header("location:../homepembeli.php");
}

//untuk menghubungkan dengan file fungsi
require '../fungsi.php';

//variabel untuk menampilkan data
$pemesanan = tampil("SELECT * FROM pemesanan order by id_pemesanan desc");

// tombol caripemesanan ditekan
if (isset($_POST['caripemesanan'])) {
  $pemesanan = caripemesanan($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Taman Botani - Data Pemesanan</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">Taman Botani</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form action="" method="post" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Cari..." autocomplete="off" aria-label="Search" aria-describedby="basic-addon2" name="keywordpemesanan">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit" name="caripemesanan">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown"><div class="dropdown-header"><p>Selamat datang <?php echo $_SESSION['nama']; ?></p></div>
          <a class="dropdown-item" href="../akun.php">Pengaturan</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../login1.php" data-toggle="modal" data-target="#logoutModal">Keluar</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pemesanan.php">
          <i class="fas fa-fw fa-ticket-alt"></i>
          <span>Pemesanan</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pengunjung.php">
          <i class="fas fa-fw fa-users"></i>
          <span>Pengunjung</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="harga.php">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Harga</span></a>
      </li>
      <!-- cek apakah memiliki pesanan yg status cetaknya 0 dan pembayaran 1 -->
      <?php 
      $result = mysqli_query($conn,"SELECT * FROM pemesanan WHERE bukti_pembayaran != 0 AND status_pembayaran = 0");
      $cekcetak = mysqli_num_rows($result); ?>
      <li class="nav-item">
          <a class="nav-link" href="validasi.php">
          <i class="fas fa-fw fa-check"></i>
          <span style="position: relative;">Konfirmasi
            <!--jika cekcetak lebih besar dri 0 maka ada pesanan yang statusnya cetak 0 byr 1-->
          <?php if ($cekcetak > 0): ?>
          <span class="badge badge-danger" style="position: absolute; margin: 0px -15px 0px 15; font-size: 12px;"><?= $cekcetak; ?></span>
         <?php endif ?>
       </span>
       </a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Pemesanan</li>
        </ol>

        <!-- Data Pemesanan -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-ticket-alt"></i>
            Data Pemesanan</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                  <tr>
                    <th>NO</th>
                    <th>ID PEMESANAN</th>
                    <th>NAMA</th>
                    <th>ALAMAT</th>
                    <th>TANGGAL BERKUNJUNG</th>
                    <th>JUMLAH TIKET</th>
                    <th>NO TELP.</th>
                    <th>TOTAL PEMBAYARAN</th>
                    <th>BUKTI PEMBAYARAN</th>
                    <th>STATUS PEMBAYARAN</th>
                    <th>STATUS CETAK</th>
                  </tr>
                </thead>
                <tbody>
                  <!--untuk menampikan data pada tabel-->
                  <?php $n = 1; ?>
                  <?php foreach ($pemesanan as $data) :?>
                  <tr>
                    <td><?= $n; ?></td>
                    <td><?= $data["id_pemesanan"]; ?></td>
                    <td><?= $data["nama_pemesan"]; ?></td>
                    <td><?= $data["alamat"]; ?></td>
                    <td><?= $data["tanggal_berkunjung"]; ?></td>
                    <td><?= $data["jumlah_tiket"]; ?></td>
                    <td><?= $data["no_telp"]; ?></td>
                    <td><?= $data["total_pembayaran"]; ?></td>
                    <td>
                      <?php if (!$data["bukti_pembayaran"]): ?>
                      <span class="btn btn-sm btn-danger rounded-pill">Belum Unggah</span>
                      <?php else: ?>
                      <img class="rounded" height="60" width="80" src="fotobuktipembayaran/<?= $data["bukti_pembayaran"]; ?>">    
                      <?php endif ?>
                    </td>
                    <td>
                      <?php if ($data["status_pembayaran"] == 1): ?>
                        <label class="btn btn-sm btn-success rounded-pill">Lunas</label>
                      <?php else: ?>
                      <label class="btn btn-sm btn-danger rounded-pill">Lunas</label>
                      <?php endif ?>
                    </td>
                    <td>
                      <?php if ($data["status_cetak"] == 1): ?>
                        <label class="btn btn-sm btn-primary rounded-pill">Cetak</label>
                      <?php else: ?>
                      <label class="btn btn-sm btn-danger rounded-pill">Cetak</label>
                      <?php endif ?>                    
                    </td>
                  </tr>
                    <?php $n++; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted"></div>
        </div>
      
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Taman Botani 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin Anda Ingin Keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Tekan "Keluar" Jika Anda Yakin untuk Keluar</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-primary" href="../logoutadmin.php">Keluar</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>

</body>
</html>