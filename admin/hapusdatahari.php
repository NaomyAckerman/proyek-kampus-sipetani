<?php 
require '../fungsi.php';
//untuk menangkap id
$id_harga = $_GET["id"];
//cek apakah data berhasil dihapus atau tidak dengan menampilkan pop up
if (hapus($id_harga) > 0) {
	echo "
		<script>
			alert('Data berhasil dihapus!!!');
			document.location.href='harga.php';
		</script>
		";
	} else {
		echo "
		<script>
			alert('Data gagal dihapus!!!');
			document.location.href='harga.php';
		</script>
		";
	}

 ?>