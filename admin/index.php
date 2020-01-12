<?php 
session_start();
if (!isset($_SESSION['login'])) {
   echo "<script>
  alert('Akun tidak ada');
  document.location.href='../login1.php';
  </script>";
}else if ($_SESSION['level'] == 1) {
  header("location:../homepembeli.php");
}
//untuk menghubungkan dengan file fungsi
require '../fungsi.php';

//variabel untuk menampilkan data
$user = tampil("SELECT * FROM users");

// tombol cari ditekan
if (isset($_POST["cari"])) {
  $user = cari($_POST['keyword']);
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

  <title>Taman Botani - Home Admin</title>

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
    <form method="post" action="" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Cari..." autocomplete="off" aria-label="Search" aria-describedby="basic-addon2" name="keyword">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button" name="cari">
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
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <div class="dropdown-header"><p>Selamat datang <?php echo $_SESSION['nama']; ?></p></div>
          <a class="dropdown-item" href="../akun.php">Pengaturan</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">Keluar</a>
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
          <li class="breadcrumb-item active">Lihat Semua</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-ticket-alt"></i>
                </div>
                <div class="mr-5">Pemesanan</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="pemesanan.php">
                <span class="float-left">Lihat Data</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-users"></i>
                </div>
                <div class="mr-5">Pengunjung</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="pengunjung.php">
                <span class="float-left">Lihat Data</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-secondary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-dollar-sign"></i>
                </div>
                <div class="mr-5">Harga</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="harga.php">
                <span class="float-left">Lihat Data</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-check"></i>
                </div>
                <div class="mr-5">Konfirmasi</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="validasi.php">
                <span class="float-left">Lihat Data</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-user"></i>
            Data Pengguna</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>NO</th>
                    <th>NAMA</th>
                    <th>JENIS KELAMIN</th>
                    <th>E-MAIL</th>
                    <th>PASSWORD</th>
                    <th>PIN</th>
                    <th>ID AKSES</th>
                  </tr>
                </thead>
                <tbody>
                  <!--untuk menampikan data pada tabel-->
                  <?php $n = 1; ?>
                  <?php foreach ($user as $data) :?>
                  <tr>
                    <td><?= $n; ?></td>
                    <td><?= $data["nama"]; ?></td>
                    <td><?= $data["jenkel"]; ?></td>
                    <td><?= $data["email"]; ?></td>
                    <td><?= $data["password"]; ?></td>
                    <td><?= $data["pin"]; ?></td>
                    <td><?= $data["id_akses"]; ?></td>
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
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>
</body>
</html>