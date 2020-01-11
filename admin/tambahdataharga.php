<?php 
session_start();
require '../fungsi.php';
if (!isset($_SESSION['login'])) {
   echo "<script>
  alert('Akun tidak ada');
  document.location.href='../login1.php';
  </script>";
}else if ($_SESSION['level'] == 1) {
  header("location:../homepembeli.php");
}
//code simpan
if (isset($_POST["submit"])) {
//cek apakah data berhasil disimpan atau tidak dengan menampilkan pop up
  if (harga($_POST) > 0){
    echo "
    <script>
      alert('Data berhasil disimpan!!!');
      document.location.href='harga.php';
    </script>
    ";
  } else {
    echo "
    <script>
      alert('Data gagal disimpan!!!');
      document.location.href='harga.php';
    </script>
    ";
  }

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

  <title>Taman Botani - Tambah Data Harga</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Tambah Data Harga</div>
      <div class="card-body">
<form method="POST" action="">
            <div class="form-group">
              <label for="hari">Hari</label>
              <input required="" type="text" class="form-control rounded-pill" id="hari" name="hari">
            </div>
            <div class="form-group">
              <label for="harga">Harga</label>
              <input required="" type="number" class="form-control rounded-pill" id="harga" name="harga">
            </div>
              <br><hr>
              <div class="row">
                <div class="left col-md-6">
                <a class="btn btn-danger rounded-pill ml-3" href="harga.php">Batal</a>
              </div>
              <div class="right col-md-6">
                 <button class="btn btn-primary rounded-pill ml-5" type="submit" name="submit">Tambah</button>
                 </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
