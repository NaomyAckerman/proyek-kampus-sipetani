<?php 
session_start();
//untuk menghubungkan dengan file fungsi
require '../fungsi.php';
if (!isset($_SESSION['login'])) {
   echo "<script>
  alert('Akun tidak ada');
  document.location.href='../login1.php';
  </script>";
}else if ($_SESSION['level'] == 1) {
  header("location:../homepembeli.php");
}
//variabel untuk menampilkan data
$validasi = tampil("SELECT * FROM pemesanan where bukti_pembayaran != 0 ORDER BY id_pemesanan DESC");

//tombol carikonfirmasi ditekan
if (isset($_POST['carikonfirmasi'])) {
  $validasi = carikonfirmasi($_POST);
}

// update status pembayaran
if (isset($_GET['id'])) {
    $idpemesanan = $_GET['id'];
    $status = $_GET['status'];
    echo $idpemesanan;
    $query = "UPDATE pemesanan SET
        status_pembayaran = $status
        where id_pemesanan = '$idpemesanan'
        ";
  $result = mysqli_query($conn,$query);
  header('location:pemesanan.php');
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

  <title>Validasi - Home Admin</title>

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
        <input type="text" class="form-control" placeholder="Cari..."  autocomplete="off" aria-label="Search" aria-describedby="basic-addon2" name="keywordkonfirmasi">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit" name="carikonfirmasi">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <div class="dropdown-header"><p>Selamat datang <?php echo $_SESSION['nama']; ?></p></div>
          <a class="dropdown-item" href="../akun.php">Pengaturan</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../login.php" data-toggle="modal" data-target="#logoutModal">Keluar</a>
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
          <li class="breadcrumb-item active">Konfirmasi</li>
        </ol>

        <!-- Data Pemesanan -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-check"></i>
            Konfirmasi Data Pemesanan</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                  <tr>
                    <th>NO</th>
                    <th>ID PEMESANAN</th>
                    <th>NAMA PEMESAN</th>
                    <th>TOTAL PEMBAYARAN</th>
                    <th>BUKTI PEMBAYARAN</th>
                    <th>KONFIRMASI PEMBAYARAN</th>
                    <th>STATUS PEMBAYARAN</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $n = 1; ?>
                  <?php foreach ($validasi as $data) :?>
                  <tr>
                    <td><?= $n; ?></td>
                    <td><?= $data["id_pemesanan"]; ?></td>
                    <td><?= $data["nama_pemesan"]; ?></td>
                    <td><?= $data["total_pembayaran"]; ?></td>
                    <td>
                      <?php if ($data['bukti_pembayaran'] == NULL ): ?>
                          <i class="btn btn-sm btn-danger fas fa-eye-slash rounded-circle"></i>
                      <?php else: ?>
                      <a class="btn btn-sm btn-success rounded-circle" target="_BLANK" href="fotobuktipembayaran/<?= $data['bukti_pembayaran']; ?>"><i class="fas fa-eye"></i></a>
                      <?php endif ?>
                    </td>
                    <td class="text-center">
                        <a href="?id=<?= $data["id_pemesanan"]; ?>&status=1" class="btn btn-sm btn-primary rounded-circle" onclick ="return confirm('Anda Yakin Ingin Mengkonfirmasi?');"><i class="fas fa-check"></i></a>
                        <a href="?id=<?= $data["id_pemesanan"]; ?>&status=0" class="btn btn-sm btn-danger rounded-circle"><i class="fas fa-times"></i></a>
                    </td>
                    <td><?php if ($data["status_pembayaran"] == 1): ?>
                        <label class="btn btn-sm btn-success rounded-pill">Lunas</label>
                      <?php else: ?>
                      <label class="btn btn-sm btn-danger rounded-pill">Lunas</label>
                      <?php endif ?></td>
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
