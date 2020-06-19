<?php 
	include "../../config.php";
	include "../../helper/alert.php";
	if (isset($_GET['id'])) {
		$fetch = mysqli_query($conn , "DELETE FROM jurusan WHERE idJrs = ".$_GET['id']);
		if ($fetch) {
			setFlashMessage('Data berhasil dihapus' , 'jurusan/index.php');
		}else{
			setFlashMessage('Data tidak bisa dihapus oleh sistem' , 'jurusan/index.php');
		}
	}else{
		header('location: ../index.php');
	}

 ?>